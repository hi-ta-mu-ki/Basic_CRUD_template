<!-- 親テンプレート -->
@extends('layouts.sample_member')

@section('title', 'sample_member')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
  <input type="hidden" name="name" value="{{$item->name}}">
  <div class="row">
    <label class="col-sm-2 control-label mb-3">お名前</label>
    <div class="col-sm-10">{{$item->name}}</div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <a href="/db_sample/list"><button type="submit" class="btn btn-primary">戻る</button></a>
    </div>
  </div>
@endsection