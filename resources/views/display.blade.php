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
                       <table>
                            <tr><th></th><th></th><th></th><th style="text-align: center;">正解</th><th></th></tr></th></tr>
                        <?php $no = 1; ?>
                        <?php $count = 0; ?>
                        @foreach ($items as $key)
                            <tr height="40">
                                <td><?php echo $no++; ?>.&nbsp;</td>
                                <td width="250" ><?php print($key['japanese'][$count]); ?></td>
                                <td width="80" class="btn btn-warning btn-xm" style="pointer-events: none; color: #FFFFFF; background-color: #ffa500;"><?php print($key['part'][$count]); ?></td>
                                <td width="200" style="text-align: center;"><?php print($key['english'][$count]); ?></td>
                                <td width="200"><label disabled><input type="text/submit/hidden/button/etc" name="input_value[]" value="{{$key['input_value'][$count]}}" disabled></label> </td>
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
                                <td style="font-size:{{$f_size}}; color:{{$f_color}}; font-weight: bold;">{{$decision}}</td>
                                <input type="hidden" name="decision[]" value="{{$key['decision'][$count]}}">
                                <input type="hidden" name="id[]" value="{{$key['id'][$count]}}">
                                <input type="hidden" name="input_value[]" value="{{$key['input_value'][$count]}}">
                            </tr>
                            <?php $count++; ?>
                        @endforeach
                        </table>
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
