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
use App\Events\MessageSent;
use App\Message;

Route::get('/sent', function () {
    $message = Message::create([
        'content' =>'hello',
        'room_id' => 1,
        'sent_from' => 1
    ]);
    event(new MessageSent($message));
    return view('home');
});


Auth::routes();

Route::get('/users', 'MessagesController@allUsers')->name('allUsers');
Route::get('/getRoomId', 'MessagesController@getRoomId')->name('getRoomId');

Route::get('/chat/{user_b_id}', 'MessagesController@chat')->name('chat');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/post', 'MessagesController@post')->name('post');

Route::get('/getAll', 'MessagesController@getAll')->name('getAll');
