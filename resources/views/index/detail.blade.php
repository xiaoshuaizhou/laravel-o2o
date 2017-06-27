@include('index.public.head')
@include('index.public.nav')

    <div class="p-detail">
        <div class="p-bread-crumb">
            <div class="w-bread-crumb">
                <ul class="crumb-list">
                    <li class="crumb"><a>团购</a><span class="ico-gt">&gt;</span></li>
                    <li class="crumb"><a>美食</a><span class="ico-gt">&gt;</span></li>
                    <li class="crumb crumb-last"><a>{{$locations[0]->name}}</a></li>
                </ul>
            </div>
        </div>
        <div class="static-hook-real static-hook-id-5"></div>
        <div class="p-item-info">
            <div class="w-item-info">
                <h2>{{$locations[0]->name}}</h2>
                <div class="item-title">
                    <span class="text-main">{{$deal->name}}</span>
                </div>
                <div class="ii-images static-hook-real static-hook-id-6">
                    <div class="w-item-images">
                        <div class="images-board">
                            <div class="item-status ">
                                <span class="ico-status ico-jingxuan"></span>
                            </div>
                            <img src="{{$deal->image}}" class="item-img-large" />
                        </div>
                        <ul class="images-list clearfix">
                            <li class="images images-last">
                                <img src="{{$deal->image}}  " />
                            </li>
                        </ul>
                        <div class="erweima-share-collect">
                            <ul class="item-option clearfix">
                                <li class=" ">
                                    
                                    <div class="collect-success">
                                        
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ii-intro">
                    <div class="w-item-intro">
                        <div class="price-area-wrap static-hook-real static-hook-id-8">
                            <div class="price-area has-promotion-icon">
                                <div class="pic-price-area">
                                    <span class="unit">¥</span>
                                    <span class="priceNum">{{$deal->current_price}}</span>
                                </div>
                                
                                <div class="market-price-area">
                                    <div class="price">¥{{$deal->origin_price}}</div>
                                    <div class="name">价值</div>
                                </div>
                                
                                
                            </div>
                        </div>
                        @if($flag == 1)
                        <div class="static-hook-real static-hook-id-9">
                            <a class="link jingxuan-box" alt="更多精选品牌特惠">
                                <div class="box">
                                    
                                    <div class="jx-update" id="j-jxUpdateTime">
                                        <span>距离开始时间还有</span>
                                        <span class="jx-timerbox">{{$timedate}}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                        <ul class="ugc-strategy-area static-hook-real static-hook-id-10">
                            <li class="item-bought">
                                <div class="sl-wrap">
                                    <div class="sl-wrap-cnt">
                                        <div class="item-bought-num"><span class="intro-strong">{{$deal->buy_count}}</span>人已团购</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="buy-panel-wrap">
                            <div class="buy-panel">
                                <div class="validdate-buycount-area static-hook-real static-hook-id-11">
                                    <div class="item-countdown-row">
                                        <span class="name">有效期</span>
                                        <span class="value">{{$deal->coupons_end_time}}</span>
                                    </div>
                                    <div class="item-buycount-row j-item-buycount-row">
                                        <div class="name">数&nbsp;&nbsp;&nbsp;量</div>
                                        <div class="buycount-ctrl">
                                            <a href="javascript:;" class="j-ctrl ctrl minus disabled"><span class="horizontal"></span></a>
                                            <input type="text" value="1" maxlength="10" autocomplete="off">
                                            <a href="javascript:;" class="ctrl j-ctrl plus "><span class="horizontal"></span><span class="vertical"></span></a>
                                        </div>
                                        <div class="text-wrap">
                                            <span class="left-budget">优惠价剩余{{$overplus}}份</span>
                                            <span class="err-wrap j-err-wrap"></span>
                                        </div>
                                    </div>
                                </div>
                                @if($flag != 1)
                                <div class="item-buy-area">
                                    <div style="float:left" class="static-hook-real static-hook-id-12">
                                        <a href="" class="o2o-click  btn-buy btn-buy-qrnew j-btn-buy btn-hit">立即抢购</a>
                                    </div>
                                </div>
                                    @else
                                    <div class="item-buy-area">
                                        <div style="float:left" class="static-hook-real static-hook-id-12">
                                            <a  style="background: #c0c0c0;border-bottom: #c0c0c0" class="btn-buy btn-buy-qrnew j-btn-buy btn-hit">立即抢购</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-item-info-more">
            <div class="iim-wrapper">
                <div class="spec-nav ">
                    <div class="nav-bar"></div>
                    <div class="w-spec-nav" style="position: static; top: auto; z-index: auto;">
                        <ul class="sn-list">
                            <li class="spec-nav-current">
                                <i></i><a><span>本单详情</span></a>
                            </li>
                            <li class="">
                                <i></i><a><span>消费提示</span></a>
                            </li>
                            <li class="">
                                <i></i><a><span>商家介绍</span></a>
                            </li>
                        </ul>

                    </div>
                </div>
                <ul class="j-info-all">
                    <li class="tab">
                        <div class="ia-shop-branch">
                            <div class="w-shop-branch">
                                <h3 class="w-section-header">分店信息</h3>
                                <div class="branch-content">
                                    <div class="shop-map">
                                        <div class="w-map">

                                            <img src="{{url('index/map', ['data' => $mapStr])}}" alt="">
                                        </div>
                                    </div>
                                    <div class="branch-detail">
                                        <div>
                                            <div class="w-area-filter">
                                                <label>分店信息：</label>

                                            </div>
                                            <div class="branch-list-content">
                                                <div class="w-branch-list">
                                                    <ul class="branch-list-content">
                                                        @foreach($locations as $location)
                                                        <li class="branch branch-close">
                                                            <a href="//www.nuomi.com/shop/133957" target="_blank" class="branch-name">{{$location->name}}</a>
                                                            <p class="branch-address">{{$location->api_address}}</p>
                                                            <p class="branch-tel">{{$location->tel}}</p>

                                                        </li>
                                                            @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ifram"><h3>{{strip_tags(html_entity_decode($deal->description))}}</h3></div>
                    </li>
                    <li class="tab"><div class="ifram">消费提示（此处高度随着填充的内容自动变化）</div></li>
                    <li class="tab"><div class="ifram"><h2>{{strip_tags($shanghuinfo->description)}}</h2></div></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-content">
        <div class="copyright-info">
            <div class="site-info">
                
            </div>
            <div class="icons">
                
            </div>
            <div style="width:200px;margin:0 auto; padding:20px 0;">
               
            </div>
        </div>
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
$(".o2o-click").click(function () {
    var count = $(".buycount-ctrl input").val();
    var id = "{{$deal->id}}";
    var url = "{{url('index/order')}}" + "/" + id + "/" + count;
    window.open(url);

});
        $(".sn-list li").click(function(){
            var index = $(".sn-list li").index(this)
            $(".sn-list li").removeClass("spec-nav-current");
            $(".j-info-all .tab").css({display: "none"});
            $(this).addClass("spec-nav-current");
            $(".j-info-all .tab").eq(index).css({display: "block"});
        });

        $(".branch").mouseenter(function(){
            $(".branch").removeClass("branch-open").addClass("branch-close");
            $(this).removeClass("branch-close").addClass("branch-open");
        });
    </script>
</body>
</html>