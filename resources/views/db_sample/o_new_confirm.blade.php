<!-- 親テンプレート -->
@extends('layouts.db_sample_member')

@section('title', 'db_sample_member')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<form action="" method="post" class="form-horizontal">
  @csrf
  <input type="hidden" name="o1_id" value="{{$o1_id}}">
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
@endsection