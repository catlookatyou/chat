<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Events\MessageSent;
use Auth;

class MessagesController extends Controller
{
    public function getAll(Request $request) {
        //room_id
        $room_id = $request->get('roomId');
        $messages = Message::where('room_id', $room_id)->get();
        foreach($messages as $message){
            $message_form_id = $message->sent_from;
            $user = User::where('id', $message_form_id)->first();
            $message->name = $user->name;
        }
        return $messages;
    }
    
    // Allows us to post new message
    public function post() {
        $message = new Message();
        //content
        $content = request('message');
        $message->content = $content;
        //sent_from
        $message->sent_from = Auth::id();
        //room_id
        $room_id = 1;
        $message->room_id = $room_id;
        $message->save();

        //user
        $user = Auth::user();
        $user->room_id = 1;
        $user->save();
        
        event(new MessageSent($message));

        $message->name = auth::user()->name;
        
        //return $content;
        return $message;
    }

    public function auth(){
        return Auth::user();
    }
}
