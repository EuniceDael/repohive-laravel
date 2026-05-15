<?php

use App\Http\Controllers\SmsController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::post('/send-otp', function (Request $request) {
    if ($request->phone) {
        return app(SmsController::class)->sendSms($request);
    } elseif ($request->email) {
        return app(EmailController::class)->sendEmail($request);
    }
    return response()->json(['error' => 'Phone or email required'], 400);
});