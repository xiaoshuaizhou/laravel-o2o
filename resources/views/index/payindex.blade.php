@include('index.public.head')
<style>
    .modal-body {
        width: auto;
        height:500px;
    }
    .body {
        margin-left: 20px;
    }
    .modal-body{
        text-align: center;
    }
    .center{
        text-align: center;
    }
    .order-list{
        text-align: center;
        margin-left: 20px;
    }
</style>
<!--支付第二步-->
<div class="secondly">
    <div class="search">
        <img src="/image/index/image/logo.png" />
    </div>
    <!-- /.modal -->
    <div class="body">
        <div class="order_details">
            <table width="100%">
                <tbody>
                <div class="center"><h1 class="title">使用微信扫码支付</h1><img src="{{url('/wechat/example') . '/qrcode.php?data=' . urlencode($url)}}" alt="微信扫码支付" width="300;" height="300"></div>

                <tr>
                    <td class="fl_left ">
                        <ul class="order-list">
                            <li>
                                <span class="order-list-no">订单1:</span>
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
    </div>
</div>
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

<script>
    $(function() {
        $('#myModal').modal({
            keyboard: true
        })
    });
    //校验正整数
    function isNaN(number){
        var reg = /^[1-9]\d*$/;
        return reg.test(number);
    }
    function get_pay_status() {
        var url = "{{url('index/orders/paystatus')}}";

        var pay_success_url = "{{url('index/pays/paysuccess')}}";
        var id = "{{$order->id}}";
        var postData = {
            'id' : id,
            '_token' :'{{ csrf_token() }}'
        };
        $.ajax({
            url : url,
            type : 'POST',
            data : postData,
            success : function (data) {
                console.log(data);
                if (data.status == 1){
                    self.location.href=pay_success_url;
                }
            },
            error : function (data) {
                alert("操作失败，请重试");
            }
        });
    }
    window.setInterval("get_pay_status()", 2000);
</script>
</body>
</html>