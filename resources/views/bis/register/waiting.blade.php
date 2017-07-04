<!--包含头部文件-->
@include('bis.public.header')
<div class="cl pd-5 bg-1 bk-gray mt-20">
    @if($detail)
    <h1>@if($detail->status == 0)待审核，审核后平台方会发送邮件通知，请关注 @elseif($detail->status == 1)入驻申请成功 @elseif($detail->status == 2) 非常抱歉，您提交的资料不符合条件，请重新提交 @else 该申请已被删除 @endif</h1>
    @else
    <h1>不存在该入驻申请情况</h1>
    @endif
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <img src="/image/index/image/logo.png" />
                    </div>
                    <div class="modal-body" style="width: 400px;">

                        <table width="100%">
                            <tbody>
                            <div class="center"><h1 class="title">使用微信扫码支付</h1><img src="{{url('/wechat/example') . '/qrcode.php?data=' . urlencode($url)}}" alt="微信扫码支付" width="300;" height="300"></div>

                            <tr>
                                <td class="fl_left ">
                                    <ul class="order-list">
                                        <li>
                                            <span class="order-list-no">订单:</span>
                                            <span class="order-list-name">{{$deal->name}}</span><span class="order-list-number">{{$order->deal_count}}份</span>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="fl-list">
                                        <li>
                                            <span class="order-list-no">应付金额：{{$order->total_price}}元</span>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"  data-dismiss="modal">关闭</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>









</div>
@include('bis.public.footer')
</body>
</html>