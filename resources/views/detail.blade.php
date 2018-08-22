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
                       <table>
                            <tr><th></th><th width="200"></th><th width="80"></th><th width="200" style="text-align: center;">正解</th><th width="200" style="text-align: center;">回答</th><th width="80" style="text-align: center;">判定</th></tr>
                        <?php $no = 1; ?>
                        @foreach ($items as $item)
                            <tr height="40">
                                <td><?php echo $no++; ?>.&nbsp;</td>
                                <td>{{$item->japanese}}</td>
                                <td width="80" class="btn btn-warning btn-xm" style="pointer-events: none; color: #FFFFFF; background-color: #ffa500;">{{$item->part}}</td>
                                <td style="text-align: center;">{{$item->english}}</td>
                                <td style="text-align: center;">{{$item->input_value}}</td>
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
                                <td style="font-size:{{$f_size}}; color:{{$f_color}}; font-weight: bold; text-align: center;">{{$decision}}</td>
                            </tr>
                        @endforeach
                        </table>
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
