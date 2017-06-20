@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">用户注册</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">用户名：</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" placeholder="请输入用户名" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">邮箱地址:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" placeholder="请输入邮箱地址" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码：</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" placeholder="请输入密码" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">确认密码：</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" placeholder="再次输入密码" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('verifycode') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">验证码：</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="verifycode" placeholder="请输入验证码" required>
                                @if ($errors->has('verifycode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('verifycode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div id="captcha">
                            <span class="input-group-btn">
                                <img style="cursor: pointer;width: 342px;height: 70px;margin-left: 250px;" src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}' + Math.random()">
                            </span>
                        </div>
                        <div class="container" style="margin-top:10px;margin-left: 225px">

                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 ">
                                <button type="submit" class="btn btn-primary btn-block">
                                    注册
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
