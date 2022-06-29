<!-- 親テンプレート -->
@extends('layouts.db_sample_admin')

@section('title', 'db_sample_admin')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<form action="" method="post" class="form-horizontal">
  @csrf
  <input type="hidden" name="name" value="{{$name}}">
  <input type="hidden" name="price" value="{{$price}}">
  <div class="form-group row">
    <label class="col-sm-2 control-label mb-3">品名</label>
    <div class="col-sm-10">{{$name}}</div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 control-label mb-3">単価</label>
    <div class="col-sm-10">{{$price}}</div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary">登録</button>
    </div>
  </div>
</form>
@endsection