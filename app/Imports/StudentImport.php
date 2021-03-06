<?php

namespace App\Imports;

use App\Student;
use App\Payment;
use App\Ticket;
// use App\Jobs\TestJobMail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToCollection, WithChunkReading, WithHeadingRow
{
    // private $prd_id, $pkd_id, $email_id, $regex_content;
    private $prd_id, $pkd_id, $user_id;

    // public function __construct($prd_id, $pkd_id, $email_id, $regex_content){
    public function __construct($prd_id, $pkd_id, $user_id){
        $this->product = $prd_id;
        $this->package = $pkd_id;
        $this->user_id = $user_id;
        // $this->email_id = $email_id;
        // $this->regex_content = $regex_content;
    }

    public function collection(Collection $rows)
    {
        // dump($rows[2]);
        
        foreach ($rows as $row) 
        {
            $student = Student::where('ic', $row['ic'])->first();
            
            if(Student::where('ic', $row['ic'])->exists()){

                // $payment_id = 'OD' . uniqid();

                Payment::create([
                    'payment_id'    => 'OD' . uniqid(),
                    'pay_price'     => $row['price'], 
                    'quantity'      => $row['quantity'],
                    'totalprice'    => $row['payment'],
                    'status'        => $row['status'],
                    'pay_method'    => $row['pay_method'], 
                    'email_status'  => 'Hold',
                    'stud_id'       => $student->stud_id,
                    'offer_id'      => $row['offer_id'], 
                    'product_id'    => $this->product,
                    'package_id'    => $this->package,
                    'user_id'       => $this->user_id,
                ]);

            }else{
                
                $stud_id = 'MI' . uniqid();

                Student::create([
                    'stud_id'    => $stud_id,
                    'first_name' => ucwords(strtolower($row['first_name'])),
                    'last_name'  => ucwords(strtolower($row['last_name'])), 
                    'ic'         => $row['ic'],
                    'email'      => $row['email'],
                    'phoneno'    => '+' . $row['phoneno'],
                ]);

                // $payment_id = 'OD' . uniqid();

                Payment::create([
                    'payment_id'    => 'OD' . uniqid(),
                    'pay_price'     => $row['price'], 
                    'quantity'      => $row['quantity'],
                    'totalprice'    => $row['payment'],
                    'status'        => $row['status'],
                    'pay_method'    => $row['pay_method'], 
                    'email_status'  => 'Hold',
                    'stud_id'       => $stud_id,
                    'offer_id'      => $row['offer_id'], 
                    'product_id'    => $this->product,
                    'package_id'    => $this->package,
                    'user_id'       => $this->user_id,
                ]);

            }
        }

        // dispatch(new TestJobMail($rows, $this->email_id, $this->regex_content));
        
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
