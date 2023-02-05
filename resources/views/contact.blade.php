@extends('layout')

@section('content')
<div class="col-md-12">
    <h4>{{ $thread->name}}さんへメール</h4>
    <form method="POST" action="{{route('send')}}">
        @csrf
        タイトル：<input type="text" value="Re:{{ $thread->title }}" disabled><br>
        <input type="hidden" name="title" value="Re:{{$thread->title}}">
        名前：<input type="text" name="name" required><br>
        Email:<input type="email" name="email" required><br>
        内容<textarea name="contact"></textarea><br>
        <button type="submit">送信する</button>
        <button>
            <a href="{{ route('thread',$thread->id)}}">スレッドへ戻る</a>
        </button>
    </form>
</div>
@endsection
