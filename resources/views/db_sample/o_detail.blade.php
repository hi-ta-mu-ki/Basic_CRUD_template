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
<div class="row">
  <div class="col-sm-2">
    <a href="/db_sample/o_new/{{$item1->id}}" class="btn btn-warning text-white">
      新規登録
    </a>
  </div>
  <div class="col-sm-2">
    <a href="/db_sample/o_list"><button type="submit" class="btn btn-primary">戻る</button></a>
  </div>
</div>
@endsection