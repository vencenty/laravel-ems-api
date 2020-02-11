<?php

namespace App\Http\Controllers;

use App\Models\ExamRoom;
use Illuminate\Http\Request;

class ExamRoomController extends Controller
{

    public function index()
    {
        $model = new ExamRoom();

//        ExamRoom::when('people_limit', function (){})

        return $this->success(ExamRoom::paginate());
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
        if(ExamRoom::destroy($id)) {
            return $this->success();
        };
        return $this->error();

    }
}
