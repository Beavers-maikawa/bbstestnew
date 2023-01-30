<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    @vite(['resources/sass/app.scss','resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div class="container">
        <div class="row">
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
                    <input type="hidden" name="toEmail" value="{{$thread->email}}">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
