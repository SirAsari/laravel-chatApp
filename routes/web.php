<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Events\MessageCreated;
use App\Events\PrivateMessageCreated;
use App\Models\Chat;
use App\Models\ChatMessage;

// new ones
use App\Events\WorkingMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Actual chat app

Route::get('/', function () {
    return view('index');
});

Route::post('/send-message', function (Request $request) {
    event(new WorkingMessage($request->input('username'),
    $request->input("message")));
});

// The rest are for testing out

Route::get('/', function () {
    return view('welcome');
});

Route::get('/messageCreated', function () {
    MessageCreated::dispatch("Foo");
});

Route::get('/PrivateMessageCreated', function () {
    $chat = Chat::find(1);
    $chatMessage = new ChatMessage();

    PrivateMessageCreated::dispatch($chat, $chatMessage);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
