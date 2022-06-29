<!-- 親テンプレート -->
@extends('layouts.db_sample_admin')

@section('title', 'db_sample_admin')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
  <input type="hidden" name="name" value="{{$item->name}}">
  <input type="hidden" name="tel" value="{{$item->tel}}">
  <div class="row">
    <label class="col-sm-2 control-label mb-3">お名前</label>
    <div class="col-sm-10">{{$item->name}}</div>
  </div>
  <div class="row">
    <label class="col-sm-2 control-label mb-3">お電話番号</label>
    <div class="col-sm-10">{{$item->tel}}</div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <a href="/db_sample/b_list"><button type="submit" class="btn btn-primary">戻る</button></a>
    </div>
  </div>
@endsection