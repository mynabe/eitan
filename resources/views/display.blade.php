@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    ”保存する”ボタンを押すと結果が登録されます。
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/list" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}
                        <div class="container">
                            <?php $no = 1; ?>
                            <?php $count = 0; ?>
                            @foreach ($items as $key)
                            <div class="row">
                                <div class="col-sm-1.9 col-xs-3 box" style="width:30px;"><?php echo $no++; ?>.&nbsp;</div>
                                <div class="col-sm-1.9 col-xs-3 box" style="width:200px;"><?php print($key['japanese'][$count]); ?></div>
                                <div class="col-sm-1.9 col-xs-3 box" style="width:50px; text-align: center; color: #FFFFFF;"><p class="bg-warning"><?php print($key['part'][$count]); ?></p></div>
                                <div class="col-sm-1.9 col-xs-3 box" style="text-align: center; width:150px;"><?php print($key['english'][$count]); ?></div>
                                <div class="col-sm-1.9 col-xs-3 box"> <input style="width:150px;" class="form-control" type="text/submit/hidden/button/etc" name="input_value[]" value="{{$key['input_value'][$count]}}" disabled></div>
                                <?php
                                    $decision ="";
                                    $f_color = "red";
                                    $f_size = "25px";
                                 if($key['decision'][$count]){ 
                                    $decision = "〇";
                                    $f_color = "aqua";
                                    $f_size = "15px";
                                 } else {
                                    $decision = "×";
                                 } 
                                 ?>
                                <div class="col-sm-1.9 col-xs-3 box" style="width:50px; text-align: center; font-size:{{$f_size}}; color:{{$f_color}}; font-weight: bold;">{{$decision}}</div>
                                <input type="hidden" name="decision[]" value="{{$key['decision'][$count]}}">
                                <input type="hidden" name="id[]" value="{{$key['id'][$count]}}">
                                <input type="hidden" name="input_value[]" value="{{$key['input_value'][$count]}}">
                               <?php $count++; ?>
                            </div>
                            @endforeach
                        </div>
                        <br>
                        <div style="text-align: center;">
                            <button class="btn" type="submit" name="retry" value="retry" style="color: #FFFFFF; background-color: #fc9db8;">やり直す</button>
                            <button class="btn btn-info" type="submit">保存する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
