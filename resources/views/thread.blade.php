@extends('layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <ul>
                <li><h2>{{$thread->id}}:{{$thread->title}}</h2></li>
                <li><a href="{{route('contact',$thread->id)}}">投稿者：{{$thread->name}}</a> {{$thread->created_at}}</li>
                <li>{!! nl2br(e($thread->content))!!}</li>
                @auth
                <li>
                    <form action="{{route('delete_thread',$thread->id)}}" method="POST">
                        @method("DELETE")
                        @csrf
                        <button type="submit">削除</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
        @if($thread->comments->isNotEmpty())
        <div class="card-body">
            @foreach($thread->comments as $comment)
            <ul class="bb-1">
                <li><a href="{{route('contactcomment',$comment->id)}}">返信者：{{$comment->name}}</a> {{$comment->created_at}}</li>
                <li>{!! nl2br(e($comment->commnet))!!}</li>
                @auth
                <li>
                    <form action="{{route('delete_comment')}}" method="POST">
                        @method("DELETE")
                        @csrf
                        <button type="submit">削除</button>
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <input type="hidden" name="thread_id" value="{{$thread->id}}">
                    </form>
                </li>
                @endauth
            </ul>
            @endforeach
        </div>
        @endif
    </div>
</div>
<div class="col-md-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('comment_store')}}">
                @csrf
                <h3>コメント</h3>
                名前<input type="text" name="name" required><br>
                Email<input type="email" name="email" required><br>
                コメント<textarea name="comment" required></textarea><br>
                <input type="hidden" name="thread_id" value="{{$thread->id}}">
                <button type="submit" value="">コメントする</button>
                <button>
                    <a href="{{route('index')}}">一覧へ戻る</a>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
