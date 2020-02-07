<?php

namespace App\Http\Controllers\Attachment;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    /**
     * 上传的附件
     * @var Request
     */
    protected $attachment;

    /**
     * 附件字段名
     * @var string
     */
    protected $attachmentField = 'attachment';

    /**
     * 获取上传的附件
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->attachment = $request->file($this->attachmentField);
    }

    /**
     * 导入学生花名册
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        Excel::import(new UsersImport, $this->attachment);
        return $this->success();
    }
}
