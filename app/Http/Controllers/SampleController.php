<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\Sample;
use DB;

class SampleController extends Controller
{
    /**
     * Show Sample List.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
       // キーワードで検索
       $keyword = $request->keyword;
       $sample_list = Sample::search($keyword);

       return view('sample.index',['sample_list'=>$sample_list, 'keyword' => $keyword]);
    }
 
    /**
     * Export Sample List with csv
     * @return Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export( Request $request )
    {
        $response = new StreamedResponse (function() use ($request){

            // キーワードで検索
            $keyword = $request->keyword;

            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            // タイトルを追加
            fputcsv($stream, ['id','sample1','sample2','sample3','created_at','updated_at']);

            Sample::where('sample1', 'LIKE', '%'.$keyword.'%')->chunk( 1000, function($results) use ($stream) {
                foreach ($results as $result) {
                    fputcsv($stream, [$result->id,$result->sample1,$result->sample2,$result->sample3,$result->created_at,$result->updated_at]);
                }
            });
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="SampleList.csv"');

        return $response;
    }
}