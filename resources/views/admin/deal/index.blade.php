<!--包含头部文件-->
@include('admin.public.head')
@inject('DealPresenter', 'App\Presenter\Admin\DealPresenter')

<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 团购商品列表 </nav>
<div class="page-container">
<div class="cl pd-5 bg-1 bk-gray mt-20">
	<form action="{{url('admin/deal/index')}}" method="post">
		{!! csrf_field() !!}
	<div class="text-c">
		商家名称：<input style="width:120px;" class="input-text" type="text" value="" name="shangjianame">
		 <span class="select-box inline">
			<select name="category_id" class="select">
				<option value="0">全部分类</option>
				{!! $DealPresenter->selectPersenter($categorys) !!}
			</select>
		</span>
		<span class="select-box inline">
			<select name="city_id" class="select">
				<option value="0">全部城市</option>
				{!! $DealPresenter->selectCity($citys) !!}
			</select>
		</span> 日期范围：
		<input type="text" name="start_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="" style="width:120px;" >
			-
		<input type="text" name="end_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value=""  style="width:120px;">
		<input type="text" name="name" id="" placeholder=" 商品名称" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索
		</button>
	</div>
	</form>
</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="20">ID</th>
					<th width="50">商品名称</th>
					<th width="50">商家名称</th>
					<th width="40">栏目分类</th>
					<th width="40">城市</th>
					<th width="40">购买件数</th>
					<th width="80">开始结束时间</th>
					<th width="80">创建时间</th>
					<th width="60">状态</th>
					<th width="40">操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($deals as $deal)
				<tr class="text-c">
					<td>{{$deal->id}}</td>
					<td>{{$deal->name}}</td>
					<td>{{getBisNameByBisId($deal->bis_id)}}</td>
					<td>{{getCategoryNameBySeCategoryId($deal->category_id)}}</td>
					<td>{{getSeCityName($deal->city_id)}}</td>
					<td>{{$deal->buy_count}}</td>
					<td>{{$deal->start_time}}-{{$deal->end_time}}</td>
					<td>{{$deal->created_at}}</td>
					<td>{{changeStatus($deal->status)}}</td>
					<td class="td-manage">
						<a style="text-decoration:none" class="ml-5" onClick="o2o_edit('编辑','{{url('admin/deal/edit', ['id' => $deal->id] )}}','',300)" href="javascript:;" title="查看"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a style="text-decoration:none" class="ml-5" onClick="o2o_s_del('{{$deal->id}}','{{url('admin/deal/del', ['id' => $deal->id])}}')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="pagination">{!! $deals->render() !!}</div>

<!--包含头部文件-->
@include('admin.public.footer')
<script src="/hui/lib/My97DatePicker/WdatePicker.js"></script>
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
