<!-- 親テンプレート -->
@extends('layouts.db_sample_member')

@section('title', 'db_sample_member')

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
</div>
@endif

<div id="page-content">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-12">
        <h1 class="font-weight-light mt-4">transaction詳細</h1>
        <div class="container mt-3">
          <div class="row">
            <label class="col-sm-2 control-label mb-3">お名前</label>
            <div class="col-sm-10">{{$item1->b_masters->name}}</div>
          </div>
          <div class="row">
            <label class="col-sm-2 control-label mb-3">日付</label>
            <div class="col-sm-10">{{$item1->created_at}}</div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr class="table-dark">
                  <th scope="col">ID</th>
                  <th scope="col">品名</th>
                  <th scope="col">数量</th>
                  <th scope="col" colspan="2"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($items2 as $item2)
                <tr>
                  <th scope="row">{{$item2->id}}</td>
                  <td>{{$item2->a_masters->name}}</td>
                  <td>{{$item2->quantity}}</td>
                  <td>
                    <a href="/db_sample/o_edit/{{$item1->id}}/{{$item2->id}}" class="btn btn-primary btn-sm">編集</a>
                  </td>
                  <td>
                    <form action="/db_sample/o2_delete/{{$item2->id}}" method="POST">
                      @csrf
                      <input type="hidden" name="o1_id" value="{{$item1->id}}">
                      <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <a href="/db_sample/o_new/{{$item1->id}}" class="btn btn-warning text-white">
                新規登録
              </a>
            </div>
            <div class="col-sm-2">
              <a href="/db_sample/o_list"><button type="submit" class="btn btn-primary">戻る</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection