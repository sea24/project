<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    //
    public function imgUpload(Request $request)
    {

        if ($request->isMethod('POST')) {
            $file = $request->file('mypic');

            //判断文件是否上传成功
            if ($file->isValid()) {
                //获取原文件名
                $originalName = $file->getClientOriginalName();
                //扩展名
                $ext = $file->getClientOriginalExtension();
                //文件类型
                $type = $file->getClientMimeType();
                //临时绝对路径
                $realPath = $file->getRealPath();

                $size = $file->getSize();
                $filename = md5(time()).'-'.uniqid().".jpg";

                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));

                    $arr = array ('data'=>[asset('storage/'.$filename)],'errno'=>0);
                    return $arr;


            }
        }
    }
}
