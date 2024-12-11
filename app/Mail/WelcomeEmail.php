<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // Thuộc tính để lưu trữ thông tin người dùng

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user; // Gán người dùng cho thuộc tính $user
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Chào mừng đến với Trang web của chúng tôi!', // Đặt tiêu đề email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'client.emails.welcome', // Chỉ định view cho email
            with: [
                'user' => $this->user, // Truyền dữ liệu người dùng vào view
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
