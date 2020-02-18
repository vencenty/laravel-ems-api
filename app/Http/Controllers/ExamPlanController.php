<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillExamArrangeRequest;
use App\Models\ExamPlan;
use App\Models\ExamRoom;
use App\Models\ExamSite;
use App\Models\SkillExamArrange;
use App\Models\Subject;
use App\Models\SubjectLevel;
use App\Models\TheoryExamArrange;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(ExamPlan::getList([
            'with' => [
                'skillExamArranges',
                'theoryExamArranges'
            ]
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillExamArrangeRequest $request)
    {
        $requestParams = $request->json()->all();
        DB::beginTransaction();

//        $requestParams = [
//            'in_plan' => true, // 是否年度计划内
//            'num' => mt_rand(0, 1000), // 考试人数
//            'status' => ExamPlan::APPROVING, // 默认进来是审批中,
//            'subject_id' => Subject::inRandomOrder()->first()->id,
//            'subject_level_id' => SubjectLevel::first()->id,
//            'exam_site_id' => ExamSite::inRandomOrder()->first()->id,
//            'skill_exam_arranges' => [
//                [
//                    'exam_start_time' => now(), // 考试开始时间
//                    'exam_end_time' => now()->addMinute(), // 考试结束时间
//                    'daily_number' => 50, // 每日活跃人数id
//                    'supervisor_id' => 3, // 考评员ID
//                    'assess_leader' => 2, // 考评组长ID
//                ],
//                [
//                    'exam_start_time' => now(), // 考试开始时间
//                    'exam_end_time' => now()->addMinute(), // 考试结束时间
//                    'daily_number' => 50, // 每日活跃人数id
//                    'supervisor_id' => 3, // 考评员ID
//                    'assess_leader' => 2, // 考评组长ID
//                ],
//                [
//                    'exam_start_time' => now(), // 考试开始时间
//                    'exam_end_time' => now()->addMinute(), // 考试结束时间
//                    'daily_number' => 50, // 每日活跃人数id
//                    'supervisor_id' => 3, // 考评员ID
//                    'assess_leader' => 2, // 考评组长ID
//                ],
//            ],
//            'theory_Exam_arranges' => [
//
//                [
//                    'exam_type' => ExamRoom::COMMON, // 考试类型
//                    'exam_date' => now(), // 考试日期
//                    'exam_start_time' => now(), // 考试开始时间
//                    'exam_end_time' => now()->addMinute(), // 考试结束时间
//                    'exam_room_id' => ExamRoom::COMMON, // 考场ID,
//                    'num' => 50, //本场考试人数
//                ],
//                [
//                    'exam_type' => ExamRoom::COMMON, // 考试类型
//                    'exam_date' => now(), // 考试日期
//                    'exam_start_time' => now(), // 考试开始时间
//                    'exam_end_time' => now()->addMinute(), // 考试结束时间
//                    'exam_room_id' => ExamRoom::COMMON, // 考场ID,
//                    'num' => 20, //本场考试人数
//                ]
//            ]
//        ];
        // 技能考试安排
        $skillExamArranges = $requestParams['skill_exam_arranges'];
        $theoryExamArranges = $requestParams['theory_Exam_arranges'];
        unset($requestParams['skill_exam_arranges']);
        unset($requestParams['theory_Exam_arranges']);
        // 理论考试安排
        try {
            $examPlan = ExamPlan::create($requestParams);
            $examPlan->skillExamArranges()->createMany($skillExamArranges);
            $examPlan->theoryExamArranges()->createMany($theoryExamArranges);
            DB::commit();
            return $this->success("操作成功");
        } catch (\Exception $exception) {
            // 数据回滚
            DB::rollBack();
            return $this->error(
                env('APP_DEBUG') ? $exception->getMessage() : "Server Error"
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExamPlan $examPlan)
    {
        return $this->success($examPlan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamPlan $examPlan)
    {
        $examPlan->fill($request->post())->saveOrFail();
        return $this->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamPlan $examPlan)
    {
        return $this->success($examPlan->delete());
    }

}
