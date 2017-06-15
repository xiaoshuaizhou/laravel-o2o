<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>注册</title>
    <link rel="stylesheet" href="/index/css/base.css" />
    <link rel="stylesheet" href="/index/css/register.css" />
    <script type="text/javascript" src="/index/js/html5shiv.js"></script>
    <script type="text/javascript" src="/index/js/respond.min.js"></script>
    <script type="text/javascript" src="/index/js/jquery-1.11.3.min.js"></script>
</head>
<style>
    .list-group {
        margin-bottom: 20px;
    }
    .list {
        text-align:center;
        font-size: 25px;
        width: 350px;
        height: 40px;
        margin-bottom: 20px;
        color:#a94442;
        background-color:#f2dede;
    }
</style>
<body>
<div class="wrapper">
    <div class="head">
        <ul>
            <li><a href=""><img src="/index/image/logo.png" alt="logo"></a></li>
            <li class="divider"></li>
            <li><a href=""></a></li>
        </ul>
        <div class="login-link">
            <span>我已注册，现在就</span>
            <a href="{{url('auth/login')}}">登录</a>
        </div>
    </div>

    <div class="content">
        <form action="{{url('auth/register')}}" method="post">
            {{csrf_field()}}
            <p class="pass-form-item">
                <label class="pass-label">用户名</label>
                <input type="text" name="username" class="pass-text-input" placeholder="请设置用户名">
            </p>
            <p class="pass-form-item">
                <label class="pass-label">邮箱号</label>
                <input type="text" name="email" class="pass-text-input" placeholder="请输入邮箱号">
            </p>

            <p class="pass-form-item">
                <label class="pass-label">密码</label>
                <input type="text" name="password" class="pass-text-input" placeholder="请设置登录密码">
            </p>
            <p class="pass-form-item">
                <label class="pass-label">确认密码</label>
                <input type="text" name="password confirmation" class="pass-text-input" placeholder="请设置登录密码">
            </p>
            <p class="pass-form-item">
                <label class="pass-label">验证码</label>
                <input type="text" name="verifyCode" class="pass-text-input " placeholder="请输入验证码">
            </p>
            <div id="captcha">
            <span class="input-group-btn">
                <img style="cursor: pointer;" src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}' + Math.random()">
            </span>
            </div>


            <p class="pass-form-item">
                <input type="submit" value="注册" class="pass-button">
            </p>

        </form>
    <br>
    </div>
    <div class="container" style="margin-left: 225px">
      @include('errors.list')
    </div>

    <div class="foot">
        <div>
            <div>2017&nbsp;©zhouxiaoshuai</div>
        </div>
    </div>
</div>
</body>
</html>