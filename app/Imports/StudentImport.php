<?php

namespace App\Imports;

use App\Exceptions\ExcelFormatErrorException;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Row;
use Throwable;

class StudentImport implements OnEachRow
{



    /**
     * 逐行处理EXCEL文件
     *
     * @param Row $row
     * @throws ExcelFormatErrorException
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();


        if ($rowIndex == 1) {
            return true;
        }


        $name = $row[0]; // 真实姓名
        $username = $identity = $row[1]; // 身份证号

        // 不处理没有身份证号和真实姓名的记录
        if (empty($username) || empty($name)) return true;

        $password = bcrypt(substr($username, -6));
        // 根据身份证号来进行更新
        Student::updateOrCreate(['username' => $username], ['password' => $password, 'name' => $name, 'identity' => $identity]);
    }

}
