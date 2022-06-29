<!-- 親テンプレート -->
@extends('layouts.db_sample_admin')

@section('title', 'db_sample_admin')

<!-- 親テンプレートに表示させる場所 -->
@section('content')

@if(Session::has('flashmessage'))
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
  //ページ読み込み後、モーダルを実行
  $(window).on('load', function() {
    $('#modal_box').modal('show');
  });
</script>
<!-- モーダルウィンドウの中身 -->
<div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="label1">Db_Sample</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ session('flashmessage') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
      </div>
    </div>
  </div>
</div>@endif

<div id="page-content">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-12 mt-10 pb-0">
        <h1 class="font-weight-light mt-4">一覧</h1>
        <div class="container mt-5">
          <!-- 検索フォーム -->
          <div class="row pb-30 ms-0 me-15">
            <div class="col-sm-8 ps-0 mb-2">
              <form method="get" action="" class="form-inline">
                <div class="form-group">
                  <input type="text" name="keyword" class="form-control" value="{{$keyword ?? ''}}" placeholder="検索キーワード">
                </div>
            </div>
            <div class="col-sm-2 ps-0">
              <div class="form-group">
                <input type="submit" value="検索" class="btn btn-info ms-15 text-white">
              </div>
              </form>
            </div>
            <div class="col-sm-2 ps-0">
              <a href="/db_sample/b_new" class="btn btn-warning text-white">
                新規登録
              </a>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr class="table-dark">
                  <th scope="col">ID</th>
                  <th scope="col">お名前</th>
                  <th scope="col" colspan="3"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $item)
                <tr>
                  <th scope="row">{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>
                    <a href="/db_sample/b_detail/{{$item->id}}" class="btn btn-success btn-sm">詳細</a>
                  </td>
                  <td>
                    <a href="/db_sample/b_edit/{{$item->id}}" class="btn btn-primary btn-sm">編集</a>
                  </td>
                  <td>
                    <form action="/db_sample/b_delete/{{$item->id}}" method="POST">
                      @csrf
                      <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- page control -->
  {{-- {!! $items->render() !!}--}}
  {!! $items->appends(['keyword'=>$keyword ?? ''])->render() !!}

  @endsection

  @section('btn-dell')
  <script>
    $(function() {
      $(".btn-dell").click(function() {
        if (confirm("本当に削除しますか？")) {
          //そのままsubmit（削除）
        } else {
          //cancel
          return false;
        }
      });
    });
  </script>
  @endsection