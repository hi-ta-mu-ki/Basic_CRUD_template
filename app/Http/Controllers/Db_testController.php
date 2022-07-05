<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class Db_testController extends Controller
{
  public function csv_import()
  {
    return view('db_test.db_test_csv_import');
  }

  public function upload_regist(Request $rq)
  {
    if ($rq->hasFile('csv') && $rq->file('csv')->isValid()) {
      // CSV ファイル保存
      $tmpname = uniqid("CSVUP_") . "." . $rq->file('csv')->guessExtension(); //TMPファイル名
      $rq->file('csv')->move(public_path() . "/csv/tmp", $tmpname);
      $tmppath = public_path() . "/csv/tmp/" . $tmpname;

      // Goodby CSVの設定
      $config_in = new LexerConfig();
      $config_in
        ->setFromCharset("SJIS-win")
        ->setToCharset("UTF-8") // CharasetをUTF-8に変換
        ->setIgnoreHeaderLine(true) //CSVのヘッダーを無視
      ;
      $lexer_in = new Lexer($config_in);

      $datalist = array();

      $interpreter = new Interpreter();
      $interpreter->addObserver(function (array $row) use (&$datalist) {
        // 各列のデータを取得
        $datalist[] = $row;
      });

      // CSVデータをパース
      $lexer_in->parse($tmppath, $interpreter);

      // TMPファイル削除
      unlink($tmppath);

      // 処理
      foreach ($datalist as $row) {
        // 各データ取り出し
        $csv_data = $this->get_csv_data($row);

        // DBへの登録
        $this->regist_csv_data($csv_data);
      }
      return redirect()->to('/db_test/csv_import')->with('flashmessage', 'CSVのデータを読み込みました。');
    }
    return redirect()->to('/db_test/csv_import')->with('flashmessage', 'CSVの送信エラーが発生しましたので、送信を中止しました。');
  }

  private function get_csv_data($row)
  {
    $csv_data = array(
      'name' => $row[0],
    );
    return $csv_data;
  }

  private function regist_csv_data($csv_data)
  {
    $new_data = new Test;
    foreach ($csv_data as $key => $value) {
      $new_data->$key = $value;
    }
    $new_data->save();
  }

}
