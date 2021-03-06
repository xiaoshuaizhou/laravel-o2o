<!--包含头部文件-->
@include('bis.public.header')
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 商户入驻申请 </nav>
<div class="page-container">
<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius"  href="{{url('bis/deal/create')}}"><i class="Hui-iconfont">&#xe600;</i> 添加团购商品</a></span> <span class="r"></span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="80">ID</th>
					<th width="100">名称</th>
					<th width="60">申请时间</th>
					<th width="60">开始时间-结束时间</th>
					<th width="60">状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($deals as $deal)
				<tr class="text-c">
					<td>{{$deal->id}}</td>
					<td>{{$deal->name}}</td>
					<td>{{$deal->created_at}}</td>
					<td>{{$deal->start_time}}-{{$deal->end_time}}</td>
					<td class="td-status">{{changeStatus($deal->status)}}</td>
					<td class="td-manage">
						<a style="text-decoration:none" class="ml-5" onClick="" href="javascript:;" title="查看"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a style="text-decoration:none" class="ml-5" onClick="" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<!--包含头部文件-->
@include('bis.public.footer')
<script>
    var SCOPE = {

    };
</script>

