<?php

namespace App\Exports;
use App\Models\School;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SchoolQuotaExport implements FromCollection , WithHeadings
{

    public function  __construct($category_id)
    {

        $this->category_id= $category_id;

    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return School::select('school_name','school_code')->where('category_id',$this->category_id)
            ->where('school_code','!=','ADMINSCHOOL')
            ->get();
    }

    public function headings(): array
    {
        return ['School_Name','School_code','Quota'];

    }
}
