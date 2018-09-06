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
                    次の日本語に対応する、アルファベットから始まる英単語（1語）を入力後、<br>
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
                    <div  class="container">
                        <?php 
                            $no = 1; 
                        ?>
                        @foreach ($items as $item)
                        <div class="row">
                            <div class="col-sm-2.4 col-xs-4 box" style="width:30px;"><?php echo $no++; ?>.&nbsp;</div>
                            <div class="col-sm-2.4 col-xs-4 box" style="width:40%;">{{$item->japanese}}</div>
                            <div class="col-sm-2.4 col-xs-4 box" style="width:50px; text-align: center; color: #FFFFFF;"><p class="bg-warning">{{$item->part}}</p></div>
                            <div class="col-sm-2.4 col-xs-4 box" style="text-align: center; width:30px;">{{substr($item->english,0,1)}}</div>
                            <input type="hidden" name="japanese[]" value="{{$item->japanese}}">
                            <input type="hidden" name="english[]" value="{{$item->english}}">
                            <input type="hidden" name="part[]" value="{{$item->part}}">
                            <input type="hidden" name="id[]" value="{{$item->id}}">
                            <div class="col-sm-2.4 col-xs-4 box"> <input style="width:100%;" class="form-control" type="text/submit/hidden/button/etc" name="input_value[]" value=""></div>
                        </div>
                        @endforeach
                    </div>
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
