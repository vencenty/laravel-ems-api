<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    public function index()
    {
        return $this->success(Question::getList());
    }

    /**
     * 添加考试题目,如果强制添加,那么不再检查题目相似度
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // 是否强制
        $force = $request->post('force');
        if (!$force) {
            Question::hasSimilar($request->only('title'));
        }
        return $this->success(Question::create(request()->all())->only('id'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->success(
            Question::destroy($id)
        );
    }
}
