<?php

namespace App\Http\Controllers\Admin;
use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyToMessageMail;

class MessageController extends Controller
{
    public function index ()
    {
        $messages = Message::orderBy('sent_at', 'desc')->get();

        $activities = UserActivity::with('task')->latest()->get(); 

        return view('admin.message.index', compact('messages', 'activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'nullable|string|max:10000'
        ]);
    
        try {
            Message::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'sent_at' => now(),
            ]);
    
            return back()->with('success', 'Your message has been sent successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error sending your message. Please try again.');
        }
    }
    

    public function show($id)
    {
        $message = Message::findOrFail($id);


        $activities = UserActivity::with('task')->latest()->get(); 
        
        return view('admin.message.show', compact('message', 'activities'));
    }

    public function replyForm($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.message-reply', compact('message'));
    }
    
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply_body' => 'required|string',
        ]);
    
        $message = Message::findOrFail($id);
    
        try {
            Mail::to($message->email)->send(
                new ReplyToMessageMail($request->reply_body, $message->name)
            );
            return redirect()->route('admin.messages.reply-form', $id)->with('success', 'Reply sent to ' . $message->email);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        try {
            $message->delete();
            return back()->with('success', 'Message deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete message: ' . $e->getMessage());
        }
    }

}