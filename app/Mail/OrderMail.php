<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $filename;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $filename)
    {
        $this->order = $order;
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $path = 'pdf/'.$this->filename;

        return $this->subject('Aircon Order')->view('mail.orderMail')
            ->attach(public_path($path), [
                'as' => $this->filename,
                'mime' => 'application/pdf',
            ]);
    }
}
