<!-- 親テンプレート -->
@extends('layouts.db_sample_admin')

@section('title', 'db_sample_admin')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<form action="" method="post" class="form-horizontal needs-validation" novalidate>
  @csrf
  {{ method_field('patch') }}
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">品名</label>
    <div class="col-sm-10">
      <input type="text" name="name" value="{{ old('name') }}" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" required>
      @if($errors->has('name'))
      <div class="invalid-feedback">{{ $errors->first('name') }}</div>
      @else
      <div class="invalid-feedback">必須項目です</div>
      <!--HTMLバリデーション-->
      @endif
    </div>
  </div>
  <div class="form-group row mt-5">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary">確認</button>
    </div>
  </div>
</form>
@endsection