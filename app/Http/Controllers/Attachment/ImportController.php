<?php

namespace App\Http\Controllers\Attachment;

use App\Components\ApiError;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentRequest;
use App\Imports\ExamSiteImport;
use App\Imports\QuestionImport;
use App\Imports\RosterImport;
use App\Imports\StudentImport;
use App\Imports\SupervisorImport;
use App\Models\Supervisor;
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
     * 导入学生
     *
     * @return \Illuminate\Http\Response
     */
    public function student()
    {
        Excel::import(new StudentImport, $this->attachment);
        return $this->success();
    }

    /**
     * 导入考试站信息
     *
     * @return \Illuminate\Http\Response
     */
    public function examSite()
    {
        Excel::import(new ExamSiteImport, $this->attachment);
        return $this->success("导入成功");
    }

    /**
     * 导入试题
     *
     * @return \Illuminate\Http\Response
     */
    public function question()
    {
        $questionImport = new QuestionImport;

        Excel::import(new QuestionImport, $this->attachment);
        return $this->success([
            'success_row' => $questionImport::$successRow,
            'failure_row' => $questionImport::$failureRow,
            'similar_question' => $questionImport::$similarQuestions
        ]);
    }

    /**
     * 导入监察老师
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function supervisor(Request $request)
    {
        $role = $request->post('role');

        if (!$role || !in_array($role, [Supervisor::EVALUATE_STAFF, Supervisor::MONITOR_STAFF])) {
            return $this->error(ApiError::UNKONW_ROLE);
        }


        Excel::import(new SupervisorImport($role), $this->attachment);

        return $this->success("导入成功");
    }


    /**
     * 导入学生花名册
     *
     * @return \Illuminate\Http\Response
     */
    public function roster()
    {
        $roster = Excel::toCollection(new RosterImport(), $this->attachment)[0];

        $student = [];

        foreach ($roster as $rowIndex => $row) {
            if ($rowIndex == 0) {
                continue;
            }

            array_push($student, [
                'name' => $row[0],
                'identity' => $row[1],
                'contact' => $row[2],
                'theory_score' => $row[3],
                'skill_score' => $row[4],
            ]);

        }

        return $this->success([
            'roster' => $student
        ]);
    }


}
