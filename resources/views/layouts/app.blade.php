<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::check() ? Auth::user()->api_token : 'Bearer ' }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script>
        @if(Auth::check())
            window.LEARNFANS = {
            name:"{{Auth::user()->name}}",
            avatar:"{{Auth::user()->avatar}}",
            token:"{{ csrf_token() }}"
        }
        @endif
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        LearnFans
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ route('question.index') }}">问答<span class="sr-only">(current)</span></a></li>
                        <li><a href="#">博客</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">登录</a></li>
                            <li><a href="{{ route('register') }}">注册</a></li>
                        @else
                            <li>
                                <a href="{{ route('notifications', Auth::user()->name) }}" class="user_notification">
                                    <i class="fa fa-bell"></i>&nbsp;
                                    @if(count(Auth::user()->unreadNotifications))
                                    <span class="notifications_count">
                                        {{ count(Auth::user()->unreadNotifications) }}
                                    </span>
                                    @endif
                                </a>
                            </li>
                            <li class="dropdown">
                                <span href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"
                                    style="padding: 10px 15px;display: inline-block;"
                                >
                                    <img src="{{ Auth::user()->avatar }}" alt="" class="img-rounded img-responsive" style="height: 34px;display: inline-block;">
                                    {{ Auth::user()->name }}
                                    <span class="caret"></span>
                                </span>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('user.home', Auth::user()->name) }}">个人中心</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            安全退出
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <style>
        .user_notification{
            position: relative;
        }
        .user_notification .notifications_count{
            height: 20px;
            width: 20px;
            text-align: center;
            line-height: 20px;
            background: #E74C3C;
            display: inline-block;
            color: #fff;
            border-radius: 50%;
            position: absolute;
            top: 10px;
            right: 0;
        }
    </style>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
