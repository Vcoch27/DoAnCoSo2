<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PremiumUpgradeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $subscription;
    public $user;

    public function __construct($subscription, $user)
    {
        $this->subscription = $subscription;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Welcome to Premium Membership!')
            ->view('emails.premium-upgrade')
            ->with([
                'subscription' => $this->subscription,
                'user' => $this->user,
            ]);
    }
}
