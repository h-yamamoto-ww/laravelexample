<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class CsvDownloadController extends Controller
{
    //
    public function practice1()
    {
    //コントローラ（一覧表示）
    $query = Review::query();
    //$query->Join('profiles','auth_information.id','=','profiles.authinformation_id'); //内部結合
    $query->orderBy('date');
    $lists = $query->paginate(10);

    $hash = array(
        'lists' => $lists,
    );

    return view('csv/practice1')->with($hash);
    }

    public function search(Request $rq)
    {
    // コントローラ（検索）
    $q = $rq->input('q');
    $query = Review::query();
    //$query->Join('profiles','auth_information.id','=','profiles.authinformation_id'); //内部結合
    //$query->where('profiles.name','LIKE',"%$q%");
    $query->where('prodoct_code','LIKE',"%$q%");
    $query->orderBy('date');
    $lists = $query->paginate(10);

    $hash = array(
        'lists' => $lists,
    );

    return view('csv/practice1')->with($hash);
    }

    private function csvcolmns()
    {
    // CSV出力するカラムの定義（コントローラ）
    $csvlist = array(
        'prodoct_code' => '販売コード',
        'prodoct_name' => '商品名',
        'comment' => 'レビュー',
        'date' => '日付',
    );
    return $csvlist;
    }

    public function download1()
    {  
    //CSV出力（コントローラ）


    // 出力項目定義
    $csvlist = $this->csvcolmns(); //auth_information + profiles

    // ファイル名
    $filename = "prodoct_review_".date('Ymd').".csv";

    // 仮ファイルOpen
    $stream = fopen('php://temp', 'r+b');

    // *** ヘッダ行 ***
    $output = array();                         

    foreach($csvlist as $key => $value){
        $output[] = $value;
    }

    // CSVファイルを出力
    fputcsv($stream, $output);

    // *** データ行 ***
    $blocksize = 100; // QUERYする単位
    for($i=0 ; true ; $i++) {
        $query = Review::query();
        //$query->Join('profiles','auth_information.id','=','profiles.authinformation_id'); //内部結合
        $query->orderBy('date');
        $query->skip($i * $blocksize); // 取得開始位置
        $query->take($blocksize); // 取得件数を指定
        $lists = $query->get();

        //デバッグ
        //$list_sql = $query->toSql();
        //\Log::debug('$list_sql="' . $list_sql . '"');

        // レコードあるか？
        if ($lists->count() == 0) {
            break;
        }

        foreach ($lists as $list) {
            $output = array();
            foreach ($csvlist as $key => $value) {
                $output[] = str_replace(array("\r\n", "\r", "\n"), '', $list->$key);
            }
            // CSVファイルを出力
            fputcsv($stream, $output);
        }
    }

    // ポインタの先頭へ
    rewind($stream);

    // 改行変換
    $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));

    // 文字コード変換
    $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');

    // header
    $headers = array(
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="'.$filename.'"',
    );

    return \Response::make($csv, 200, $headers);
    }

}
