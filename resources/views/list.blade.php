@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    "詳細"を押すと内容が表示されます。<br>
                    テストを実行するには、”テスト実施”を押してください。（新規または不正解のみ出題されます）
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
                            <tr><th style="text-align: center;">実施日</th><th style="text-align: center;">正解率</th><th></th></tr>
                        @foreach ($lists as $item)                     
                            <tr height="40">
                                <td width="280" style="text-align: center;">{{$item->created_at}}</td>
                                <?php $no = $item->rate; ?>
                                <td width="250" style="text-align: center;">{{$item->rate}}%</td>
                                <td>
                                    <button class="btn btn-xm" type="submit" name="detail" value="{{$item->id}}" style="color: #FFFFFF; background-color: #fc9db8;">詳細</button>
                                </td>
                            </tr>
                        @endforeach
                        </table>
                        <div class="mx-auto" style="width: 450px;">
                            {{ $lists->links() }}
                        </div>
                        <br>
                        <div style="text-align: center">
                            <button class="btn btn-info" type="submit" name="re_test" value="re_test">テスト実施</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
