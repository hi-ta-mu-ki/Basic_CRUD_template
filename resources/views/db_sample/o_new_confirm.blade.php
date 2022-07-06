<!-- 親テンプレート -->
@extends('layouts.db_sample_member')

@section('title', 'db_sample_member')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<div id="page-content">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-12">
        <h1 class="font-weight-light mt-4">transaction新規確認</h1>
        <div class="container mt-3">
          <div class="row">
            <label class="col-sm-2 control-label mb-3">お名前</label>
            <div class="col-sm-10">{{$item->b_masters->name}}</div>
          </div>
          <form action="" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" name="o1_id" value="{{$item->id}}">
            <table class="table table-borderless">
              <thead>
                <tr class="table-dark">
                  <th scope="col" style="width:80%">品名</th>
                  <th scope="col" style="width:20%">数量</th>
                </tr>
              </thead>
              <tbody>
                @foreach($o_items as $o_item)
                <tr>
                  <td>{{ $o_item['name'] }}</td>
                  <td>{{ $o_item['quantity'] }}</td>
                  <input type="hidden" name="o_items_a_masters_id[]" value="{{ $o_item['a_masters_id'] }}">
                  <input type="hidden" name="o_items_quantity[]" value="{{ $o_item['quantity'] }}">
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="form-group row">
              <div class="col-sm-10 pt-2 text-end">
                ※修正がある場合でも一旦登録し，transactionリストの詳細画面から修正してください。
              </div>
              <div class="col-sm-2">
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">登録</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection