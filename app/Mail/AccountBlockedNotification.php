<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountBlockedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $blockDate;

    public function __construct($user, $blockDate)
    {
        $this->user = $user;
        $this->blockDate = $blockDate;
    }

    public function build()
    {
        return $this->subject('Your Account Has Been Blocked')
            ->view('emails.account_blocked');
    }
}
