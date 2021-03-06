<!--包含头部文件-->
@include('admin.public.head')
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类管理 <span class="c-gray en">&gt;</span> 分类列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius" onclick="o2o_s_edit('添加生活服务分类','{{url('admin/category/add')}}','','300')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> <span class="r"></span> </div>
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
            @foreach($categorys as $category)
            <tr class="text-c">
                <td><input name="" type="checkbox" value=""></td>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td class="listorder"><input  style="width: 20px;" name="listorder" att-id="{{$category->id}}" type="text" value="{{$category->listorder}}"></td>
                <td>{{$category->created_at}}</td>
                <td class="td-status"><a href="{{url('admin/status/index', ['id' => $category->id ,'status' => $category->status])}}" title="点击修改状态">
                        {{changeStatus($category->status)}}
                    </a></td>
                <td class="td-manage">
                    <a href="{{url('admin/category',['id' => $category->id])}}">获取子栏目</a>
                    <a style="text-decoration:none" class="ml-5" onClick="o2o_s_edit('编辑','{{url('admin/category/edit',['id' => $category->id] )}}','',300)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
                    <a style="text-decoration:none" class="ml-5" onClick="o2o_del('{{$category->id}}','{{url('admin/category/del', ['id' => $category->id])}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <div class="pagination">{{$categorys->links()}}</div>
</div>
<!--包含头部文件-->
@include('admin.public.footer')
<script>
    var SCOPE={
        'listorder_url' : '{{url('/admin/category/listorder')}}',
    };
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
    $('.listorder input').blur(function () {
        var id = $(this).attr('att-id');
        var listorder = $(this).val();
        var url = SCOPE.listorder_url;
        var postData = {
            'id':id,
            'listorder':listorder,
            '_token' :'{{ csrf_token() }}'
        };
        $.ajax({
            url: url,
            type: 'POST',
            data: postData,
            success: function (data) {
                console.log(data.msg)
            },
            error: function (data) {
                alert('执行错误,请稍后重试!');
            }
        });

    });
</script>
