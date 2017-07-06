<!--包含头部文件-->
@include('admin.public.head')
@inject('BisPresenter', 'App\Presenter\Admin\BisPresenter')

<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 商户入驻申请 </nav>
<div class="page-container">
	
	
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="80">ID</th>
					<th width="100">商户名称</th>
					<th width="30">法人</th>
					<th width="150">联系电话</th>
					<th width="60">申请时间</th>
					<th width="60">状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($biss as $bis)
				<tr class="text-c">
					<td>{{$bis->id}}</td>
					<td>{{$bis->name}}</td>
					<td class="text-c">{{$bis->faren}}</td>
					<td class="text-c">{{$bis->faren_tel}}</td>
					<td>{{$bis->created_at}}</td>
					<td class="td-status"><a href="" title="点击修改状态">
							{!! $BisPresenter->apply($bis->status) !!}
						</a></td>
					<td class="td-manage">
						<a style="text-decoration:none" class="ml-5" onClick="o2o_edit('编辑','{{url('admin/bis/edit' ,  ['id'=>$bis->id])}}','',500)" href="javascript:;" title="查看"><i class="Hui-iconfont">&#xe6e5;</i></a>
						<a style="text-decoration:none" class="ml-5" onClick="o2o_del('{!! $bis->id !!}','{{url('admin/bis/dele',['id'=>$bis->id])}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="pagination">{!! $biss->render() !!}</div>

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

