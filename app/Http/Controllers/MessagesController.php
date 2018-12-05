<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Message;
use App\Dialog;
use Auth;
use App\User;
use DB;

class MessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    //http://127.0.0.1:8000/messages
    public function index(){
        $error = 'Sizin hələki heç kimlə dialoqunuz yoxdur';
        $id = Auth::user()->id;

        $dialogs = DB::table('dialogs')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'dialogs.send')->orOn('users.id', '=', 'dialogs.recive');
            })
            ->where(function ($query) {
                $query->where('dialogs.send', '=', Auth::user()->id)
                      ->orWhere('dialogs.recive', '=', Auth::user()->id);
            })
            ->where('users.id', '!=', $id)
            ->select('dialogs.*', 'users.name')
            ->get();

            dump($dialogs);

            foreach ($dialogs as $dialog) {
                if(isset($dialog->id)){
                        if($dialog->send === $id && $dialog->status === 0){
                            $status = 'oxunmayib';
                        }elseif($dialog->send === $id && $dialog->status === 1){
                            $status = 'oxunub';
                        }elseif($dialog->recive === $id && $dialog->status === 0){
                            $messcount = Message::where('did', $dialog->id)
                            ->where('usid', $dialog->send)
                            ->where('status', 0)
                            ->get();
                            $status = count($messcount);
                        }else{
                            $status = "";
                        }
                    return view('posts.messages', compact('dialogs', 'status'));
                }
            }
                return view('posts.messages', compact('error'));
    }


    //http://127.0.0.1:8000/messages/id with POST
    public function send(Request $request){

        if($request->ajax()){
            $message = $request->message;
            $id = $request->id;

            $usid = Auth::user()->id;

            $dialog = Dialog::where('id', $id)->get();

            foreach($dialog as $dia){
                $dialog_id = $dia->id;
                if($dia->send === $usid){
                    $user = $dia->recive;
                }else{
                    $user = $dia->send;
                }
            }

            Dialog::where('id', $id)->update(['status' => 0, 'send'=>$usid, 'recive'=>$user]);


            DB::insert('insert into messages (did, usid, message) values (?, ?, ?)', [$id, $usid, $message]);

            return response(['message' => $message]);
        }

    }


    public function newMessage(Request $request){
        if($request->ajax()){

            $dialogId = $request->id;
            $usid = Auth::user()->id;

            $dialog = Dialog::where('id', $dialogId)->get();

            foreach($dialog as $dia){
                if($dia->send === $usid){
                    $user = $dia->recive;
                }else{
                    $user = $dia->send;
                }
            }

            $messages = Message::where('did', $dialogId)
                ->where('usid', $user)
                ->where('status', 0)
                ->get();

            foreach($messages as $mess){
                $messId = $mess->id;
                $message = $mess->message;
            }
                if(isset($messId)){
                    Dialog::where('id', $dialogId)->update(['status' => 1]);
                    Message::where('did', $dialogId)
                        ->where('usid', $user)
                        ->where('status', 0)
                        ->update(['status' => 1]);

                    return response(['messages' => $message]);
                }else{
                    return response(['messages' => 'false']);
                }
        }
    }





    //http://127.0.0.1:8000/messages/id
    public function show($id){

        $error = false;

        $dialog = Dialog::where('id', $id)->get();

        foreach($dialog as $dia){
            $dialog_id = $dia->id;
            $usid = Auth::user()->id;
            if($dia->send === $usid || $dia->recive === $usid){
                $status = true;
            }else{
                $status = false;
            }

            if($dia->send === $usid){
                $user = $dia->recive;
            }else{
                $user = $dia->send;
            }
        }
        
        if(isset($dialog_id) && $status === true){
            Dialog::where('id', $id)->where('send', $user)->update(['status' => 1]);
            Message::where('status', 0)
            ->where('did', $dialog_id)
            ->where('usid', $user)
            ->update(['status' => 1]);
            $messages = Message::where('did', $dialog_id)->get();
            return view('messages', compact('messages'));
        }else{
            return view('messages', compact('error'));
        }
    }
}
