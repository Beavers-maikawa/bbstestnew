@extends('layout')

@section('content')
<div class="col-md-12">
    <h4>{{ $comment->name}}さんへメール</h4>
    <form method="POST" action="{{route('sendComment')}}">
        @csrf
        タイトル：<input type="text" name="title" required><br>
        名前：<input type="text" name="name" required><br>
        Email:<input type="email" name="email" required><br>
        内容<textarea name="contact"></textarea><br>
        <button type="submit">送信する</button>
        <button>
            <a href="{{ route('thread',$comment->thread_id)}}">スレッドへ戻る</a>
        </button>
    </form>
</div>
@endsection
