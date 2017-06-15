<!--包含头部文件-->
@include('admin.public.head')
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
					<td class="td-status"><a href="" title="点击修改状态">@if($bis->status ==  0) 待审核 @elseif($bis->status == 1) 审核通过 @else 申请不符要求 @endif</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="pagination">{!! $biss->render() !!}</div>
<!--包含头部文件-->
@include('admin.public.footer')

