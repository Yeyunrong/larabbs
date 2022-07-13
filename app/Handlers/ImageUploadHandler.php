<?php

namespace App\Handlers;

use Illuminate\Support\Str;

/**
 * 公共帮助类，用来处理图片上传保存
 */
class ImageUploadHandler
{
    /**
     * 支持的图片上出格式
     */
    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg'];

    /**
     * 保存处理
     * $file 传递进来的文件
     * $folder 保存文件的指定位置
     * $file_prefix 文件前缀名
     */
    public function save($file, $folder, $file_prefix)
    {
        //构建存储的文件夹规则
        //文件夹切割能让查找效率更高
        $floder_name = "uploads/images/$folder/" . date("Ym/d", time());

        //文件具体存储的物理路径 ‘public_path()’ 获取的是 ‘public’ 文件夹的物理路径值。
        $upload_path = public_path() . '/' . $floder_name;

        //获取文件的后缀名，因图片从剪贴板里面粘贴时后缀名为空，所以此处确保后缀名一致存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        //拼接文件名，加前缀是为了增加辨析度， 前缀可以是相关数据模型的ID
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        //如果上传的不是图片将终止操作
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        //将图片移动到我们的目标存储路径中
        $file->move($upload_path, $filename);

        return [
            'path' => config('app.url') . '/$folder_name/$filename'
        ];
    }
}
