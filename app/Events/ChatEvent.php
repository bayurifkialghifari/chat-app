<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $room;
    public $message;
    public $sender;

    public function __construct($room, $message, $sender)
    {
        $this->room = $room;
        $this->message = $message;
        $this->sender = $sender;
    }

    public function broadcastOn()
    {
        return ['chat-channel'];
    }

    public function broadcastAs()
    {
        return 'chat-send';
    }

    public function broadcastWith()
    {
        return [
            'room' => $this->room,
            'message' => $this->message,
            'sender' => $this->sender
        ];
    }
}
