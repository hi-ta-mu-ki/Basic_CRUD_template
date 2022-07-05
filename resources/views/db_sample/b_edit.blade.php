<!-- 親テンプレート -->
@extends('layouts.db_sample_member')

@section('title', 'db_sample_member')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<div id="page-content">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-12">
        <h1 class="font-weight-light mt-4">B_master編集</h1>
        <div class="container mt-3">
          <form action="" method="post" class="form-horizontal" novalidate>
            @csrf
            {{ method_field('patch') }}
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label mb-3">お名前</label>
              <div class="col-sm-10">
                <input type="text" name="name" value="{{ $item->name }}" class="form-control @if($errors->has('name')) is-invalid @endif" id="name">
                @if($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="tel" class="col-sm-2 col-form-label mb-3">お電話番号</label>
              <div class="col-sm-10">
                <input type="text" name="tel" value="{{ $item->tel }}" class="form-control @if($errors->has('tel')) is-invalid @endif" id="tel">
                @if($errors->has('tel'))
                <div class="invalid-feedback">{{ $errors->first('tel') }}</div>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">確認</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection