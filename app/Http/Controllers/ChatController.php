<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function chat(){
        return view('chat');
    }
    public function send(Request $request){

        $user=User::findOrFail(auth()->user()->id);
        $this->saveToSession($request);
        event(new ChatEvent($request->message,$user));
    }
    public function saveToSession(Request $request){

        session()->put('chat',$request->chat);
    }
    public function getOldMessage()
    {
        return session('chat');
    }
    public function deleteSession()
    {
        session()->forget('chat');
    }
}
