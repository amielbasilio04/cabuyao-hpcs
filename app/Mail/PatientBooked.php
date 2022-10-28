<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatientBooked extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

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
                    ->subject('Patient Reserved Schedule')
                    ->markdown('emails.patient.booked', [
                        'url' => url('/')
                    ]);
    }
}
