<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\InvoiceRemindEmail;
use App\Email;
use App\Student;
use Mail;

class InvoiceJobMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $student_ids;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($student_ids)
    {
       $this->student_ids = $student_ids;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Mail::to($this->email)->send(new Testmail("ttt"));
        $student_ids = $this->student_ids;

        $students = Student::whereIn('stud_id', $student_ids->pluck('stud_id'))->get();

        for($i=0; $i < count($students); $i++){
            if(isset($students[$i]['email'])){
				$email = $students[$i]['email'];
            
                Mail::to($email)->send(new InvoiceRemindEmail($student_ids[$i], $students[$i]));
                
			}else{
				return false;
			}
        }
    }
}
