<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Repository\UserRepositoryInterface;

class UserController extends Controller
{
    /** @var UserRepositoryInterface  */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Show the list of verified user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = $this->userRepository->all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the user chat page.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(int $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $roomId = generateRoomId($user->id);
        return view('user.show', compact('user', 'roomId'));
    }

    /**
     * Show the user chat page.
     *
     * @param StoreMessageRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(StoreMessageRequest $request, int $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $message = $this->messageRepository->create([
            'sender_id'=> auth()->id(),
            'receiver_id'=> $user->id,
            'message'=> $request->get('message'),
        ]);

        return $message->fresh();
    }
}
