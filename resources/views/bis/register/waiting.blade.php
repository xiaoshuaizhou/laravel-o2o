<!--包含头部文件-->
@include('bis.public.header')
<div class="cl pd-5 bg-1 bk-gray mt-20">
    @if($detail)
    <h1>@if($detail->status == 0)待审核，审核后平台方会发送邮件通知，请关注 @elseif($detail->status == 1)入驻申请成功 @elseif($detail->status == 2) 非常抱歉，您提交的资料不符合条件，请重新提交 @else 该申请已被删除 @endif</h1>
    @else
    <h1>不存在该入驻申请情况</h1>
    @endif
        <a href="{{back()}}">点击返回！！</a>
</div>
@include('bis.public.footer')
</body>
</html>