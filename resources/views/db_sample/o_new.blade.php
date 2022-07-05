<!-- 親テンプレート -->
@extends('layouts.db_sample_member')

@section('title', 'db_sample_member')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<div id="page-content">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-12">
        <h1 class="font-weight-light mt-4">transaction新規</h1>
        <div class="container mt-3">
          <div class="row">
            <label class="col-sm-2 control-label mb-3">お名前</label>
            <div class="col-sm-10">{{$item1->b_masters->name}}</div>
          </div>
          <div class="row">
            <label class="col-sm-2 control-label mb-3">日付</label>
            <div class="col-sm-10">{{$item1->created_at}}</div>
          </div>
          <form action="" method="post" class="form-horizontal" novalidate>
            @csrf
            {{ method_field('patch') }}
            <input type="hidden" name="o1_id" value="{{$item1->id}}">
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label mb-3">品名</label>
              <div class="col-sm-10">
                <select class="form-select" name="a_masters_id">
                  @foreach($a_items as $a_item)
                  <option value="{{$a_item->id}}" @if($a_item->id==old('a_masters_id')) selected @endif>
                    {{$a_item->name}}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="quantity" class="col-sm-2 col-form-label mb-3">数量</label>
              <div class="col-sm-10">
                <input type="text" name="quantity" value="{{ old('quantity') }}" class="form-control @if($errors->has('quantity')) is-invalid @endif" id="quantity" required>
                @if($errors->has('quantity'))
                <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
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
        </div>
      </div>
    </div>
  </div>
</div>
@endsection