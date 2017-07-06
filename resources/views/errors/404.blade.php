

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="vue,vuejs,laravel,laravel视频,laravel 视频,laravel 视频教程,laravel视频教程,laravel5视频,laravel5视频教程 Laravist Laravel 社区">
    <meta name="description" content="最好的Laravel和Vuejs视频教程">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="2EAR2way78tcuRSB8MeZ9QH6o9lAriGayMcXQMgoWPM" />
    <meta property="og:locale" content="zh_CN">
    <meta property="og:title" content="Laravist | Vuejs Laravel 视频教程">
    <meta property="og:description" content="最好的 Vuejs Laravel视频教程">
    <meta name="baidu-site-verification" content="8IjIrlHyZp" />
    <meta property="og:url" content="https://laravist.com/">
    <meta property="og:site_name" content="Laravist">
    <link rel="shortcut icon" href="/images/favicon.ico">
    <title> Laravel</title>
    <style>
        body
        {
            background-color: #0A7189;
            color: #fff;
            font: 100% "Lato" , sans-serif;
            font-size: 1.8rem;
            font-weight: 300;
        }

        a
        {
            color: #75C6D9;
            text-decoration: none;
        }

        h3
        {
            margin-bottom: 1%;
        }

        ul
        {
            list-style: none;
            margin: 0;
            padding: 0;
            line-height: 50px;
        }

        li a:hover
        {
            color: #fff;
        }

        .center
        {
            text-align: center;
        }

        /* Search Bar Styling */
        form > *
        {
            vertical-align: middle;
        }

        .srchBtn
        {
            border: 0;
            border-radius: 7px;
            padding: 0 17px;
            background: #e74c3c;
            width: 99px;
            border-bottom: 5px solid #c0392b;
            color: #fff;
            height: 65px;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .srchBtn:active
        {
            border-bottom: 0px solid #c0392b;
        }

        .srchFld
        {
            border: 0;
            border-radius: 7px;
            padding: 0 17px;
            max-width: 404px;
            width: 40%;
            border-bottom: 5px solid #bdc3c7;
            height: 60px;
            color: #7f8c8d;
            font-size: 19px;
        }

        .srchFld:focus
        {
            outline-color: rgba(255, 255, 255, 0);
        }

        /* 404 Styling */
        .header
        {
            font-size: 7rem;
            font-weight: 700;
            margin: 2% 0 2% 0;
            text-shadow: 0px 3px 0px #7f8c8d;
        }

        /* Error Styling */
        .error
        {
            margin: -70px 0 2% 0;
            font-size: 5.4rem;
            text-shadow: 0px 3px 0px #7f8c8d;
            font-weight: 100;
        }
    </style>
</head>
<body>


<section class="center">
    <article>
        <h1 class="header">
            404</h1>
        <p class="error">
            @if($message)
                {!! $message !!}
            @else
            在该网站上找不到请求的网址
            @endif
        </p>
    </article>
    <article>
        <img src="/image/index/image/vovg1x.png" alt="Funny Face">
    </article>
    <article>
        <p>
            Lost? Maybe I can help.</p>
    </article>
    <article>
        <form action="">
            <input type="text" name="search" class="srchFld" placeholder="请输入您想找的内容&nbsp;!"
                   required />
            <button type="submit" class="srchBtn">
                搜索</button>
        </form>
    </article>
    <article>
        <h3>
            My Suggestions.</h3>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Portfolio</a></li>
        </ul>
    </article>
</section>

</body>
</html>

