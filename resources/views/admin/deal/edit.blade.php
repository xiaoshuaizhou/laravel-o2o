<!--包含头部文件-->
@include('bis.public.header')
<div class="cl pd-5 bg-1 bk-gray mt-20"> 编辑团购商品信息</div>
<article class="page-container">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{{url('admin/deal/edit')}}">
		{!! csrf_field() !!}
		基本信息：
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>团购名称：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="{{$deal->name}}" placeholder="" id="" name="name">
			</div>
		</div>
		<input type="hidden" value="{{$deal->id}}" name="id">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<span class="select-box">
				<select name="city_id" class="select cityId">
					<option value="0">--请选择--</option>
					@foreach($citys as $city)
						<option value="{{$city->id}}" @if($deal->city_id == $city->id) selected="selected"  @endif>{{$city->name}}</option>
					@endforeach
				</select>
				</span>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
			<div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select name="category_id" class="select categoryId">
					<option value="0">--请选择--</option>
					@foreach($categorys as $category)
						<option value="{{$category->id}}" @if($deal->category_id == $category->id) selected="selected"  @endif>{{$category->name}}</option>
					@endforeach
				</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-9 col-sm-2">支持门店：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="check-box">
						<input name="location_ids[]" type="checkbox" id="checkbox" checked="checked" value="{{$deal->bis_id}}"/>{{$location->name}}
				</div>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">缩略图：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<img  id="upload_org_code_img" src="{{$deal->image}}" width="150" height="150">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">团购开始时间：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" name="start_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="{{$deal->start_time}}"  >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">团购结束时间:</label>
			<div class="formControls col-xs-8 col-sm-3">

				<input type="text" name="end_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="{{$deal->end_time}}"  >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">库存数:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="{{$deal->total_count}}" placeholder="" id="" name="total_count">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">原价:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="{{$deal->origin_price}}" placeholder="" id="" name="origin_price">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">团购价:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="{{$deal->current_price}}" placeholder="" id="" name="current_price">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">消费券生效时间：</label>
			<div class="formControls col-xs-8 col-sm-3">

				<input type="text" name="coupons_begin_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="{{$deal->coupons_begin_time}}"  >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">消费券结束时间:</label>
			<div class="formControls col-xs-8 col-sm-3">

				<input type="text" name="coupons_end_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="{{$deal->coupons_end_time}}"  >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">团购描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<script id="editor"  type="text/plain" name="description" style="width:80%;height:300px;">{{html_entity_decode($deal->description)}}</script>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">购买须知：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<script id="editor2"  type="text/plain" name="notes" style="width:80%;height:300px;">{{html_entity_decode($deal->notes)}}</script>
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 编辑</button>
			</div>
		</div>
	</form>
</article>
<script>
    /**定义页面全局变量**/
    var SCOPE = {
        'city_url' : '{{url('bis/api/getCityByParentId')}}',
        'category_url' : '{{url('bis/api/getCategoryByParentId')}}',
        'uploadify_swf' : '/uploadify/uploadify.swf',
        'img_url' : "{{url('bis/api/upload')}}",
    };

</script>
<!--包含头部文件-->
@include('bis.public.footer')
<script type="text/javascript" src="/hui/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/hui/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/hui/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script src="/hui/lib/My97DatePicker/WdatePicker.js"></script>
<script>
    $(function(){
        var ue = UE.getEditor('editor');
        var ue = UE.getEditor('editor2');
    });
</script>
</body>
</html>