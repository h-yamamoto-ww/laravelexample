<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Exception;
use ZipArchive;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Review::query();
 
        $s_code = $request->input('s_code');
        if(!empty($s_code))
        {
            $query->where('prodoct_code','like','%'.$s_code.'%');
        }

        $perpage = $request->input('perpage', 10);

        #ページネーション
        $reviews = $query->orderBy('date','desc')->paginate($perpage);

        return view('reviews.index', ['reviews' => $reviews->appends($request->except('page')), 'request'=>$request->except('page')]);
    }



    /**
     * Export Sample List with csv
     * @return Symfony\Component\HttpFoundation\StreamedResponse
     */

    public function csv_export()
    {
        $response = new StreamedResponse (function(){

            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            // タイトルを追加
            fputcsv($stream, ['販売コード',
                                '店舗管理番号',
                                '商品タイトル',
                                'カテゴリー',
                                '評価',
                                'タイトル',
                                'レビュー',
                                '販売サイト',
                                '日付',
                                'URL',
                                '受注番号']);
             
            $query = Review::query();
            
            /* $s_code = $request->input('s_code');
            if(!empty($s_code))
            {
                $query->where('prodoct_code','like','%'.$s_code.'%');
            } */

            $order_query = $query->orderBy('date','desc');
            $order_query->chunk( 1000, function($results) use ($stream) {
                foreach ($results as $result) {
                    fputcsv($stream, [$result->prodoct_code,
                                        $result->shop_code,
                                        $result->prodoct_name,
                                        $result->category,
                                        $result->rank,
                                        $result->title,
                                        $result->comment,
                                        $result->shop,
                                        $result->date,
                                        $result->url,
                                        $result->order_number]);
                }
            });
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="prodoct_review.csv"');

        return $response;
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
