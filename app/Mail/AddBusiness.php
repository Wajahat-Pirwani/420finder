<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddBusiness extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public function __construct($data)
    {
        //
        return $this->data= $data;
    }

    public function build()
    {
        return $this->subject('New Business Added')->view('emails.business.new_business',['data' => $this->data]);
    }
}
