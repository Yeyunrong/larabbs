<?php
//辅助类文件
use Illuminate\Support\Facades\Route;

//该方法会将当前请求的路由名称转换为CSS类名称，作用是允许我们针对某个页面做样式定制。
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

//用来显示话题分类
function category_nav_active($category_id)
{
    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}
