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
            <div class="col-md-12 searchformWrapper">
                <form method="GET" action="{{ route('index') }}">
                    @csrf
                    <input type="search" placeholder="検索語句を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
                    <button class="btn-primary" type="submit">検索</button>
                    <button class="btn-secondary">
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
                            <li><a href="{{route('thread',$thread->id)}}">{{$thread->id}}:{{$thread->title}} 投稿者：{{$thread->name}} {{$thread->created_at}}</a></li>
                            <!--<li>{!! nl2br(e($thread->content))!!}</li>-->
                            @if($thread->comments->isNotEmpty())
                            <li>
                                <ul class="comment_list">
                                    @foreach($thread->comments as $comment)
                                    <li>返信者：{{$comment->name}} {{$comment->created_at}}</li>
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
        </div>
    </div>
    <footer class="footer">
        <small>©建設掲示板</small>
    </footer>
</body>
</html>
