<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Eitango</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #overImg{position: relative;}
            #overImg a .top_small{width: 120px;}
            #overImg a .top_large{display: none;}
            #overImg a:hover .top_large {
                display: block;
                position: absolute;
                width: 500px;
                z-index:999;
                left:50%;  
                -webkit-transform: translate(-50%,-0%);
                -moz-transform: translate(-50%,-0%);
                transform: translate(-50%,-0%);   
            }
            @media only screen and (max-width: 750px) {
                img { max-width: 100%; }
            }
        </style>
    </head>
    <body>
        <div class="position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div>
                    <br><br><br><br><br>
                    英単語学習サイト
                </div>
                <div class="title m-b-md">
                    Eitango
                </div>
                <div id="overImg">
                    <a><img class="top_small" src="{{ asset('/img/top1.png') }}"><img class="top_large" src="{{ asset('/img/top1.png') }}">
                    </a>                  
                    <a><img class="top_small" src="{{ asset('/img/top2.png') }}"><img class="top_large" src="{{ asset('/img/top2.png') }}">
                    </a>
                    <a><img class="top_small" src="{{ asset('/img/top3.png') }}"><img class="top_large" src="{{ asset('/img/top3.png') }}">
                    </a>                                      
                </div>
            </div>
        </div>
    </body>
</html>
