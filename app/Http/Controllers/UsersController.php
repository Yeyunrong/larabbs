<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

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

    /**
     * 显示编辑页面
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * 处理表单提交
     */
    public function update(UserRequest $request,ImageUploadHandler $uploader, User $user)
    {
        $data = $request->all();
        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
