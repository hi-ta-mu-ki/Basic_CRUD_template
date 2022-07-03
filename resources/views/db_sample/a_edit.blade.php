<!-- 親テンプレート -->
@extends('layouts.db_sample_admin')

@section('title', 'db_sample_admin')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<form action="" method="post" class="form-horizontal needs-validation" novalidate>
  @csrf
  {{ method_field('patch') }}
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label mb-3">品名</label>
    <div class="col-sm-10">
      <input type="text" name="name" value="{{ $item->name }}" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" required>
      @if($errors->has('name'))
      <div class="invalid-feedback">{{ $errors->first('name') }}</div>
      @else
      <div class="invalid-feedback">必須項目です</div>
      <!--HTMLバリデーション-->
      @endif
    </div>
  </div>
  <div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label mb-3">単価</label>
    <div class="col-sm-10">
      <input type="text" name="price" value="{{ $item->price }}" class="form-control @if($errors->has('price')) is-invalid @endif" id="price" required>
      @if($errors->has('price'))
      <div class="invalid-feedback">{{ $errors->first('price') }}</div>
      @else
      <div class="invalid-feedback">必須項目です</div>
      <!--HTMLバリデーション-->
      @endif
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary">確認</button>
    </div>
  </div>
</form>
@endsection