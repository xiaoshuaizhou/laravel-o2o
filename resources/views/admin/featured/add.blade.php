<!--包含头部文件-->
@include('admin.public.head')
<body>
<div class="cl pd-5 bg-1 bk-gray mt-20"> 添加推荐位信息</div>
<article class="page-container">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{{url('admin/featured/create')}}">
		<div class="row cl">
			{!! csrf_field() !!}
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>标题：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="title">
			</div>
		</div>
		
		<div class="row cl">
              <label class="form-label col-xs-4 col-sm-2">推荐图：</label>
              <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
                <input id="file_upload_image" name="image" type="hidden" multiple="true" value="">
              </div>
        </div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
			<div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select name="type" class="select">
					
					@foreach($featureds as $key=>$featured)
					<option value="{{$key}}">{{$featured}}</option>
					@endforeach
				</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">url：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="url">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">描述：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="description">
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加</button>	
			</div>
		</div>
	</form>
</article>
<script>
/**定义页面全局变量**/
var SCOPE = {
    'city_url' : "{{url('bis/api/getCityByParentId')}}",
    'category_url' : "{{url('bis/api/getCategoryByParentId')}}",
    'uploadify_swf' : '/uploadify/uploadify.swf',
    'img_url' : "{{url('bis/api/upload')}}",
};
</script>
<!--包含头部文件-->
@include('admin.public.footer')
<script type="text/javascript" src="/hui/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/hui/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/hui/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script>
    var SCOPE = {
        'city_url' : "{{url('bis/api/getCityByParentId')}}",
        'category_url' : "{{url('bis/api/getCategoryByParentId')}}",
        'uploadify_swf' : '/uploadify/uploadify.swf',
        'img_url' : "{{url('bis/api/upload')}}",
    };
</script>
<script>
    $(function(){
        var ue = UE.getEditor('editor');
    });
</script>
