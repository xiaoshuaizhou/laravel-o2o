<!--包含头部文件-->
@include('admin.public.head')
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 城市管理 <span class="c-gray en">&gt;</span> 城市列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius" onclick="o2o_s_edit('添加所属城市','{{url('admin/city/add')}}','','300')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加城市</a></span> <span class="r"></span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="40"><input name="" type="checkbox" value=""></th>
                <th width="80">ID</th>
                <th width="100">分类</th>
                <th width="30">排序序号</th>
                <th width="150">新增时间</th>
                <th width="60">发布状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($citys as $city)
            <tr class="text-c">
                <td><input name="" type="checkbox" value=""></td>
                <td>{{$city->id}}</td>
                <td>{{$city->name}}</td>
                <td class="text-c"><input style="width: 30px" name="" type="input" value="{{$city->listorder}}"></td>
                <td>{{$city->created_at}}</td>
                <td class="td-status"><a href="{{url('admin/status/citystatus',['id' => $city->id,'status'=>$city->status])}}" title="点击修改状态">@if($city->status ==0)待审核 @else 正常 @endif</a></td>
                <td class="td-manage">
                    <a href="{{url('admin/city' , ['parent_id' => $city->id])}}">获取子栏目</a>
                    <a style="text-decoration:none" class="ml-5" onClick="o2o_s_edit('编辑','{{url('admin/city/edit' ,  ['id'=>$city->id])}}','',300)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
                    <a style="text-decoration:none" class="ml-5" onClick="o2o_del('{!! $city->id !!}','{{url('admin/city/del',['id'=>$city->id])}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <div class="pagination">{!! $citys->render() !!}</div>

</div>
<!--包含头部文件-->
@include('admin.public.footer')
<script>
    /*页面 全屏-添加*/
    function o2o_edit(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*添加或者编辑缩小的屏幕*/
    function o2o_s_edit(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*-删除*/
    function o2o_del(id,url){

        layer.confirm('确认要删除吗？',function(index){
            window.location.href=url;
        });
    }

</script>
