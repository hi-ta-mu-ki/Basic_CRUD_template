<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{ public_path('css/pdf_style.css') }}">
  <title>PDF Document</title>
</head>

<body>
  <section class="page">
    <p class="caption text_right">
      No.○○-2022-{{$item1->id}}
    </p>
    <p class="caption text_right">
      {{ \Carbon\Carbon::now()->format('Y 年 m 月 d 日') }}
    </p>
    <p class="name text_underline">
      {{$item1->b_masters->name}} 御中
    </p>
    <p class="name text_right">
      hitamuki, Inc
    </p>
    <p class="caption text_right">
      〒000-0000 ○○県 ○○市 ○○ ○丁目 ○-○<br>
      ○○　○○<br>
      TEL.000-000-0000
    </p>

    <h1 class="text_center">
      御　○　○　書
    </h1>
    <p>
      ○○○○につき下記のとおりご○○申し上げます。
    </p>

    <table class="price">
      <tr>
        <th width="100" class="price">
          ご○○金額
        </th>
        <th class="price">
          {{number_format($t_amount)}} 円
        </th>
      </tr>
    </table>
    <p>　</p>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>品名</th>
          <th>数量</th>
          <th>単価</th>
          <th>合計</th>
        </tr>
      </thead>
      <tbody>
        @foreach($items2 as $key => $item2)
        <tr>
          <th width="30">{{$key + 1}}</th>
          <td>{{$item2->a_masters->name}}</td>
          <td width="75" class="text_right">{{number_format($item2->quantity)}} 個</td>
          <td width="75" class="text_right">{{number_format($item2->a_masters->price)}} 円</td>
          <td width="150" class="text_right">{{number_format($d_amount[$key])}} 円</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3"></td>
          <th>小　計</th>
          <td class="text_right">{{number_format($t_amount * .9)}} 円</td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <th>消費税</th>
          <td class="text_right">{{number_format($t_amount * .1)}} 円</td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <th>合　計</th>
          <td class="text_right">{{number_format($t_amount)}} 円</td>
        </tr>
      </tfoot>
    </table>
    <p class="bank">
      銀行名： ○○銀行　○○支店<br>
      口座番号： 普通　0000000<br>
      口座名義： ○○○○
    </p>
    <p>
      以上，よろしくお願いいたします。
    </p>
  </section>
</body>

</html>