<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/send-otp', function (Request $request) {
    return response()->json([
        'success' => true,
        'message' => 'OTP sent successfully',
        'phone'   => $request->phone,
        'email'   => $request->email,
        'otp'     => '123456'
    ]);
});