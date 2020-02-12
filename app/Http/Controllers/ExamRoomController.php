<?php

namespace App\Http\Controllers;

use App\Models\ExamRoom;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ExamRoomController extends Controller
{

    public function index()
    {
        return $this->success(ExamRoom::getList([], [
            'callback' => function ($model) {
                $model->name = '傻逼' . $model->name;
            }
        ]));
    }


    public function store(Request $request)
    {
        return $this->success(
            ExamRoom::firstOrCreate($request->all(), $request->only('name'))
        );
    }


    public function show($id)
    {
        return $this->success(
            ExamRoom::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        if (ExamRoom::find($id)->fill($request->all())->save()) {
            return $this->success();
        }
        return $this->error();
    }


    public function destroy($id)
    {
        if (ExamRoom::destroy($id)) {
            return $this->success();
        };
        return $this->error();

    }
}
