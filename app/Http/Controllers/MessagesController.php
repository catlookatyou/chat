<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Room;
use App\Events\MessageSent;
use Auth;
use View;

class MessagesController extends Controller
{
    public function getRoomId(){
        (int)$room_id = Auth::user()->room_id;
        return $room_id;
    }

    public function allUsers(){
        $users =  User::all();
        return View::make('users', compact('users'));
    }

    public function chat($user_b_id){
        $user_a_id = Auth::id();

        $room = Room::where('user_a_id', $user_a_id)
                    ->where('user_b_id', $user_b_id)
                    ->first();

        if($room == null){
            $room = Room::where('user_a_id', $user_b_id)
                    ->where('user_b_id', $user_a_id)
                    ->first();
        }

        if($room == null)
        {   
            $room = new Room();
            $room->user_a_id = $user_a_id;
            $room->user_b_id = $user_b_id;
            $room->save();
        }

        $user = Auth::user();
        $user->room_id = $room->id;
        $user->save();

        $room_id = Auth::user()->room_id;
        return View::make('chat', compact('room_id'));
    }

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
}
