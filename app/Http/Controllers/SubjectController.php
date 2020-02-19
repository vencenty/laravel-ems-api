<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * 展示列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(Subject::getList());
    }

    /**
     * 存储资源
     *
     * @param SubjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        return $this->success($request->post());
    }

    /**
     * 展示资源
     *
     * @param Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return $this->success($subject);
    }

    /**
     * 更细资源
     *
     * @param Request $request
     * @param Subject $subject
     * @throws \Throwable
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->fill($request->post())->saveOrFail();
        $this->success();
    }

    /**
     * 删除资源
     *
     * @param Subject $subject
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Subject $subject)
    {
        return $this->success($subject->delete());
    }
}
