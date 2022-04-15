<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BirthdayMail extends Mailable
{
    use Queueable, SerializesModels;

    private $employeeName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employeeName)
    {
        $this->employeeName = $employeeName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Happy Birthday')->view('mail.birthday', [
            'name' => $this->employeeName,
            'CompanyName' => 'Realm Digital'
        ]);
    }
}
