<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;


class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $email;
    public $emailData;
    public function __construct($email, $emailData)
    {
        $this->email = $email;
        $this->emailData = $emailData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         Mail::to($this->email)->send(
            new WelcomeMail($this->emailData)
        );
    }
}
