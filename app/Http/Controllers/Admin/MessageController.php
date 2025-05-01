<?php

namespace App\Http\Controllers\Admin;
use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index ()
    {
        $messages = Message::orderBy('sent_at', 'desc')->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function store (Request $request)
    {
        $request -> validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'message' => 'string|max:255',
            'sent_at' => now(),
        ]);

        $messages = Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'sent_at' => $request->sent_at,

        ]);

        return redirect()->back()->with('status', 'Message Sent Successfully');
    }

}