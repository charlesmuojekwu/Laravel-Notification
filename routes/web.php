<?php

use App\Models\User;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

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

    //throw new \Exception('Error loding page');
    /// Quick Slack Log
    //Log::channel('slack')->info('The log from the laravel App');

    return view('welcome');

});

## App\Exception\Handler.php ....  ALL EXCEPTIONS thrown in the laravel pass through it

Route::get('/notify', function () {
    $user = User::find(3);

    $user->notify(new InvoicePaid);
});


Route::get('/db-notification', function () {
    $user = User::find(3);

    return $user->notifications;

    //return $user->unreadNotifications;

    //return $user->readNotifications;

});


Route::get('/read-notification', function () {
    $user = User::find(3);

    $user->notifications->first()->markAsRead();

});


Route::get('/update', function () {
    User::where('id',3)->update(['notification_preference' => 'mail,database']);
});
