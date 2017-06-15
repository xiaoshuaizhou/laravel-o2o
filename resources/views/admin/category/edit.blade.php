<!--包含头部文件-->
@include('admin.public.head')
<body>
<div class="page-container">
	<form class="form form-horizontal form-o2o-add" id="form-o2o-add" method="post" action="{{url('admin/category/edit')}}">
		{{csrf_field()}}
		<input type="hidden" name="id" value="{{$category->id}}">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>生活服务分类名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$category->name}}" placeholder="" id="name" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
				<select name="parent_id" class="select">
					@if($category->parent_id == 0)
					<option value="0">一级分类</option>
					@else
						@foreach($categorys as $item)
					<option value="{{$item->id}} "@if($category->parent_id == $item->id) selected="selected" @endif">-{{$item->name}}-</option>
						@endforeach
					@endif
				</select>
				</span>
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button id="butt"  type="submit" class="btn btn-primary radius" ><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>

</div>
<!--包含头部文件-->
@include('admin.public.footer')
@include('errors.list')
