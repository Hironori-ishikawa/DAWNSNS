@extends('layouts.login')

@section('content')
<div>
    <div>
        <h1>デイリーランキング</h1>
    </div>
    <!-- ランキング表示 -->
    <div>
        @foreach($sums as $sum)
        <div>
            <div>
                <h3> {{ ? }} 位</h3>
                <h3> {{ $sum->name }} </h3>
                <h3> {{ $sum->sum }} </h3>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
