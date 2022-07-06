<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //返回基础视图-首页
    public function root()
    {
        return view('pages.root');
    }
}
