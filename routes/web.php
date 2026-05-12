<?php

use App\Http\Controllers\SmsController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('index'); })->name('home');

Route::get('/otp-phone', function () { return view('otp-phone'); })->name('otp.phone');
Route::post('/otp/phone', [SmsController::class, 'sendSms'])->name('otp.phone.send');

Route::get('/otp-email', function () { return view('otp-email'); })->name('otp.email');
Route::post('/otp/email', [EmailController::class, 'sendEmail'])->name('otp.email.send');

Route::get('/otp/validate', function () { return view('validate-otp'); })->name('validate.otp');

Route::get('/mailbox', function () { return view('mailbox'); })->name('mailbox');

Route::get('/ai-chatbot', function () { return view('ai-chatbot'); })->name('ai.chatbot');