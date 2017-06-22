<!--包含头部文件-->
@include('bis.public.header')
<style>
	.tp5-o2o .pagination li{display: inline;padding-left: 10px;}
	.pagination .active{color: red}
	.pagination .disabled{color: #888888}
	.pagination {
		display: inline-block;
		padding-left: 0;
		margin: 20px 0;
		margin-right: 0px;
		margin-left: 10px;
		border-radius: 4px;
	}
	.tp5-o2o{margin-left: 350px;font-size: 25px;}

</style>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 商户入驻申请 </nav>
<div class="page-container">
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="80">ID</th>
					<th width="100">名称</th>
					<th width="60">申请时间</th>
					<th width="60">是否为总店</th>
					<th width="60">状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($locations as $location)
				<tr class="text-c">
					<td>{{$location->id}}</td>
					<td>{{$location->name}}</td>
					<td>{{$location->created_at}}</td>
					<td>{{isMain($location->is_main)}}</td>
					<td class="td-status">{{changeStatus($location->status)}}</td>
					<td class="td-manage">
						<a style="text-decoration:none" class="ml-5" onClick="o2o_edit('编辑','{{url('bis/location/edit', ['id' => $location->id] )}}','',300)" href="javascript:;" title="查看"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a style="text-decoration:none" class="ml-5" onClick="o2o_s_del('{{$location->id}}','{{url('bis/locations/del', ['id' => $location->id])}}')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="pagination">{{$locations->links()}}</div>
<script>
    var SCOPE={
    }
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
    function o2o_s_del(id,url){

        layer.confirm('确认要删除吗？',function(index){
            window.location.href=url;
        });
    }
</script>
<!--包含头部文件-->
@include('bis.public.footer')

