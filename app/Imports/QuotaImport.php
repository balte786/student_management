<?php

namespace App\Imports;

use App\Models\School;
use App\Models\SchoolQuota;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class QuotaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function  __construct($year,$category_id)
    {
        $this->year= $year;
        $this->category_id  =   $category_id;
    }
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $school_id  =   School::where('school_code',$row['school_code'])->first()->id;

            $quota = new SchoolQuota;
            $quota->category_id        =   $this->category_id;
            $quota->school_id         =   $school_id;
            $quota->year           =   $this->year;
            $quota->quota        =   $row['quota'];
            $quota->save();
        }
    }
}
