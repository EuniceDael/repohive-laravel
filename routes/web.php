<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/otp-phone', function () {
    return view('otp-phone');
})->name('otp.phone');

Route::get('/otp-email', function () {
    return view('otp-email');
})->name('otp.email');

Route::get('/validate-otp', function () {
    return view('validate-otp');
})->name('validate.otp');

Route::get('/mailbox', function () {
    return view('mailbox');
})->name('mailbox');

Route::get('/ai-chatbot', function () {
    return view('ai-chatbot');
})->name('ai.chatbot');
