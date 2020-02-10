<?php

namespace App\Imports;

use App\Exceptions\ExcelFormatErrorException;
use App\Models\ExamSite;
use Illuminate\Contracts\Queue\ShouldQueue;
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

        if (count($row) != 7) {
            throw new ExcelFormatErrorException("Excel格式不正确,请严格按照[考试站编号,考试站名称,考试站账号,考试站密码,考试站地址,联系人,联系电话]顺序填写");
        }

        ExamSite::create([
            'sn' => $row[0], // 考试站编号
            'name' => $row[1], // 考试站名称
            'username' => $row[2], // 用户名
            'password' => bcrypt($row[3]), // 考试站密码
            'address' => $row[4], // 考试站地址
            'contact_person' => $row[5], // 考试站联系人
            'contact_mobile' => $row[6], // 考试站联系电话
        ]);
    }

}
