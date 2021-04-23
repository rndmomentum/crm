<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Illuminate\Contracts\Queue\ShouldQueue;

// class StudentImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
class StudentImport implements ToModel, WithChunkReading, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $student = Student::orderBy('id','Desc')->first();

        // $auto_inc = $student->id + 1;
        // $stud_id = 'MI' . 0 . 0 . $auto_inc;
        
        if(Student::where('ic', $row['ic'])->exists()){
        }else{
            return new Student([
                // 'stud_id'    => $stud_id,
                'stud_id'    => $row['stud_id'],
                'first_name' => $row['first_name'],
                'last_name'  => $row['last_name'], 
                'ic'         => $row['ic'],
                'email'      => $row['email'],
                'phoneno'    => $row['phoneno'],
                'product_id'    => $row['product_id'],
                'package_id'    => $row['package_id'],
                
            ]);
        }
        
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
