<?php

// app/Http/Controllers/MessageController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function list()
    {
        $userId = Auth::id();

        // 自分が送信 or 受信したメッセージを新しい順に取得
        $messages = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->orderByDesc('created_at')
            ->get();

        // 相手ごとの最新メッセージだけを残す
        $latestMessages = $messages->unique(function ($message) use ($userId) {
            return $message->sender_id === $userId
                ? $message->receiver_id
                : $message->sender_id;
        });

        return view('messages.list', compact('latestMessages', 'userId'));
    }

    public function show(User $user)
    {
        $myId = auth()->id();

        // 自分と相手とのメッセージのみ取得
        $messages = Message::where(function ($query) use ($myId, $user) {
            $query->where('sender_id', $myId)->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($myId, $user) {
            $query->where('sender_id', $user->id)->where('receiver_id', $myId);
        })->orderBy('created_at')->get();

        return view('messages.show', compact('user', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->route('messages.show', $request->receiver_id);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    public function fetchNewMessages(Request $request, \App\Models\User $user)
    {
        $myId = auth()->id();
        $lastMessageId = $request->query('last_id'); // クエリパラメータで取得

        $newMessages = \App\Models\Message::where('id', '>', $lastMessageId)
            ->where(function ($query) use ($myId, $user) {
                $query->where('sender_id', $user->id)->where('receiver_id', $myId);
            })
            ->orderBy('id')
            ->get();

        return response()->json([
            'messages' => $newMessages
        ]);
    }

}
