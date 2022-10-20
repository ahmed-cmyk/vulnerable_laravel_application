<?php

namespace App\Http\Controllers;

use App\Mail\AccountRecovery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AccountRecoveryController extends Controller
{
    public function sendResetToken(Request $request)
    {
        $resetToken = rand(1000,9999);
        Mail::to($request->user())->send(new AccountRecovery($resetToken));

        
    }
}
