<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'message_body' => ['required','string']
        ]);
        $message = new Message;
        $message->name = $request->name;
        $message->phone = $request->phone;
        $message->email = $request->email;
        $message->title = $request->title;
        $message->message_body = $request->message_body;

        $message->save();
        Alert::success('Success ', 'Thank you for your feedback, we will replay as soon as possiable','/imgs/logo.png','60%','70%','Image Alt');
        //alert()->image('Thank you for your feedback, we will replay as soon as possiable','/imgs/logo.png','60%','70%','Image Alt');
        return redirect()->route('home');
    }
}
