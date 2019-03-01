<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    // }


    // Must be public    
    public $pathToFile;
    
    public $event;

    public function __construct($pathToFile, $event)
    {
        $this->pathToFile= $pathToFile;
        $this->event = $event;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from('hello@app.com', 'От Вашего приложения')
        ->subject('Ваше напоминание!')
        ->view('emails.reminder')
        ->attach(public_path('/images').'/cat.jpg', [
            'as' => 'cat.jpg',
            'mime' => 'image/jpeg',
    ]);

    
    }
}
