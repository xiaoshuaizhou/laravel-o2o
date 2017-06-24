@include('index.public.head')
@include('index.public.nav')

        <div class="content-container">
            <div class="no-recom-container">
                <div class="floor-content-start">

                    <div class="floor-content">
                        <div class="floor-header">
                            <h3>美食推荐</h3>
                            <ul class="reco-words">
                                <li><a href="//t10.nuomi.com/pc/t10/index" target="_blank">精选品牌</a></li>
                                @foreach($meishiCategory as $vo)
                                <li><a href="{{url('index/list', ['id' => $vo->id])}}" target="_blank">{{$vo->name}}</a></li>
                                @endforeach
                                <li><a href="{{url('index/list', ['id' => 3])}}" class="no-right-border no-right-padding" target="_blank">全部<span class="all-cate-arrow"></span></a></li>
                            </ul>
                        </div>
                        <ul class="itemlist eight-row-height">
                        @if(!empty($datas->toArray()))
                            @foreach($datas as $data)
                            <li class="j-card">
                                <a>
                                    <div class="imgbox">
                                        <ul class="marketing-label-container">
                                            <li class="marketing-label marketing-free-appoint"></li>
                                        </ul>
                                        <div class="range-area">
                                            <div class="range-bg"></div>
                                            <div class="range-inner">

                                            </div>
                                        </div>
                                        <div class="borderbox">
                                            <img src="{{$data->image}}" />
                                        </div>
                                    </div>
                                </a>
                                <div class="contentbox">
                                    <a href="{{url('index/detail', ['id'=>$data->id])}}" target="_blank">
                                        <div class="header">
                                            <h4 class="title ">【{{countLocation($data->location_ids)}}店通用】好伦哥</h4>
                                        </div>
                                        <p>{{$data->name}}</p>
                                    </a>
                                    <div class="add-info"></div>
                                    <div class="pinfo">
                                        <span class="price"><span class="moneyico">¥</span>{{$data->current_price}}</span>
                                        <span class="ori-price">价值<span class="price-line">¥<span>{{$data->origin_price}}</span></span></span>
                                    </div>
                                    <div class="footer">
                                        <span class="sold">已售{{$data->buy_count}}</span>
                                        <div class="bottom-border"></div>
                                    </div>
                                </div>
                            </li>
                             @endforeach
                        @else
                                <span style="color: red;font-size: 24px;">该城市暂时没有此类数据</span>
                        @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="footer-content">
        <div class="copyright-info">
            
        </div>
    </div>

    <script>
        var width = 800 * $("#slide-holder ul li").length;
        $("#slide-holder ul").css({width: width + "px"});

        //轮播图自动轮播
        var time = setInterval(moveleft,5000);

        //轮播图左移
        function moveleft(){
            $("#slide-holder ul").animate({marginLeft: "-737px"},600, function () {
                $("#slide-holder ul li").eq(0).appendTo($("#slide-holder ul"));
                $("#slide-holder ul").css("marginLeft","0px");
            });
        }

        //轮播图右移
        function moveright(){
            $("#slide-holder ul").css({marginLeft: "-737px"});
            $("#slide-holder ul li").eq(($("#slide-holder ul li").length)-1).prependTo($("#slide-holder ul"));
            $("#slide-holder ul").animate({marginLeft: "0px"},600);
        }

        //右滑箭头点击事件
        $(".slide-next").click(function () {
            clearInterval(time);
            moveright();
            time = setInterval(moveleft,5000);
        });

        //左滑箭头点击事件
        $(".slide-prev").click(function () {
            clearInterval(time);
            moveleft();
            time = setInterval(moveleft,5000);
        });
    </script>
</body>
</html>