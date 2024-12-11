<?php

namespace App\Http\Controllers;

use App\Mail\NotifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'subject' => 'Welcome to ProgAccum!',
            'title' => 'Greetings from ProgAccum!',
            'message' => 'We are excited to have you on board. Start exploring now!'
        ];

        try {
            Mail::to('hoangtungmy123@gmail.com')->send(new NotifyUser($details));
            return back()->with('success', 'Email sent successfully to hoangtungmy123@gmail.com');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }
}
