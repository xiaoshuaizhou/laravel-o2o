<div class="search">
    <img src="/image/index/image/logo.png" />

</div>

<div class="nav-bar-header">
    <div class="nav-inner">
        <ul class="nav-list">
            <li class="nav-item">
                <span class="item">全部分类</span>
                <div class="left-menu">
                    @foreach($cats as $key=>$cat)
                    <div class="level-item">
                        <div class="first-level">
                            <dl>
                                <dt class="title"><a href="{{url('index/list',['id'=>$key])}}" target="_blank">{{$cat[0]}}</a></dt>
                                @foreach($cat[1] as $sedcat)
                                <dd><a href="{{url('index/list', ['id'=>$sedcat['id']])}}" target="_blank" class="">{{$sedcat['name']}}</a></dd>
                                @endforeach
                            </dl>
                        </div>
                        <div class="second-level">
                            <div class="section">
                                <div class="section-item clearfix no-top-border">
                                    <h3>精品：</h3>
                                    <ul>
                                    @foreach($cat[1] as $secondcat)
                                        <li><a target="_blank" href="{{url('index/list', ['id' => $secondcat['id']])}}">{{$secondcat['name']}}</a></li>
                                    @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </li>
            <li class="nav-item"><a class="item first active">首页</a></li>
            <li class="nav-item"><a class="item">团购</a></li>
            <li class="nav-item"><a class="item">商户</a></li>
        </ul>
    </div>
</div>

<div class="container">
    <div class="top-container">
        <div class="mid-area">
            <div class="slide-holder" id="slide-holder">
                <a href="#" class="slide-prev"><i class="slide-arrow-left"></i></a>
                <a href="#" class="slide-next"><i class="slide-arrow-right"></i></a>
                @if($controller == 'index')
                <ul class="slideshow">
                    @foreach($indexfeatured as $v)
                    <li><a href="" style="margin-left: -10px;" class="item-large">
                            <img class="ad-pic" src="{{$v['image']}}" />
                        </a>
                    </li>
                    @endforeach
                </ul>
                    @endif
            </div>
            <div class="list-container">

            </div>
        </div>
    </div>
    <div class="right-sidebar">
        <div class="right-ad">
            @if($controller == 'index')
            <ul class="slidepic">
                @foreach($right as $val)
                <li><a><img src="{{$val['image']}}" /></a></li>
                @endforeach

            </ul>
                @endif
        </div>

    </div>