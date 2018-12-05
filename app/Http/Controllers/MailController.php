<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Mail;

class MailController extends Controller
{
    public function send(){
    	Mail::send(['text' => 'mail'], ['name', 'Vuqar Message'], function ($message){
    		$message->to('aqayev-v@mail.ru', 'ToVuqar')->subject('test mail');
    		$message->from('vaqayev3@gmail.com', 'From Vuqar 2');
    	});
    }
}
