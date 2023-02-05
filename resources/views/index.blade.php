@extends('layout')

@section('content')
<div class="col-md-12 searchformWrapper">
    <form method="GET" action="{{ route('index') }}">
        @csrf
        <input type="search" placeholder="検索語句を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
        <button class="btn-primary" type="submit">検索</button>
        <button tyle="clear" class="btn-secondary">
            <a href="{{ route('index') }}" class="text-white">
                クリア
            </a>
        </button>
    </form>
</div>
<div class="col-md-12">
    <ul>
        @foreach($threads as $thread)
        <li class="top_list">
            <ul>
                <li>{{$thread->id}}：<a href="{{route('thread',$thread->id)}}">{{$thread->title}}</a> 投稿者：{{$thread->name}} {{$thread->created_at}}</li>
                <!--<li>{!! nl2br(e($thread->content))!!}</li>-->
                @if($thread->comments->isNotEmpty())
                <li>
                    <ul class="comment_list">
                        @foreach($thread->comments as $comment)
                        <li>返信 {{$comment->name}} {{$comment->created_at}}</li>
                        @endforeach
                    </ul>
                </li>
                @endif
            </ul>
        </li>
        @endforeach
    </ul>
</div>
<div class="col-md-12">
    <form method="POST" action="{{route('thread_store')}}">
        @csrf
        <h3>新規スレッド作成</h3>
        タイトル<input type="text" name="title" required><br>
        名前<input type="text" name="name" required><br>
        Email<input type="email" name="email" required><br>
        コメント<textarea name="content" required></textarea><br>
        <button type="submit" value="">スレッド作成</button>
    </form>
</div>
<div class="Page navigation example">
    {{$threads->links('pagination::bootstrap-4')}}
</div>
@endsection
