@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="container">
  <div class="bg-primary mb-3 text-white">
    <nav class="navbar navbar-primary">
      <span class="navbar-brand mb-0 ms-5 h1">db_sample　ログイン</span>
    </nav>
  </div>
  <div class="row justify-content-center">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <form action="{{ url('db_sample/login') }}" method="post">
            @csrf  
            <div class="row mb-3">
              <label for="login-email" class="col-form-label col-sm-4 text-sm-end">メールアドレス</label>
              <input type="text" class="col-sm-6" class="form-control" id="login-email" name="email" value="{{ old('email') }}" placeholder="ｅ－Ｍａｉｌ">
            </div>     
            <div class="row mb-3">
              <label for="login-password" class="col-form-label col-sm-4 text-sm-end">パスワード</label>
              <input type="password" class="col-sm-6" class="form-control" id="login-password" name="password" value="{{ old('password') }}" placeholder="パスワード">
            </div>
            @if(count($errors) >0)
            <div class="alert alert-danger">
              <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
              </ul>
            </div>
            @endif
            <div class="row">
              <div class="text-center">
                <button type="submit" class="btn btn-primary">ログイン</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection