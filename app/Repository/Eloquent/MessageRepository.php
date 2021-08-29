<?php

namespace App\Repository\Eloquent;

use App\Models\Message;
use App\Repository\MessageRepositoryInterface;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Message $model
     */
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return array
     */
    public function get(array $data): array
    {
        $queryBuilder = $this->model->newQuery();
        if (isset($data['user_id'])) {
            $queryBuilder->where(function (Builder $queryBuilder) use ($data) {
                $queryBuilder->where(function (Builder $queryBuilder) use ($data) {
                    $queryBuilder->bySender($data['user_id'])->byReceiver(auth()->id());
                })
                ->orWhere(function (Builder $queryBuilder) use ($data) {
                    $queryBuilder->bySender(auth()->id())->byReceiver($data['user_id']);
                });
            });
        }

        $queryBuilder->orderBy('id', 'desc')
            ->take(Message::PAGINATION_COUNT);

        $result = $queryBuilder->get();

        return $this->transformData($result);
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function create(array $attributes): array
    {
        $model = $this->model->create($attributes);

        $message = $this->transformItem($model);
        $this->send($message);
        return $message;
    }

    /**
     * @param Collection $messages
     * @return array
     */
    private function transformData(Collection $messages): array
    {
        $messages = $messages->sort();
        $result = [];
        foreach ($messages as $message) {
            $result[] = $this->transformItem($message);
        }
        return $result;
    }

    /**
     * @param Model $model
     * @return array
     */
    private function transformItem(Model $model): array
    {
        return [
            'id' => $model->id,
            'sender_id' => $model->sender_id,
            'receiver_id' => $model->receiver_id,
            'name' => $model->sender->name,
            'message' => $model->message,
            'date' => Carbon::parse($model->created_at)->format('F j, Y, h:i:s')
        ];
    }

    /**
     * @param array $message
     * @return array|string[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function send(array $message)
    {
        $message['room_id'] = generateRoomId($message['receiver_id']);
        $client= new Client();
        $client->request('POST', env('NODE_HOST') . '/', [
            'headers' => [
                'X-AUTH-TOKEN' => env('NODE_AUTH_TOKEN')
            ],
            'form_params' => $message,
            'verify' => false
        ]);
    }
}
