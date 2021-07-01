<?php

namespace App\Exports;

use App\Models\Student;
use DB;
//use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsAprrovedExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function  __construct($index_id)
    {
        $this->index_id= $index_id;
    }
    public function collection()
    {
        return Student::select('index_number','first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'religion',
        'marital_status',
        'gender',
         DB::raw('DATE_FORMAT(date_of_birth, "%d/%m/%Y") as formatted_dob'),
        'place_of_birth',
        'state_of_origin',
        'lga','home_address',
        'name_of_nok',
        'address_of_nok',
        'name_of_parent',
        'address_of_parent',
            DB::raw('DATE_FORMAT(date_admitted, "%d/%m/%Y") as date_admitted'),
        'admission_number',
        'qualification_one',
            DB::raw('DATE_FORMAT(qualification_one_date, "%d/%m/%Y") as qualification_one_date'),
        'qualification_two',
            DB::raw('DATE_FORMAT(qualification_two_date, "%d/%m/%Y") as qualification_two_date'),
        'qualification_three',
            DB::raw('DATE_FORMAT(qualification_three_date, "%d/%m/%Y") as qualification_three_date'),
        'qualification_four',
            DB::raw('DATE_FORMAT(qualification_four_date, "%d/%m/%Y") as qualification_four_date'),
        'qualification_five',
            DB::raw('DATE_FORMAT(qualification_five_date, "%d/%m/%Y") as qualification_five_date')
        )->where(['index_id'=>$this->index_id])->get();
    }
    public function headings(): array
    {
        return ['index_number','first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'religion',
        'marital_status',
        'gender',
            'date_of_birth',
        'place_of_birth',
        'state_of_origin',
        'lga','home_address',
        'name_of_nok',
        'address_of_nok',
        'name_of_parent',
        'address_of_parent',
        'date_admitted',
        'admission_number',
        'qualification_one',
       'qualification_one_date',
        'qualification_two',
        'qualification_two_date',
        'qualification_three',
        'qualification_three_date',
        'qualification_four',
        'qualification_four_date',
        'qualification_five',
        'qualification_five_date'];

    }
}
