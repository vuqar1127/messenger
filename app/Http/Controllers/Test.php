<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class Test extends Controller
{
	public function index(){
		return view('test');
	}


    public function show(Request $request){
    	if($request->ajax()){
	    	$messages = Message::all();
	    	return response(['messages' => $messages]);
    	}
    }
}
