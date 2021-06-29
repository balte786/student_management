<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;

class CountIndexMangamentImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
	
	use Importable;
    public function collection(Collection $collection)
    {
        //
    }
}
