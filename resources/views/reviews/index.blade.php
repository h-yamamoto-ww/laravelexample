@extends('layouts.app')
<title>商品レビュー</title>
@section('content')
<div class="container">

    <div class="row">

        <div class="col-3">
            @foreach ($request as $key=>$value)
               @if ($key!="perpage")
                  <input type="hidden" name="{{$key}}" value="{{$value}}" />
                @endif
            @endforeach
            <form method="get">
                {{-- <select class="custom-select" name="perpage" onchange="this.form.submit()"> --}}
                    <select class="custom-select" name="perpage" onchange="this.form.submit()">
                    <option value="">表示件数</option>
                    <option value="10" {{($request ?? ''["perpage"] ?? "")==10?"selected":""}}>10</option>
                    <option value="20" {{($request ?? ''["perpage"] ?? "")==20?"selected":""}}>20</option>
                    <option value="50" {{($request ?? ''["perpage"] ?? "")==50?"selected":""}}>50</option>
                    <option value="100" {{($request ?? ''["perpage"] ?? "")==100?"selected":""}}>100</option>
                </select>
            </form>
        </div>

        <div class="col-3">
            {{-- <a href="{{url('reviews/csv_export')}}" class="btn btn-primary font-weight-bold" target="_blank"><i class="fas fa-download"></i> Export to CSV</a> --}}
            {{-- <button id="d" type="submit" class="btn btn-primary btn-block font-weight-bold" formaction="{{route('export.csv', $reviews)}}">Export to CSV</button> --}}
            <a href="{{ route('export.csv', ['request' => $request]) }}" class="btn btn-primary">Export as CSV</a>
            {{-- <a href="{{ route('reviews.index',reviews->all().['export.csv']) }}" target="_blank">Export as CSV</a>  --}}
            {{-- <a href='/zip')}}" class="btn btn-primary">Download zip</a>                                                                                               --}}
        </div>  

    <!--/.row--></div>

    <div class="row"> 
    <!--↓↓ 検索フォーム ↓↓-->

    <div class="col-6">   
    <form method="get">
        
        @foreach ($request as $key=>$value)
            @if ($key!="s_code")
                <input type="hidden" name="{{$key}}" value="{{$value}}" />
            @endif
        @endforeach

        <div class="input-group">
        <input type="text" class="form-control" name="s_code" placeholder="販売コード" value="{{$request["s_code"] ?? ""}}">
        {{-- <button id="s" type="submit" class="float-left btn btn-primary btn-block font-weight-bold">Search</button>    --}}
        <span class="input-group-btn">
            <button id="s" type="submit" type="button" class="btn btn-primary">Search</button>
        </span>
        </div>
    </form>    
    </div>
    <!--/.row--></div>
    <!--↑↑ 検索フォーム ↑↑-->

    <div class="row"> 
        <div class="col-12">
            {{ $reviews->links() }}
        </div>
    <!--/.row--></div>


    <div class="row">
<div class="col-sm-12" style="text-align:right;">
<table class="table"><thead><tr><th>No.</th><th width="10%">販売コード</th><th width="12%">カテゴリー</th>
    <th width="5%">評価</th><th width="50%">レビュー</th><th width="10%">販売サイト</th><th width="12%">日付</th></tr></thead>

    @foreach ($reviews as $review)
    
        <tr><td>{{ $reviews->firstItem() + $loop->index }}</td>
            <td>{{ $review->prodoct_code }}</td>
            <td>{{ $review->category }}</td>
            <td>{{ $review->rank }}</td>
            <td><a href="{{ url($review->url) }}">{{ $review->comment }}</a></td>
            <td>{{ $review->shop }}</td>
            <td>{{ $review->date }}</td>
            
        </tr>
    @endforeach

</table>

@endsection
  </div>
   
    <!--/.row--></div>
  <!--/.container-fluid--></div>