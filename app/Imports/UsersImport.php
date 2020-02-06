<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class UsersImport implements OnEachRow
{
    use Importable;

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        if ($rowIndex == 1) return;

        $name = $row[0]; // 真实姓名
        $username = $row[1]; // 用户名

        // 不处理没有身份证号和真实姓名的记录
        if(empty($username) || empty($name)) return;

        $password =  bcrypt(substr($username, -6));

        User::create([
            'name' => $name,
            'username' => $username,
            'password' => $password
        ]);


    }

}
