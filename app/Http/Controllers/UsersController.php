<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

/**
 * 用户控制器处理
 */
class UsersController extends Controller
{
    /**
     * 个人页面展示
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
