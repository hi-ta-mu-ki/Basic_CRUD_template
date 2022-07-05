<!-- 親テンプレート -->
@extends('layouts.db_sample_member')

@section('title', 'db_sample_member')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<div id="page-content">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-12">
        <h1 class="font-weight-light mt-4">B_master詳細</h1>
        <div class="container mt-3">
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
        </div>
      </div>
    </div>
  </div>
</div>
@endsection