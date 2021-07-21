<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TestMail;
use Mail;

class TestJobMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email, $names;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $names)
    {
        $this->email = $email;
        $this->names = $names;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Mail::to($this->email)->send(new Testmail("ttt"));

        $email = $this->email;
        $names = $this->names;

        foreach(array_keys($email) as $i){
            Mail::to($email[$i])->send(new Testmail($names[$i]));
        }
    }
}
