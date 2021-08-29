<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const PAGINATION_COUNT = 100;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    protected $with = ['sender'];

    public function scopeBySender(Builder $query, int $senderId)
    {
        $query->where('sender_id', $senderId);
    }

    public function scopeByReceiver(Builder $query, int $receiverId)
    {
        $query->where('receiver_id', $receiverId);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id')->select(['id', 'name']);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id')->select(['id', 'name']);
    }
}
