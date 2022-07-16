@if (count($topics))
  <ul class="list-unstyled">
    @foreach ($topics as $topic)
      <li class="media">

        {{-- 用户头像和名称 --}}
        <div class="media-left">
          <a href="{{ route('users.show', [$topic->user_id]) }}">
            <img class="media-object img-thumbnail mr-3" style="width:52px; height:52px;" src="{{ $topic->user->avatar }}" title="{{ $topic->user->name }}">
          </a>
        </div>

        {{-- 话题内容 --}}
        <div class="media-body">
          <div class="media-heading mt-0 mt-1">
            <a href="{{ route('topics.show', [$topic->id]) }}" title="{{ $topic->title }}">
              {{ $topic->title }}
            </a>
            <a class="float-right" href="{{ route('topics.show', [$topic->id]) }}">
              <span class="badge badge-secondary badge-pill">
                {{ $topic->reply_count }}
              </span>
            </a>
          </div>

          {{-- 分类名称 --}}
          <small class="media-body meta text-secondary">
            <a class="text-secondary" href="{{ route('categories.show', $topic->category_id) }}" title="{{ $topic->category->name }}">
              <i class="far fa-user"></i>
              {{ $topic->category->name }}
            </a>

            <span> • </span>
            <a class="text-secondary" href="{{ route('users.show',[$topic->user_id]) }}" title="{{ $topic->user->name }}">
              <i class="far fa-user"></i>
              {{ $topic->user->name }}
            </a>

            <span> • </span>
            <i class="far fa-user"></i>
            <span class="timego" title="最后活跃于:{{ $topic->update_at }}">{{ $topic->updated_at->diffForHumans() }}</span>
          </small>
        </div>
      </li>

      @if (! $loop->last)
          <hr>
      @endif

    @endforeach
  </ul>

@else
  <div class="empty-block">暂无数据 ～_～ </div>
@endif
