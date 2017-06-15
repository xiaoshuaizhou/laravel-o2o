<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>首页</title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="css/index/base.css" />
    <link rel="stylesheet" href="css/index/common.css" />
    <link rel="stylesheet" href="css/index/index.css" />
    <script type="text/javascript" src="js/index/html5shiv.js"></script>
    <script type="text/javascript" src="js/index/respond.min.js"></script>
    <script type="text/javascript" src="js/index/jquery-1.11.3.min.js"></script>
</head>
<body>
<div class="header-bar">
    <div class="header-inner">
        <ul class="father">
            <li><a>北京</a></li>
            <li>|</li>
            <li class="city">
                <a>切换城市<span class="arrow-down-logo"></span></a>
                <div class="city-drop-down">
                    <h3>热门城市</h3>
                    <ul class="son">
                        <li><a href="">北京</a></li>
                        <li><a href="">上海</a></li>
                        <li><a href="">广州</a></li>
                        <li><a href="">深圳</a></li>
                        <li><a href="">天津</a></li>
                        <li><a href="">杭州</a></li>
                        <li><a href="">西安</a></li>
                        <li><a href="">成都</a></li>
                        <li><a href="">郑州</a></li>
                        <li><a href="">厦门</a></li>
                        <li><a href="">青岛</a></li>
                        <li><a href="">太原</a></li>
                        <li><a href="">重庆</a></li>
                        <li><a href="">武汉</a></li>
                        <li><a href="">南京</a></li>
                        <li><a href="">沈阳</a></li>
                        <li><a href="">济南</a></li>
                        <li><a href="">哈尔滨</a></li>
                    </ul>

                </div>
            </li>
            @if(Auth::check())
                <li><a href="{{url('/')}}">你好！{{Auth::user()->username}}</a></li>
                <li>|</li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        退出
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @else
                <li><a href="{{url('/register')}}">注册</a></li>
                <li>|</li>
                <li><a href="{{url('/login')}}">登录</a></li>
            @endif

        </ul>
    </div>
</div>