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
            <div class="col-sm-10">{{Session::get('b_name')}}</div>
          </div>
          <form action="" method="post" class="form-horizontal" novalidate>
            @csrf
            {{ method_field('patch') }}
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <table class="table table-borderless" id="dynamicAdd">
              <thead>
                <tr class="table-dark">
                  <th scope="col" style="width:80%">品名</th>
                  <th scope="col" style="width:10%">数量</th>
                  <th scope="col" style="width:10%"></th>
                </tr>
              </thead>
              <tbody>
                @empty(Session::get('tmpFields'))
                <tr>
                  <td>
                    <select class="form-select" name="moreFields[0][a_masters_id]">
                      @foreach($a_items as $a_item)
                      <option value="{{$a_item->id}}">
                        {{$a_item->name}}
                      </option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input type="number" name="moreFields[0][quantity]" value="1" class="form-control @if($errors->has('moreFields[0][quantity]')) is-invalid @endif">
                  </td>
                </tr>
                @php $key = 0 @endphp
                @else
                @foreach(Session::get('tmpFields') as $key => $value)
                <tr>
                  <td>
                    <select class="form-select" name="moreFields[{{$key}}][a_masters_id]">
                      @foreach($a_items as $a_item)
                      <option value="{{$a_item->id}}" @if($a_item->id==$value['a_masters_id'])) selected @endif>
                        {{$a_item->name}}
                      </option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input type="number" name="moreFields[{{$key}}][quantity]" value="{{$value['quantity']}}" class="form-control @if($errors->has('value[quantity]')) is-invalid @endif">
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger remove-tr">削除</button>
                  </td>
                </tr>
                @endforeach
                @endempty
              </tbody>
            </table>
            <div class="form-group row">
              <div class="col-sm-2">
                <button type="button" name="add" id="add-btn" class="btn btn-success">追加</button>
                <input id="phptojquery" type="hidden" value="<?php echo $key; ?>" name="phptojquery">
              </div>
              <div class="col-sm-8 pt-2 text-end">
                ※数量の欄に正しく入力していることを必ず確認してください。
              </div>
              <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">確認</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
  var i = $('#phptojquery').val();
  $("#add-btn").click(function() {
    ++i;
    $("#dynamicAdd").append(
      '<tr>\
    <td>\
      <select class="form-select" name="moreFields[' + i + '][a_masters_id]">\
        @foreach($a_items as $a_item)\
        <option value="{{$a_item->id}}">\
          {{$a_item->name}}\
        </option>\
        @endforeach\
      </select>\
    </td>\
    <td>\
      <input type="number" name="moreFields[' + i + '][quantity]" value="1" class="form-control">\
    </td>\
    <td>\
      <button type="button" class="btn btn-danger remove-tr">削除</button>\
    </td>\
  </tr>'
    );
  });
  $(document).on('click', '.remove-tr', function() {
    $(this).parents('tr').remove();
  });
</script>
@endsection