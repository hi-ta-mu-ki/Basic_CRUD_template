<!-- 親テンプレート -->
@extends('layouts.db_sample_admin')

@section('title', 'db_sample_admin')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<div id="page-content">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-12">
        <h1 class="font-weight-light mt-4">ユーザ編集</h1>
        <div class="container mt-3">
          <form action="" method="post" class="form-horizontal" novalidate>
            @csrf
            {{ method_field('patch') }}
            <div class="form-group row">
              <label for="email" class="col-form-label col-sm-2 mb-3">e-mail</label>
              <div class="col-sm-10">
                <input type="text" name="email" value="{{$item->email}}" class="form-control @if($errors->has('email')) is-invalid @endif" id="email">
                @if($errors->has('email'))
                <div class="invalid-feedback">{{$errors->first('email')}}</div>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-form-label col-sm-2 mb-3">名前</label>
              <div class="col-sm-10">
                <input type="text" name="name" value="{{ $item->name }}" class="form-control @if($errors->has('name')) is-invalid @endif" id="name">
                @if($errors->has('name'))
                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="password_raw" class="col-form-label col-sm-2 mb-3">パスワード</label>
              <div class="col-sm-10">
                <input type="text" name="password_raw" value="{{$item->password_raw}}" class="form-control @if($errors->has('password_raw')) is-invalid @endif" id="password_raw">
                @if($errors->has('password_raw'))
                <div class="invalid-feedback">{{$errors->first('password_raw')}}</div>
                @endif
              </div>
            </div>
            <div class="form-group mb-3">
              役割　：　
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="inline_radio_1" value="{{ App\Models\User::ADMIN }}" @if($item->role <= App\Models\User::CHIEF) checked @endif>
                  <label class="form-check-label" for="inline_radio_1">管理者</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="inline_radiox_2" value="{{ App\Models\User::MEMBER }}" @if($item->role == App\Models\User::MEMBER) checked @endif>
                <label class="form-check-label" for="inline_radio_2">利用者</label>
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