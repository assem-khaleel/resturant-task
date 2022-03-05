<?php

namespace App\Mail;

use App\Models\Ingredient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Order extends Mailable
{
    use Queueable, SerializesModels;

    protected $ingredient;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ingredient $ingredient)
    {
        $this->ingredient = $ingredient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $ingredient = $this->ingredient;
        $address = 'foodics@gmail.com';
        $subject = 'Be care , your' .$ingredient->name .'is less than 50 %';
        $name = 'Assem Khaleel';

        return $this->view('emails.ingredients')
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with([ 'message' => $this->data['message'] ]);
    }
}
