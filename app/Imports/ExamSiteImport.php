<?php

namespace App\Imports;

use App\Models\ExamSite;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class ExamSiteImport implements OnEachRow
{
    use Importable;

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        if ($rowIndex == 1) return;

        ExamSite::create([
            'sn' => $row[0],
            'name' => $row[1],
            'username' => $row[2],
            'password' => bcrypt($row[3]),
            'address' => $row[4],
            'contact_person' => $row[5],
            'contact_mobile' => $row[6],
        ]);
    }

}
