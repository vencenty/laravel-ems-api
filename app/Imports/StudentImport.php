<?php

namespace App\Imports;

use App\Exceptions\ExcelFormatErrorException;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;
use mysql_xdevapi\Exception;

class StudentImport implements OnEachRow
{
    use Importable;

    /**
     * 逐行处理EXCEL文件
     * @param Row $row
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        if (count($row) != 2) {
            throw new ExcelFormatErrorException("Excel格式不正确,请严格按照[学生姓名,身份证号]填写");
        }

        if ($rowIndex == 1) return;

        $name = $row[0]; // 真实姓名
        $username = $identity = $row[1]; // 身份证号

        // 不处理没有身份证号和真实姓名的记录
        if (empty($username) || empty($name)) return;

        $password = bcrypt(substr($username, -6));
        // 根据身份证号来进行更新
        Student::updateOrCreate(['username' => $username], ['password' => $password, 'name' => $name, 'identity' => $identity]);
    }

}
