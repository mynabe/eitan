@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <?php  
                    $display_grading = "";
                    $display_reset = "";

                    if(count($items) < 1)
                    {
                        $display_grading = "display:none";
                    }
                    else
                    {
                        $display_reset = "display:none";   
                    }

                ?>
                <div class="card-header" style="{{$display_grading}}">
                    次の日本語に対応する、先頭文字のアルファベットから始まる英単語（1語）を入力後、<br>
                    ”採点する”ボタンを押してください。
                </div>
                <div class="card-header" style="{{$display_reset}}">
                    全問正解しました！<br>
                    ”リセット”ボタンを押すと最初の単語から出題されます。（履歴も消去されます）
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/home" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}
                       <table>
                            <tr><th></th><th></th><th></th><th style="text-align: center;">先頭文字</th><th></th></tr>
                        <?php 
                            $no = 1; 
                        ?>
                        @foreach ($items as $item)
                            <tr height="40">
                                <td><?php echo $no++; ?>.&nbsp;</td>
                                <td width="250" >{{$item->japanese}}</td>
                                <td width="80" class="btn btn-warning btn-xm" style="pointer-events: none; color: #FFFFFF; background-color: #ffa500;">{{$item->part}}</td>
                                <td width="100" style="text-align: center;">{{substr($item->english,0,1)}}</td>
                                <input type="hidden" name="japanese[]" value="{{$item->japanese}}">
                                <input type="hidden" name="english[]" value="{{$item->english}}">
                                <input type="hidden" name="part[]" value="{{$item->part}}">
                                <input type="hidden" name="id[]" value="{{$item->id}}">
                                <td width="200"><label><input type="text/submit/hidden/button/etc" name="input_value[]" value=""></label> </td>
                            </tr>
                        @endforeach
                        </table>
                        <br>
                        <div style="text-align: center;">
                            <button class="btn" type="submit" name="history" value="history" style="color: #FFFFFF; background-color: #fc9db8;">履歴を表示</button>
                            <button class="btn btn-info" type="submit" name="grading" value="grading" style="{{$display_grading}}">採点する</button>
                            <button class="btn btn-info" type="submit" name="reset" value="reset" style="{{$display_reset}}">リセット</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
