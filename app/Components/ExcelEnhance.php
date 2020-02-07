<?php

namespace App\Components;

use Maatwebsite\Excel\Row;

trait ExcelEnhance
{
    /**
     * @param Row $row
     */
    public function skipRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        if ($rowIndex == 1) return;
    }
}
