<?php

namespace App\Http\Controllers;

use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class TrainingPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        TrainingPlan::paginate();
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $trainingPlan = TrainingPlan::create($request->all());
        return $this->success(['id' => $trainingPlan->id]);
    }

    /**
     * 展示
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $model = new TrainingPlan;
        return $this->success(TrainingPlan::find($id));
    }

    /**
     * 更新
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $trainingPlan = TrainingPlan::find($id)->update($request->all());
        return $this->success($trainingPlan);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        if(TrainingPlan::find($id)->delete()) {
            return $this->success("删除成功");
        }

        return $this->error("删除失败");
    }
}
