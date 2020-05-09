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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cart', 'ItemsController@cart')->name('cart');
Route::get('/increase-one-item/{id}', 'ItemsController@increaseByOne');
Route::get('/decrease-one-item/{id}', 'ItemsController@decreaseByOne');
Route::get('/remove-item/{id}', 'ItemsController@removeItem');
Route::get('/add-to-cart/{id}', 'ItemsController@AddToCart')->name('addcart');
Route::get('/clear-cart', 'ItemsController@clearCart');

Route::get('/all_orders', 'OrdersController@orders');
Route::get('/orders', 'OrdersController@index')->name('orders');
Route::get('/order/new', 'OrdersController@new');
Route::post('/order/store', 'OrdersController@store');
Route::post('/callback', 'OrdersController@callback');
Route::get('/success', 'OrdersController@redirectFromECpay');

Route::get('/getRoomId', 'MessagesController@getRoomId')->name('getRoomId');
Route::get('/chat/{user_b_id}', 'MessagesController@chat')->name('chat');
Route::post('/post', 'MessagesController@post')->name('post');
Route::get('/getAll', 'MessagesController@getAll')->name('getAll');
