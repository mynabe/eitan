@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/list" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}
                        <div class="container">
                            <?php $no = 0; ?>
                            @foreach ($items as $item)
                            <?php $no++; ?>
                            <div class="row">
                                <div class="col-sm-1.9 col-xs-3 box" style="width:30px;"><?php echo $no; ?>.&nbsp;</div>
                                <div class="col-sm-1.9 col-xs-3 box" style="width:200px;">{{$item->japanese}}</div>
                                <div class="col-sm-1.9 col-xs-3 box" style="width:50px; text-align: center; color: #FFFFFF;"><p class="bg-warning">{{$item->part}}</p></div>
                                <div class="col-sm-1.9 col-xs-3 box" style="text-align: center; width:140px;">{{$item->english}}</div>
                                <div class="col-sm-1.9 col-xs-3 box" style="text-align: center; width:140px;">{{$item->input_value}}</div>
                                <?php
                                    $decision ="";
                                    $f_color = "red";
                                    $f_size = "25px";
                                 if($item->decision){ 
                                    $decision = "〇";
                                    $f_color = "aqua";
                                    $f_size = "15px";
                                 } else {
                                    $decision = "×";
                                 } 
                                 ?>
                                 <div></div>
                                <div class="col-sm-1.9 col-xs-3 box" style="width:50px; font-size:{{$f_size}}; color:{{$f_color}}; font-weight: bold; text-align: center;">{{$decision}}</div>
                            </div>
                            @endforeach
                        </div>
                        <br>
                        <div style="text-align: center;">
                            <button class="btn btn-info" type="button" onclick="history.back()">閉じる</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
