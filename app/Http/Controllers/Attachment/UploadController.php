<?php

namespace App\Http\Controllers\Attachment;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadPhotoRequest;
use App\Models\ExamStudentRoster;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * 保存附件的基础目录
     *
     * @var string
     */
    protected $uploadAttachmentFilePath = 'attachment';

    /**
     * 上传照片
     *
     * @param UploadPhotoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function photo(UploadPhotoRequest $request)
    {

        $photos = $request->file('photos');

        $path = $this->uploadAttachmentFilePath . DIRECTORY_SEPARATOR . 'photos';

        $affectRows = 0;

        /** @var  $photo UploadedFile */
        foreach ($photos as $photo) {
            if (!$photo->isValid()) {
                return $this->error("{$photo->getClientOriginalName()} 图片不合法");
            };
            $fileName = $photo->storeAs($path, $photo->getClientOriginalName());
            $identity = pathinfo($fileName)['filename'] ?? null;


            if (ExamStudentRoster::updateOrCreate(['identity' => $identity], ['photo' => $fileName])) {
                $affectRows++;
            }
        }

        return $this->success([
            'affect_rows' => $affectRows,
        ]);


    }

}
