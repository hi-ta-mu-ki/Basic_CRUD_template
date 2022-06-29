<!-- 親テンプレート -->
@extends('layouts.db_sample_admin')

@section('title', 'db_sample_admin')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
  <input type="hidden" name="name" value="{{$item->name}}">
  <div class="row">
    <label class="col-sm-2 control-label">品名</label>
    <div class="col-sm-10">{{$item->name}}</div>
  </div>
  <div class="form-group row mt-5">
    <div class="col-sm-12">
      <a href="/db_sample/a_list"><button type="submit" class="btn btn-primary">戻る</button></a>
    </div>
  </div>
@endsection