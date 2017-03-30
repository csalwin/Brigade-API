@extends('layouts.admin')

@section('content')
<h1>Dashboard</h1>
<div class="row">
    <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-red">
            <div class="icon"><i class="entypo-user-add"></i></div>
            <div class="num" data-start="0" data-end="{{ $total }}" data-postfix="" data-duration="1500" data-delay="0">{{ $total }}</div>

            <h3>Number of leads</h3>
            <p>Total number of leads</p>
        </div>

    </div>
</div>
@endsection
