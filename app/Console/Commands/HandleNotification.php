<?php

namespace App\Console\Commands;

use App\Models\Todo;
use App\Models\Admin\Patient;
use App\Mail\TodoNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class HandleNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'handle:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $patients = Patient::with(['todos' => fn($q) => $q->where('status', 0)])->get();

        foreach($patients as $patient) {

            if(count($patient->todos) > 0)
            {
                Mail::to($patient->email)->send(new TodoNotification($patient));

            }

        }
    }
}
