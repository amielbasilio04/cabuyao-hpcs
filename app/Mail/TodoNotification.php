<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TodoNotification extends Mailable implements ShouldQueue
{
   
    public $patient;

    public function __construct($patient)
    {
         $this->patient = $patient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('maternityaideapp@gmail.com')
                    ->subject('Todo Update')
                    ->markdown('emails.patient.notify_todo', [
                        'url' => route('user.todo.index')
                    ]);
    }
}
