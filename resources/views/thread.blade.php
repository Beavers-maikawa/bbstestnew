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
    <header class="header">
        <h1 class="site-title">建設掲示板</h1>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <ul>
                            <li><h2>{{$thread->id}}:{{$thread->title}}</h2></li>
                            <li><a href="{{route('contact',$thread->id)}}">投稿者：{{$thread->name}}</a> {{$thread->created_at}}</li>
                            <li>{!! nl2br(e($thread->content))!!}</li>
                        </ul>
                    </div>
                    @if($thread->comments->isNotEmpty())
                    <div class="card-body">
                        @foreach($thread->comments as $comment)
                        <ul class="bb-1">
                            <li><a href="{{route('contactcomment',$comment->id)}}">返信者：{{$comment->name}}</a> {{$comment->created_at}}</li>
                            <li>{!! nl2br(e($comment->commnet))!!}</li>
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
        </div>
    </div>
    <footer class="footer">
        <small>©建設掲示板</small>
    </footer>
</body>
</html>
