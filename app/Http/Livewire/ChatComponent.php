<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class ChatComponent extends Component
{
    public $messageText;

    public function sendMessage()
    {
        Message::create([
            'user_id' => auth()->user()->id,
            'message_text' => $this->messageText,
        ]);
        $this->messageText = '';

    }

    public function render()
    {
        $users = User::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')
            ->paginate(10);
        $messages = Message::with('user')->latest()->take(10)->get()->sortBy('id');
        return view('livewire.chat-component', compact('messages', 'users'));
    }
}
