<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

/**
 * 分类控制器
 */
class CategoriesController extends Controller
{
    /**
     * 显示分类页
     */
    public function show(Category $category, Request $request, Topic $topic)
    {
        // 读取分类 ID 关联的话题，并按照每 20 条分页
        $topics = $topic->withOrder($request->order)
                    ->where('category_id', $category->id)
                    ->with('user', 'category')//预加载防止N+1
                    ->paginate(20);

        // 传参变量话题和分类到模板
        return view('topics.index', compact('topics', 'category'));
    }
}
