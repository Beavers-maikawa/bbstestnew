<?php

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

Route::get('/', [App\Http\Controllers\Controller::class, 'index'])->name('index');
Route::post('/', [App\Http\Controllers\Controller::class, 'thread_store'])->name('thread_store');
Route::get('/thread/{thread}', [App\Http\Controllers\Controller::class, 'thread'])->name('thread')->where('thread', '[0-9]+');
Route::post('/comment_store', [App\Http\Controllers\Controller::class, 'comment_store'])->name('comment_store');
Route::get('/contact/{thread}', [App\Http\Controllers\Controller::class, 'sendMail'])->name('contact')->where('thread', '[0-9]+');
Route::post('/send', [App\Http\Controllers\Controller::class, 'send'])->name('send');
Route::get('/contactcomment/{comment}', [App\Http\Controllers\Controller::class, 'sendMailToComment'])->name('contactcomment')->where('comment', '[0-9]+');
Route::post('/sendComment', [App\Http\Controllers\Controller::class, 'sendComment'])->name('sendComment');
