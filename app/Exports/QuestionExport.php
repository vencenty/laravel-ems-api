<?php

namespace App\Exports;

use App\Models\Question;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\DefaultValueBinder;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class QuestionExport extends DefaultValueBinder implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents
{

    use Exportable;

    protected $subjectId;



    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
            }
        ];
    }


    /**
     * 通过学科ID来查找
     *
     * @param int $subject
     * @return $this
     */
    public function bySubjectId(int $subject)
    {
        $this->subjectId = $subject;
        return $this;
    }

    /**
     * 导出题库
     *
     * @return bool|Builder
     */
    public function query()
    {
        return Question::query()->where('subject_id', $this->subjectId);
    }

    /**
     * 增加标题
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            '题目',
            '答案',
            '难度',
            '选项',
            '科目ID',
            '类型',
            '参考答案'
        ];
    }


}
