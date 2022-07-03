<!-- 親テンプレート -->
@extends('layouts.db_sample_member')

@section('title', 'db_sample_member')

<!-- 親テンプレートに表示させる場所 -->
@section('content')
<div class="row">
  <label class="col-sm-2 control-label mb-3">お名前</label>
  <div class="col-sm-10">{{$item1->b_masters->name}}</div>
</div>
<div class="row">
  <label class="col-sm-2 control-label mb-3">日付</label>
  <div class="col-sm-10">{{$item1->created_at}}</div>
</div>
@if($items2 !empty)
<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr class="table-dark">
        <th scope="col">ID</th>
        <th scope="col">品名</th>
        <th scope="col">数量</th>
        <th scope="col" colspan="2"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($items2 as $item2)
      <tr>
        <th scope="row">{{$item2->id}}</td>
        <td>{{$item2->a_masters->name}}</td>
        <td>{{$item2->quantity}}</td>
        <td>
          <a href="/db_sample/o_edit/{{$item2->id}}" class="btn btn-primary btn-sm">編集</a>
        </td>
        <td>
          <form action="/db_sample/o2_delete/{{$item2->id}}" method="POST">
            @csrf
            <input type="hidden" name="o1_id" value="{{$item1->id}}">
            <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endif
<form action="" method="post" class="form-horizontal needs-validation" novalidate>
  @csrf
  {{ method_field('patch') }}
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label mb-3">品名</label>
    <div class="col-sm-7">
      <select class="form-select" name="a_masters_id">
        @foreach($a_items as $a_item)
        <option value="{{$a_item->id}}" @if($a_item->id==old('a_masters_id')) selected @endif>
          {{$a_item->name}}
        </option>
        @endforeach
      </select>
    </div>
    <label for="quantity" class="col-sm-1 col-form-label mb-3">数量</label>
    <div class="col-sm-2">
      <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control @if($errors->has('quantity')) is-invalid @endif" id="quantity" required>
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
@endsection