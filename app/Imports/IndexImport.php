<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\HoldStudents;
use Auth;
use App\Models\School;
use App\Models\SchoolQuota;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IndexImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function  __construct($year,$school_id, $quota_id, $index_id)
    {
        $this->year= $year;
        $this->school_id= $school_id;
        $this->quota_id= $quota_id;
        $this->index_id= $index_id;
    }
    public function collection(Collection $rows)
    {

        //echo $this->year.' - '.$this->school_id.' - '.$this->quota_id.' - '.$this->index_id; exit;

        $i=1;
        foreach ($rows as $row) {
//echo "<pre>";
            //print_r($row); exit;

           // $index_number   ='PCN/'.Auth::user()->school->school_code.'/'.substr($this->year, -2).'/'.sprintf("%04d", $i);
           // $student->index_number        =   $index_number;

            $student = new HoldStudents;
            $student->school_id         =   $this->school_id;
            $student->quota_id        =   $this->quota_id;
            $student->index_id        =   $this->index_id;

            $student->first_name        =   $row['firstname'];
            $student->middle_name        =   $row['middlename'];
            $student->last_name        =   $row['lastname'];
            $student->email        =   $row['email'];
            $student->phone        =   $row['phone'];
            $student->religion        =   $row['religion'];
            $student->marital_status        =   $row['marital_status'];
            $student->gender        =   $row['gender'];
            $student->date_of_birth        =   Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']));
            $student->place_of_birth        =   $row['place_of_birth'];
            $student->state_of_origin        =   $row['state_of_origin'];
            $student->lga        =   $row['lga'];
            $student->home_address        =   $row['home_address'];
            $student->name_of_nok        =   $row['name_of_nok'];
            $student->address_of_nok        =   $row['addredd_of_nok'];
             $student->name_of_parent        =   $row['name_of_parent'];
            $student->address_of_parent        =   $row['address_of_parent'];
            $student->date_admitted        =  Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_admitted']));
            $student->admission_number        =   $row['admission_number'];
            $student->qualification_one        =   $row['qualification_1'];
            $student->qualification_one_date        =   Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['qualification_date_1']));
            $student->qualification_two        =   $row['qualification_2'];
            $student->qualification_two_date        =   Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['qualification_date_2']));
            $student->qualification_three        =   $row['qualification_date_3'];
            $student->qualification_three_date        =   Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['qualification_date_3']));
            $student->qualification_four        =   $row['qualification_4'];
            $student->qualification_four_date        =   Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['qualification_date_4']));
            $student->qualification_five        =   $row['qualification_5'];
            $student->qualification_five_date        =   Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['qualification_date_5']));

            if($row['firstname']!='' && $row['lastname']!=''){
                $student->save();
                $i++;
            }
        }
    }
}
