<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;

/**
 * 话题列表
 */
class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * 分页查询
     */
	public function index()
	{
        //使用with 进行预加载
		$topics = Topic::with('user', 'category')->paginate(30);
		return view('topics.index', compact('topics'));
	}

    /**
     * 显示详情
     */
    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    /**
     * 创建页面
     */
	public function create(Topic $topic)
	{
		return view('topics.create_and_edit', compact('topic'));
	}

    /**
     * 处理创建提交
     */
	public function store(TopicRequest $request)
	{
		$topic = Topic::create($request->all());
		return redirect()->route('topics.show', $topic->id)->with('message', 'Created successfully.');
	}

    /**
     * 编辑
     */
	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		return view('topics.create_and_edit', compact('topic'));
	}

    /**
     * 处理编辑
     */
	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('message', 'Updated successfully.');
	}

    /**
     * 删除
     */
	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
	}
}
