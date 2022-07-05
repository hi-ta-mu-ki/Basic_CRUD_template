<!-- 親テンプレート -->
@extends('layouts.db_sample_admin')

@section('title', 'db_sample_admin')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<div id="page-content">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-12">
        <h1 class="font-weight-light mt-4">ユーザ編集確認</h1>
        <div class="container mt-3">
          <form action="" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" name="email" value="{{$email}}">
            <input type="hidden" name="name" value="{{$name}}">
            <input type="hidden" name="password_raw" value="{{$password_raw}}">
            <input type="hidden" name="role" value="{{$role}}">
            <div class="form-group row">
              <label class="col-sm-2 control-label mb-3">e_mail</label>
              <div class="col-sm-10">{{$email}}</div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 control-label mb-3">名前</label>
              <div class="col-sm-10">{{$name}}</div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 control-label mb-3">パスワード</label>
              <div class="col-sm-10">{{$password_raw}}</div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 control-label mb-3">役割</label>
              <div class="col-sm-10">
                @if($role < 6) 管理者 @else 利用者 @endif
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">登録</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection