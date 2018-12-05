<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	// public static function ShowAllMessages(){
	// 	return ('messages')->get();
	// }

	public static function ShowMessageByID($id){
		return static::where('id', $id)->get();
	}
}
