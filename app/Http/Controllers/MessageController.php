<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(request $request){
    	$rules = [
    		'message' => 'required|min:5|max:255'
    	];
    	$this->validate($request, $rules);

    	$message = new Message();
    	$message->incident_id = $request['incident_id'];
    	$message->user_id = auth()->user()->id;
    	$message->message = $request['message'];

    	$message->save();
    	return back()->with('message', 'Message Sent Successfully !');
    }
}
