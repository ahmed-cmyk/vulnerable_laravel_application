<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountRecovery extends Mailable
{
    use Queueable, SerializesModels;

    protected $resetToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetToken)
    {
        $this->resetToken = $resetToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Password Recovery Request')
                    ->view('emails.account_recovery')
                    ->with([
                        'resetToken' => $this->resetToken,
                    ]);
    }
}
