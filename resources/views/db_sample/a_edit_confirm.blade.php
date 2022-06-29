<!-- 親テンプレート -->
@extends('layouts.db_sample_admin')

@section('title', 'db_sample_admin')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<form action="" method="post" class="form-horizontal">
  @csrf
  <input type="hidden" name="name" value="{{$name}}">
  <div class="row">
    <label class="col-sm-2 control-label">品名</label>
    <div class="col-sm-10">{{$name}}</div>
  </div>
  <div class="form-group row mt-5">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">登録</button>
    </div>
  </div>
</form>
@endsection