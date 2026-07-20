<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SewaHampirHabisMail extends Mailable
{
    public $user;
    public $penyewaan;

    public function __construct($user,$penyewaan)
    {
        $this->user = $user;
        $this->penyewaan = $penyewaan;
    }

    public function build()
    {
        return $this
            ->subject('Masa Sewa Akan Berakhir')
            ->view('emails.sewa_habis');
    }
}
