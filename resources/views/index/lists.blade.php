@include('index.public.head')
@include('index.public.nav')

    <div class="page-body">
        <div class="filter-bg">
            <div class="filter-wrap">
                <div class="w-filter-ab-test">
                    <div class="w-filter-top-nav clearfix" style="margin:12px">
                        
                        
                    </div>
                    
                    <div class="filter-wrapper">
                        <div class="normal-filter ">
                            <div class="w-filter-normal-ab  filter-list-ab">
                                <h5 class="filter-label-ab">分类</h5>
                                <span class="filter-all-ab">
                                    <a href="{{url('index/list', ['id' => 0])}}" class="w-filter-item-ab  item-all-auto-ab"><span class="item-content @if($id ==0) filter-active-all-ab @endif">全部</span></a>
                                </span>
                                <div class="j-filter-items-wrap-ab filter-items-wrap-ab">
                                    <div class="j-filter-items-ab filter-items-ab filter-content-ab">
                                        @foreach($categroys as $category)
                                        <a class="w-filter-item-ab " href="{{url('index/list', ['id' => $category['id']])}}"><span class="item-content @if($category['id'] == $categoryParentId) filter-active-all-ab @endif">{{$category['name']}}</span></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    @if($secondCategorys)
                    <div class="filter-wrapper">
                        <div class="normal-filter ">
                            <div class="w-filter-normal-ab  filter-list-ab">
                                <h5 class="filter-label-ab">子分类</h5>
                                <span class="filter-all-ab">
                                    
                                </span>
                                <div class="j-filter-items-wrap-ab filter-items-wrap-ab">
                                    <div class="j-filter-items-ab filter-items-ab filter-content-ab">
                                        @foreach($secondCategorys as $val)
                                        <a href="{{url('index/list', ['id' => $val['id']])}}" class="w-filter-item-ab"><span class="item-content @if($val['id'] == $id) filter-active-all-ab @endif">{{$val['name']}}</span></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="w-sort-bar">
                    <div class="bar-area" style="position: relative; left: 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; top: 0px;">
                        <span class="sort-area">
                            <a class="sort-default @if($orderflag == '') sort-default-active @endif ">默认</a>
                            <a href="{{url('index/list', ['id' => $id, 'order' => 1])}}" class="sort-item sort-down @if($orderflag == 'order_sales') sort-default-active @endif" title="点击按销量降序排序">销量↓</a>
                            <a  href="{{url('index/list', ['id' => $id, 'order' => 2])}}" class="sort-item price-default price @if($orderflag == 'order_price') sort-default-active @endif" title="点击按价格降序排序">价格↓</a>
                            
                            <a  href="{{url('index/list', ['id' => $id, 'order' => 3])}}" class="sort-item sort-up @if($orderflag == 'order_time') sort-default-active @endif" title="发布时间由近到远">最新发布↑</a>
                        </span>
                    </div>
                </div>
                <ul class="itemlist eight-row-height">
                    <li class="j-card">
                        <a>
                            <div class="imgbox">
                                <ul class="marketing-label-container">
                                    <li class="marketing-label marketing-free-appoint"></li>
                                </ul>
                                <div class="range-area">
                                    <div class="range-bg"></div>
                                    <div class="range-inner">
                                        <span class="white-locate"></span>
                                        安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                    </div>
                                </div>
                                <div class="borderbox">
                                    <img src="image/b219ebc4b74543a9c6c87b8e18178a82b80114a4.jpg" />
                                </div>
                            </div>
                        </a>
                        <div class="contentbox">
                            <a href="//www.nuomi.com/deal/ke0370si.html" target="_blank">
                                <div class="header">
                                    <h4 class="title ">【6店通用】好伦哥</h4>
                                    <div class="collected">精选</div>
                                </div>
                                <p>单人自助餐！免费WiFi！</p>
                            </a>
                            <div class="add-info"></div>
                            <div class="pinfo">
                                <span class="price"><span class="moneyico">¥</span>52</span>
                                <span class="ori-price">价值<span class="price-line">¥<span>56</span></span></span>
                            </div>
                            <div class="footer">
                                <span class="comment">4.6分</span><span class="sold">已售337334</span>
                                <div class="bottom-border"></div>
                            </div>
                        </div>
                    </li>
                    <li class="j-card">
                        <a>
                            <div class="imgbox">
                                <ul class="marketing-label-container">
                                    <li class="marketing-label marketing-free-appoint"></li>
                                </ul>
                                <div class="range-area">
                                    <div class="range-bg"></div>
                                    <div class="range-inner">
                                        <span class="white-locate"></span>
                                        安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                    </div>
                                </div>
                                <div class="borderbox">
                                    <img src="image/b219ebc4b74543a9c6c87b8e18178a82b80114a4.jpg" />
                                </div>
                            </div>
                        </a>
                        <div class="contentbox">
                            <a href="//www.nuomi.com/deal/ke0370si.html" target="_blank">
                                <div class="header">
                                    <h4 class="title ">【6店通用】好伦哥</h4>
                                    <div class="collected">精选</div>
                                </div>
                                <p>单人自助餐！免费WiFi！</p>
                            </a>
                            <div class="add-info">
                                <span class="promo">立减3.6元</span>
                            </div>
                            <div class="pinfo">
                                <span class="price"><span class="moneyico">¥</span>52</span>
                                <span class="ori-price">价值<span class="price-line">¥<span>56</span></span></span>
                            </div>
                            <div class="footer">
                                <span class="comment">4.6分</span><span class="sold">已售337334</span>
                                <div class="bottom-border"></div>
                            </div>
                        </div>
                    </li>
                    <li class="j-card">
                        <a>
                            <div class="imgbox">
                                <ul class="marketing-label-container">
                                    <li class="marketing-label marketing-free-appoint"></li>
                                </ul>
                                <div class="range-area">
                                    <div class="range-bg"></div>
                                    <div class="range-inner">
                                        <span class="white-locate"></span>
                                        安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                    </div>
                                </div>
                                <div class="borderbox">
                                    <img src="image/b219ebc4b74543a9c6c87b8e18178a82b80114a4.jpg" />
                                </div>
                            </div>
                        </a>
                        <div class="contentbox">
                            <a href="//www.nuomi.com/deal/ke0370si.html" target="_blank">
                                <div class="header">
                                    <h4 class="title ">【6店通用】好伦哥</h4>
                                </div>
                                <p>单人自助餐！免费WiFi！</p>
                            </a>
                            <div class="add-info">
                                <span class="promo">立减3.6元</span>
                            </div>
                            <div class="pinfo">
                                <span class="price"><span class="moneyico">¥</span>52</span>
                                <span class="ori-price">价值<span class="price-line">¥<span>56</span></span></span>
                            </div>
                            <div class="footer">
                                <span class="comment">4.6分</span><span class="sold">已售337334</span>
                                <div class="bottom-border"></div>
                            </div>
                        </div>
                    </li>
                    <li class="j-card">
                        <a>
                            <div class="imgbox">
                                <ul class="marketing-label-container">
                                    <li class="marketing-label marketing-free-appoint"></li>
                                </ul>
                                <div class="range-area">
                                    <div class="range-bg"></div>
                                    <div class="range-inner">
                                        <span class="white-locate"></span>
                                        安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                    </div>
                                </div>
                                <div class="borderbox">
                                    <img src="image/b219ebc4b74543a9c6c87b8e18178a82b80114a4.jpg" />
                                </div>
                            </div>
                        </a>
                        <div class="contentbox">
                            <a href="//www.nuomi.com/deal/ke0370si.html" target="_blank">
                                <div class="header">
                                    <h4 class="title ">【6店通用】好伦哥</h4>
                                </div>
                                <p>单人自助餐！免费WiFi！</p>
                            </a>
                            <div class="add-info">
                                <span class="promo">立减3.6元</span>
                            </div>
                            <div class="pinfo">
                                <span class="price"><span class="moneyico">¥</span>52</span>
                                <span class="ori-price">价值<span class="price-line">¥<span>56</span></span></span>
                            </div>
                            <div class="footer">
                                <span class="comment">4.6分</span><span class="sold">已售337334</span>
                                <div class="bottom-border"></div>
                            </div>
                        </div>
                    </li>
                    <li class="j-card">
                        <a>
                            <div class="imgbox">
                                <ul class="marketing-label-container">
                                    <li class="marketing-label marketing-free-appoint"></li>
                                </ul>
                                <div class="range-area">
                                    <div class="range-bg"></div>
                                    <div class="range-inner">
                                        <span class="white-locate"></span>
                                        安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                    </div>
                                </div>
                                <div class="borderbox">
                                    <img src="image/b219ebc4b74543a9c6c87b8e18178a82b80114a4.jpg" />
                                </div>
                            </div>
                        </a>
                        <div class="contentbox">
                            <a href="//www.nuomi.com/deal/ke0370si.html" target="_blank">
                                <div class="header">
                                    <h4 class="title ">【6店通用】好伦哥</h4>
                                </div>
                                <p>单人自助餐！免费WiFi！</p>
                            </a>
                            <div class="add-info">
                                <span class="promo">立减3.6元</span>
                            </div>
                            <div class="pinfo">
                                <span class="price"><span class="moneyico">¥</span>52</span>
                                <span class="ori-price">价值<span class="price-line">¥<span>56</span></span></span>
                            </div>
                            <div class="footer">
                                <span class="comment">4.6分</span><span class="sold">已售337334</span>
                                <div class="bottom-border"></div>
                            </div>
                        </div>
                    </li>
                    <li class="j-card">
                        <a>
                            <div class="imgbox">
                                <ul class="marketing-label-container">
                                    <li class="marketing-label marketing-free-appoint"></li>
                                </ul>
                                <div class="range-area">
                                    <div class="range-bg"></div>
                                    <div class="range-inner">
                                        <span class="white-locate"></span>
                                        安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                    </div>
                                </div>
                                <div class="borderbox">
                                    <img src="image/b219ebc4b74543a9c6c87b8e18178a82b80114a4.jpg" />
                                </div>
                            </div>
                        </a>
                        <div class="contentbox">
                            <a href="//www.nuomi.com/deal/ke0370si.html" target="_blank">
                                <div class="header">
                                    <h4 class="title ">【6店通用】好伦哥</h4>
                                </div>
                                <p>单人自助餐！免费WiFi！</p>
                            </a>
                            <div class="add-info"></div>
                            <div class="pinfo">
                                <span class="price"><span class="moneyico">¥</span>52</span>
                                <span class="ori-price">价值<span class="price-line">¥<span>56</span></span></span>
                            </div>
                            <div class="footer">
                                <span class="comment">4.6分</span><span class="sold">已售337334</span>
                                <div class="bottom-border"></div>
                            </div>
                        </div>
                    </li>
                    <li class="j-card">
                        <a>
                            <div class="imgbox">
                                <ul class="marketing-label-container">
                                    <li class="marketing-label marketing-free-appoint"></li>
                                </ul>
                                <div class="range-area">
                                    <div class="range-bg"></div>
                                    <div class="range-inner">
                                        <span class="white-locate"></span>
                                        安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                    </div>
                                </div>
                                <div class="borderbox">
                                    <img src="image/b219ebc4b74543a9c6c87b8e18178a82b80114a4.jpg" />
                                </div>
                            </div>
                        </a>
                        <div class="contentbox">
                            <a href="//www.nuomi.com/deal/ke0370si.html" target="_blank">
                                <div class="header">
                                    <h4 class="title ">【6店通用】好伦哥</h4>
                                </div>
                                <p>单人自助餐！免费WiFi！</p>
                            </a>
                            <div class="add-info">
                                <span class="promo">立减3.6元</span>
                            </div>
                            <div class="pinfo">
                                <span class="price"><span class="moneyico">¥</span>52</span>
                                <span class="ori-price">价值<span class="price-line">¥<span>56</span></span></span>
                            </div>
                            <div class="footer">
                                <span class="comment">4.6分</span><span class="sold">已售337334</span>
                                <div class="bottom-border"></div>
                            </div>
                        </div>
                    </li>
                    <li class="j-card">
                        <a>
                            <div class="imgbox">
                                <ul class="marketing-label-container">
                                    <li class="marketing-label marketing-free-appoint"></li>
                                </ul>
                                <div class="range-area">
                                    <div class="range-bg"></div>
                                    <div class="range-inner">
                                        <span class="white-locate"></span>
                                        安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                    </div>
                                </div>
                                <div class="borderbox">
                                    <img src="image/b219ebc4b74543a9c6c87b8e18178a82b80114a4.jpg" />
                                </div>
                            </div>
                        </a>
                        <div class="contentbox">
                            <a href="//www.nuomi.com/deal/ke0370si.html" target="_blank">
                                <div class="header">
                                    <h4 class="title ">【6店通用】好伦哥</h4>
                                </div>
                                <p>单人自助餐！免费WiFi！</p>
                            </a>
                            <div class="add-info">
                                <span class="promo">立减3.6元</span>
                            </div>
                            <div class="pinfo">
                                <span class="price"><span class="moneyico">¥</span>52</span>
                                <span class="ori-price">价值<span class="price-line">¥<span>56</span></span></span>
                            </div>
                            <div class="footer">
                                <span class="comment">4.6分</span><span class="sold">已售337334</span>
                                <div class="bottom-border"></div>
                            </div>
                        </div>
                    </li>
                    <li class="j-card">
                        <a>
                            <div class="imgbox">
                                <ul class="marketing-label-container">
                                    <li class="marketing-label marketing-free-appoint"></li>
                                </ul>
                                <div class="range-area">
                                    <div class="range-bg"></div>
                                    <div class="range-inner">
                                        <span class="white-locate"></span>
                                        安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                    </div>
                                </div>
                                <div class="borderbox">
                                    <img src="image/b219ebc4b74543a9c6c87b8e18178a82b80114a4.jpg" />
                                </div>
                            </div>
                        </a>
                        <div class="contentbox">
                            <a href="//www.nuomi.com/deal/ke0370si.html" target="_blank">
                                <div class="header">
                                    <h4 class="title ">【6店通用】好伦哥</h4>
                                </div>
                                <p>单人自助餐！免费WiFi！</p>
                            </a>
                            <div class="add-info">
                                <span class="promo">立减3.6元</span>
                            </div>
                            <div class="pinfo">
                                <span class="price"><span class="moneyico">¥</span>52</span>
                                <span class="ori-price">价值<span class="price-line">¥<span>56</span></span></span>
                            </div>
                            <div class="footer">
                                <span class="comment">4.6分</span><span class="sold">已售337334</span>
                                <div class="bottom-border"></div>
                            </div>
                        </div>
                    </li>
                    <li class="j-card">
                        <a>
                            <div class="imgbox">
                                <ul class="marketing-label-container">
                                    <li class="marketing-label marketing-free-appoint"></li>
                                </ul>
                                <div class="range-area">
                                    <div class="range-bg"></div>
                                    <div class="range-inner">
                                        <span class="white-locate"></span>
                                        安贞 六里桥 丽泽桥 安定门 劲松 昌平镇 航天桥 通州区 通州北苑
                                    </div>
                                </div>
                                <div class="borderbox">
                                    <img src="image/b219ebc4b74543a9c6c87b8e18178a82b80114a4.jpg" />
                                </div>
                            </div>
                        </a>
                        <div class="contentbox">
                            <a href="//www.nuomi.com/deal/ke0370si.html" target="_blank">
                                <div class="header">
                                    <h4 class="title ">【6店通用】好伦哥</h4>
                                </div>
                                <p>单人自助餐！免费WiFi！</p>
                            </a>
                            <div class="add-info">
                                <span class="promo">立减3.6元</span>
                            </div>
                            <div class="pinfo">
                                <span class="price"><span class="moneyico">¥</span>52</span>
                                <span class="ori-price">价值<span class="price-line">¥<span>56</span></span></span>
                            </div>
                            <div class="footer">
                                <span class="comment">4.6分</span><span class="sold">已售337334</span>
                                <div class="bottom-border"></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-wrap">共<span style="color: #ff4883">4321</span>条</div>
    </div>

    <div class="footer-content">
        <div class="copyright-info">
            
        </div>
    </div>
    <script>
        $(".tab-item-wrap").click(function(){
            var index = $(".tab-item-wrap").index(this);
            $(".tab-item-wrap").removeClass("selected");
            $(".district-cont-wrap").css({display: "none"});
            $(this).addClass("selected");
            $(".district-cont-wrap").eq(index).css({display: "block"});
        });

        $(".sort-area a").click(function(){
            $(".sort-area a").removeClass("sort-default-active").css({color: "#666"});
            $(this).addClass("sort-default-active").css({color: "#ff4883"});
        });
    </script>
</body>
</html>