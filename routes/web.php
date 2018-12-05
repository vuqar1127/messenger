<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts.index');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/send_message', 'MailController@send');

Route::get('/users', 'Pagination@users');

//Messanger Routes
Route::get('/messages', 'MessagesController@index');

Route::get('/messages/{dialog}', 'MessagesController@show')->name('dialog');
Route::get('/sendNewMessage', 'MessagesController@send');
Route::get('/NewMessage', 'MessagesController@newMessage');

//


//Route::get('/test', 'Test@index');

//Route::get('/getUser', 'Test@show');

// Route::get('/getRequest', function(){
// 	if(Request::ajax()){
// 		return "working";
// 	}
// });

// Route::post('/postForm', function(){
// 	if(Request::ajax()){
// 		 return "<span>html here</span>";
// 	}
// });