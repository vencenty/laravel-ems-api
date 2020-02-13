<?php

namespace App\Imports;

use App\Components\Helper\Excels;
use App\Models\Supervisor;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Spatie\Permission\Models\Role;

class SupervisorImport implements OnEachRow
{
    /**
     * 当前导入的角色
     *
     * @var int
     */
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * 逐行处理Excel文件
     *
     * @param Row $row
     * @return bool
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();


        if ($rowIndex == 1) return true;

        $supervisor = new Supervisor([
            'name' => $row[0],
            'username' => $row[3],
            'exam_site_id' => $row[1],
            'contact' => $row[2],
            'identity' => $row[3],
            'cert_no' => $row[4],
            'expired_at' => Excels::formatDate($row[5]),
            'role' => $this->role,
        ]);


        $supervisor->password = Excels::generatePasswordByIdentity($supervisor->identity);

        Supervisor::updateOrCreate(['identity' => $supervisor->identity],
            $supervisor->makeVisible('password')->attributesToArray()
        );
    }
}
