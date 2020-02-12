<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;

class QuestionImport implements OnEachRow
{


    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();
//        similar_text("天空为什么是蓝色的","是蓝色的呢天空为啥",$percent);
//        echo $percent. "%";
//        die;
//        // 不处理第一行
        if ($rowIndex == 1) return true;


        // 处理试题类型
        $question = $row[0];
        $questionLevel = $row[1];
        $questionType = $row[2];
        $questionOptions = $row[3]; // 处理一下选项
        $questionAnswer = $row[4] ?? "";
        $questionSubjectId = $row[5];
        $questionReference = $row[6];


        switch ($questionType) {
            case Question::SINGLE_CHOICE:
            case Question::MULTIPLE_CHOICE:
                $questionOptions = explode("\n", $questionOptions);
                break;
            case Question::JUDGE:
                if ($questionAnswer == "正确" || $questionAnswer == "对" || $questionAnswer == "√" || $questionAnswer == "A") {
                    $questionAnswer = "A";
                } else {
                    $questionAnswer = "B";
                }
                break;
        }

        
        Question::create([
            'question' => $question,
            'type' => $questionType,
            'level' => $questionLevel,
            'options' => $questionOptions,
            'answer' => $questionAnswer,
            'subject_id' => $questionSubjectId,
            'reference_answer' => $questionReference,
        ]);
    }

}
