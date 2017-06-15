<!--包含头部文件-->
@include('bis.public.header')
<style>
  .list-group {
    margin-bottom: 20px;
    margin-left: 500px;
  }
  .list {
    text-align:center;
    font-size: 25px;
    width: 280px;
    height: 40px;
    margin-bottom: 20px;
    color:#a94442;
    background-color:#f2dede;
  }
</style>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"><h1 style="text-align:center">商户登录系统</h1></div>
<div class="loginWraper">

  <div id="loginform" class="loginBox">

    <form class="form form-horizontal" action="{{url('/bis/login')}}" method="post">
      {!! csrf_field() !!}
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      
      
      <div class="row cl">

        <div class="formControls col-xs-8 col-xs-offset-3">

          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
          <a href="{{url('bis/register/index')}}"><input name="" type="" class="btn btn-success radius size-L" value="&nbsp;申请&nbsp;&nbsp;&nbsp;&nbsp;入驻&nbsp;"></a>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright laravel 打造本地生活服务系统</div>
<!--包含尾部文件-->
@include('bis.public.footer')
@include('errors.list')

