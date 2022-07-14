<?php

namespace App\Handlers;

use Str;
use Image;

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
     * $max_width 限制图片宽度
     */
    public function save($file, $folder, $file_prefix, $max_width)
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

        //如果限制了图片宽度，就进行裁剪
        if ($max_width && $extension != 'gif') {
            //此类中封装的函数,用于裁剪图片
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url') . "/$floder_name/$filename"
        ];
    }

    /**
     * 用于裁剪图片
     * $file_path 文件路径
     * $max_width 设定宽度限制，等比例缩放高度
     */
    public function reduceSize($file_path, $max_width)
    {
        $image = Image::make($file_path);

        //进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {
            //设定宽度是 $max_width,高度等比例缩放
            $constraint->aspectRatio();

            //防止截图时图片尺寸变大
            $constraint->upsize();
        });

        //对图片进行保存
        $image->save();
    }
}
