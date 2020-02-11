<?php

namespace App\Http\Controllers\Attachment;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentRequest;
use App\Imports\ExamSiteImport;
use App\Imports\StudentImport;
use App\Models\ExamSite;
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
     * 根据不同用户模型导入用户
     *
     * @param Request $request
     */
    public function __construct(AttachmentRequest $request)
    {
        $this->attachment = $request->file($this->attachmentField);
    }

    /**
     * 导入学生花名册
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function student()
    {
        Excel::import(new StudentImport, $this->attachment);
        return $this->success();
    }

    /**
     * 导入考试站信息
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function examSite()
    {
        Excel::import(new ExamSiteImport, $this->attachment);
        return $this->success("导入成功");
    }

}
