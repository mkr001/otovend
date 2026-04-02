<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get unique users we have conversations with
        $contacts = User::whereHas('sentMessages', function($q) use ($user) {
            $q->where('receiver_id', $user->id);
        })->orWhereHas('receivedMessages', function($q) use ($user) {
            $q->where('sender_id', $user->id);
        })->where('id', '!=', $user->id)->get();

        return view('messages.index', compact('contacts'));
    }

    public function show(User $contact, ?Product $product = null)
    {
        $user = Auth::user();

        // Get conversation with this contact
        $messagesQuery = Message::where(function($q) use ($user, $contact) {
            $q->where('sender_id', $user->id)->where('receiver_id', $contact->id);
        })->orWhere(function($q) use ($user, $contact) {
            $q->where('sender_id', $contact->id)->where('receiver_id', $user->id);
        });

        if ($product) {
            $messagesQuery->where('product_id', $product->id);
            // Optionally, mark messages as read here
            Message::where('sender_id', $contact->id)
                ->where('receiver_id', $user->id)
                ->where('product_id', $product->id)
                ->update(['is_read' => true]);
        } else {
             Message::where('sender_id', $contact->id)
                ->where('receiver_id', $user->id)
                ->update(['is_read' => true]);
        }

        $messages = $messagesQuery->orderBy('created_at', 'asc')->get();

        return view('messages.show', compact('contact', 'messages', 'product'));
    }

    public function store(Request $request, User $contact)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'product_id' => 'nullable|exists:products,id',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $contact->id,
            'product_id' => $request->product_id,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Wiadomość wysłana!');
    }
}
