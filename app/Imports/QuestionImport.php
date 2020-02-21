<?php

namespace App\Imports;

use App\Models\ExamRoom;
use App\Models\Question;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;

class QuestionImport implements OnEachRow
{

    /**
     * 数据库里已有的题目
     *
     * @var Collection
     */
    protected $databaseQuestions;

    /**
     * 提供给外部的接口,拿到这个接口可以获取所有的相似的题目
     * @var
     */
    public static $similarQuestions = [];

    /**
     * 导入成功的题目条数
     *
     * @var int
     */
    public static $successRow = 0;

    /**
     * 导入失败的题目条数
     *
     * @var int
     */
    public static $failureRow = 0;


    /***
     * 导入Excel接口，每次入库的时候首先获取数据库所有题目,然后比对是否有大概率重复的试题,
     * 如果有字符串匹配率超过90%的题目，返给客户端
     */
    public function __construct()
    {
        // 找出数据库里面所有题目
        $this->databaseQuestions = Question::pluck('title');
    }

    /**
     * 检查是否已经有重复的题目了,相似度大于90%会被提出来
     *
     * @param Question $question
     * @return bool
     */
    public function hasSimilarQuestion(Question $question)
    {

        foreach ($this->databaseQuestions as $databaseQuestion) {
            similar_text($question->title, $databaseQuestion, $percent);
            // 如果相似度大于90%, 放入到相似题库里面
            if ((int)$percent > 90) {
                self::$similarQuestions[] = $question;
                return true;
            }
        }


        return false;
    }

    /**
     * 逐行处理Excel内容
     *
     * @param Row $row
     * @return bool
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();


        if ($rowIndex == 1 || is_null($row[0])) return true;


        $question = Question::make([
            'title' => $row[0],
            'options' => $row[1],
            'answer' => $row[2],
            'type' => $row[3],
            'level' => $row[4],
            'subject_id' => $row[5],
            'reference_answer' => $row[6],
        ]);

        // 如果已经有相同试题了,直接返回错误
        if ($this->hasSimilarQuestion($question)) {
            self::$failureRow++;
            return false;
        }


        switch ($question->type) {
            case Question::SINGLE_CHOICE:
            case Question::MULTIPLE_CHOICE:
                $question->options = explode("\n", $question->options);
                break;
            case Question::JUDGE:
                if ($question->answer == "正确" || $question->answer == "对" || $question->answer == "√" || $question->answer == "A") {
                    $question->answer = "A";
                } else {
                    $question->answer = "B";
                }
                break;
        }


        if ($question->saveOrFail()) {
            self::$successRow++;
        } else {
            self::$failureRow++;
        }

        // 如果保存成功了,把当前题目推到数据库队列中,不用每次都查询数据库了
        $this->databaseQuestions->push($question->title);
    }

}
