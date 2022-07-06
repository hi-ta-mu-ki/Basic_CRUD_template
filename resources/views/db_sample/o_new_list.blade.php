<!-- 親テンプレート -->
@extends('layouts.db_sample_member')

@section('title', 'db_sample_member')

<!-- 親テンプレートに表示させる場所 -->
@section('content')

<div id="page-content">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-12 mt-10 pb-0">
        <h1 class="font-weight-light mt-4">B_masterリスト</h1>
        <div class="container mt-3">
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
                新規B_master
              </a>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr class="table-dark">
                  <th scope="col">ID</th>
                  <th scope="col">お名前</th>
                  <th scope="col">お電話番号</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $item)
                <tr>
                  <th scope="row">{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->tel}}</td>
                  <td>
                    <a href="/db_sample/o_new/{{$item->id}}" class="btn btn-warning  text-white btn-sm">新規transaction</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- page control -->
          {!! $items->appends(['keyword'=>$keyword ?? ''])->render() !!}
        </div>
      </div>
    </div>
  </div>
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