<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Repository\MessageRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /** @var MessageRepositoryInterface  */
    private $messageRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * List of messages
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $messages = $this->messageRepository->get($request->all());
        return response()->json($messages);
    }

    /**
     * Save message to Database.
     *
     * @param StoreMessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMessageRequest $request)
    {
        $message = $this->messageRepository->create([
            'sender_id'=> auth()->id(),
            'receiver_id'=> $request->get('user_id'),
            'message'=> $request->get('message'),
        ]);

        return response()->json($message);
    }
}
