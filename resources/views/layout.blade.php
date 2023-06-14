<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>建設掲示板テスト</title>
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
  <link rel="icon" href="{{asset('images/favicon.ico')}}">
  @vite(['resources/sass/app.scss','resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <header class="header">
        <h1 class="site-title">建設掲示板</h1>
    </header>
    <div class="container">
        <div class="row">

        @yield('content')

        </div>
    </div>
     <footer class="footer">
        <small>©建設掲示板</small>
    </footer>
</body>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</body>
</html>
