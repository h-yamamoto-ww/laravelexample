@extends('layout')

@section('content')


<p><a class="btn btn-primary" href="{{url('/csv/download1')}}" target="_blank"> CSV download その1</a></p>

<form action="{{url('/csv/search')}}" method="GET">
    {{ csrf_field() }}
<div class="input-group">
    <input type="text" name="q" class="form-control" placeholder="名前を入力してください">
    <span class="input-group-btn">
<button type="submit" class="btn btn-default">検索</button>
</span>
</div>
</form>

{!! $lists->render() !!}
<br>
<table class="table table-striped">
    <tr>
        <th>prodoct_code</th>
        <th>review</th>
        <th>date</th>
    </tr>
    @foreach($lists as $list)
    <tr>
        <td>{{$list->prodoct_code}}</td>
        <td>{{$list->comment}}</td>
        <td>{{$list->date}}</td>
    </tr>
    @endforeach
</table>

@endsection