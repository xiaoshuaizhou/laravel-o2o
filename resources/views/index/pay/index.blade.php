@include('index.public.head')

<!--支付第二步-->
<div class="secondly">
    <div class="search">
        <img src="/image/index/image/logo.png" />
        <div class="w-order-nav-new">
            <ul class="nav-wrap">
                <li>
                    <div class="no"><span>1</span></div>
                    <span class="text">确认订单</span>
                </li>
                <li class="to-line "></li>
                <li class="current">
                    <div class="no"><span>2</span></div>
                    <span class="text">选择支付方式</span>
                </li>
                <li class="to-line "></li>
                <li class="">
                    <div class="no"><span>3</span></div>
                    <span class="text">购买成功</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="order_infor_module">
        <div class="order_details">
            <table width="100%">
                <tbody>
                <tr>
                    <td class="fl_left ">
                        <ul class="order-list">
                            <li>
                                <span class="order-list-no">订单1:</span>
                                <span class="order-list-name">好伦哥6店单人自助</span><span class="order-list-number">2份</span>
                            </li>
                        </ul>
                    </td>
                    <td class="fl_right">
                        <dl>
                            <dt>应付金额：</dt>
                            <dd class="money"><span>107.2元</span></dd>
                        </dl>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="center"><h1 class="title">使用微信扫码支付</h1><img src="{{url('/wechat/example') . '/qrcode.php?data=' . urlencode('www.zhouxiaoshuai.me')}}" alt="微信扫码支付" width="300;" height="300"></div>

</div>

<div class="footer">
    <ul class="first">
        <h1></h1>
    </ul>
    <ul class="second">

    </ul>
</div>

<script>
    //校验正整数
    function isNaN(number){
        var reg = /^[1-9]\d*$/;
        return reg.test(number);
    }

    function inputChange(num){
        if(!isNaN(num)){
            $(".buycount-ctrl input").val("1");
        }
        else{
            $(".buycount-ctrl input").val(num);
            $(".j-sumPrice").text($("td .font14").text() * num - $(".j-cellActivity span").text());
            $(".sum .price").text($("td .font14").text() * num - $(".j-cellActivity span").text());
            if(num == 1){
                $(".buycount-ctrl a").eq(0).addClass("disabled");
            }
            else{
                $(".buycount-ctrl a").eq(0).removeClass("disabled");
            }
        }
    }

    $(".buycount-ctrl input").keyup(function(){
        var num = $(".buycount-ctrl input").val();
        inputChange(num);
    });
    $(".minus").click(function(){
        var num = $(".buycount-ctrl input").val();
        num--;
        inputChange(num);
    });
    $(".plus").click(function(){
        var num = $(".buycount-ctrl input").val();
        num++;
        inputChange(num);
    });
</script>
</body>
</html>