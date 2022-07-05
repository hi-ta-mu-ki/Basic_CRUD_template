<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body class="d-flex flex-column">
  <!-- ヘッダー -->
  @include('layouts.parts.header_member')
  <div class="container">
    <div class="row" id="content">
      <div class="col-lg-3">
        <!-- サイドバー -->
        @include('layouts.parts.sidebar_member')
      </div>
      <div class="col-lg-9">
        <!-- コンテンツ -->
        @yield('content')
      </div>
    </div>
  </div>
  <!-- フッター -->
  @include('layouts.parts.footer')
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  @yield('btn-dell')
  <!--削除確認処理-->
</body>

</html>