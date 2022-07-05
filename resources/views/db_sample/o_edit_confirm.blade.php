<!-- 親テンプレート -->
@extends('layouts.db_sample_member')

@section('title', 'db_sample_member')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<div id="page-content">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-12">
        <h1 class="font-weight-light mt-4">transaction編集確認</h1>
        <div class="container mt-3">
          <form action="" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" name="a_masters_id" value="{{$a_masters_id}}">
            <input type="hidden" name="quantity" value="{{$quantity}}">
            <div class="form-group row">
              <label class="col-sm-2 control-label mb-3">品名</label>
              <div class="col-sm-10">{{$name->name}}</div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 control-label mb-3">数量</label>
              <div class="col-sm-10">{{$quantity}}</div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
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