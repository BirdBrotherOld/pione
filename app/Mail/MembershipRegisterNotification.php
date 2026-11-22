<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MembershipRegisterNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('pages.emails.membershipnotification')
            ->subject('Terimakasih Sudah Mendaftarkan Diri Sebagai Calon Member Untuk Pajero Indonesia')
            ->with([
                'email' => $this->data['email'],
            ]);
    }
}
