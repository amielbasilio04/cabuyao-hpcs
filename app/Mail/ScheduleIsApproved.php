<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleIsApproved extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $date_time;

    public function __construct($date_time)
    {
         $this->date_time = $date_time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('maternityaideapp@gmail.com')
                    ->subject('Schedule Request Update')
                    ->markdown('emails.patient.schedule_is_approved', [
                        'url' => url('/')
                    ]);
    }
}
