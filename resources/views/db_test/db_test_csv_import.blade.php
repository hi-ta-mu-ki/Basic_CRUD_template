<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>csv インポート</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <!-- <link href="/css/sticky-footer.css" rel="stylesheet" media="screen"> -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="container-sm">
      <h1>Laravel で CSV インポート 演習</h1>
      <p>CSVファイルを tests テーブルに登録します。</p>
      <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
          <label class="col-sm-2 text-end" for="form-file-1">File:</label>
          <div class="col-sm-8">
            <div class="custom-file">
              <input type="file" name="csv" class="custom-file-input" id="customFile">
              <label class="custom-file-label" for="customFile" data-browse="参照">ファイル選択...</label>
            </div>
          </div>
          <div class="col-sm-2 text-start">
            <button type="submit" class="btn btn-success btn-block">送信</button>
          </div>
        </div>
      </form>

      <script>
        // ファイルを選択すると、コントロール部分にファイル名を表示
        $('.custom-file-input').on('change',function(){
          $(this).next('.custom-file-label').html($(this)[0].files[0].name);
        })
      </script>

      @if(Session::has('flashmessage'))
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
      <script>
        $(window).on('load',function(){
          $('#myModal').modal('show');
        });
      </script>
      <!-- モーダルウィンドウの中身 -->
      <div class="modal fade" id="myModal" tabindex="-1"
        role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              {{ session('flashmessage') }}
            </div>
            <div class="modal-footer text-center">
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </body>
</html>
