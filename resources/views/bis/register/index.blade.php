<!--包含头部文件-->
@include('bis.public.header')
<style>
	.list-group {
		margin-bottom: 20px;
	}
	.list {
		text-align:center;
		font-size: 25px;
		width: 350px;
		height: 40px;
		margin-bottom: 20px;
		color:#a94442;
		background-color:#f2dede;
	}
</style>
<div class="cl pd-5 bg-1 bk-gray mt-20"> <h1>商户入驻申请</h1></div>
<article class="page-container">
	<form class="form form-horizontal"  method="post" action="{!! url('bis/register/add') !!}">
	基本信息：
		{!! csrf_field() !!}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商户名称：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="name">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
			<div class="formControls col-xs-8 col-sm-2"> 
				<span class="select-box">
				<select name="city_id" class="select cityId">
					<option value="0">--请选择--</option>
					@foreach($citys as $city)
					<option value="{{$city->id}}">{{$city->name}}</option>
					@endforeach
				</select>
				</span>
			</div>
			<div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select name="se_city_id" class="select se_city_id">
					<option value="0">--请选择--</option>
				</select>
				</span> 
			</div>
		</div>
		
		<div class="row cl">
              <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
              <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
                <input id="file_upload_image" name="logo" type="hidden" multiple="true" value="">
              </div>
        </div>
        <div class="row cl">
              <label class="form-label col-xs-4 col-sm-2">营业执照：</label>
              <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload_other"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_img_other" src="" width="150" height="150">
                <input id="file_upload_image_other" name="licence_logo" type="hidden" multiple="true" value="">
              </div>
        </div>
        
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">商户介绍：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor1"  type="text/plain" name="description" style="width:80%;height:300px;"></script> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">银行账号:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="bank_info">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">开户行名称:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="bank_name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">开户行姓名:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="bank_user">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">法人:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="faren">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">法人电话:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="faren_tel">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>邮箱：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="email">
			</div>
		</div>
		总店信息：
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">电话:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="tel">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">联系人:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="contact">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
			<div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select name="category_id" class="select categoryId">
					<option value="0">--请选择--</option>
					@foreach($categorys as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
					@endforeach
				</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">所属子类：</label>
			<div class="formControls col-xs-8 col-sm-3 skin-minimal">
				<div class="check-box se_category_id">

				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">商户地址：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text " value="" placeholder="" id="address" name="address">
			</div>
			<a  class="btn btn-default radius ml-10 maptag"  id="maptag" ><font  color="black">标注</font></a>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">营业时间:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="open_time">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">门店简介：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor"  type="text/plain" name="content" style="width:80%;height:300px;"></script> 
			</div>
		</div>

		账号信息：
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">用户名:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="" name="username">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">密码:</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="password" class="input-text" value="" placeholder="" id="" name="password">
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 申请</button>	
			</div>
		</div>
	</form>
	<div class="row cl" style="margin-left: 225px">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
		@include('errors.list')
		</div>
	</div>
</article>

<!--包含尾部文件-->
@include('bis.public.footer')
<script type="text/javascript" src="/hui/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/hui/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/hui/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<!--分配编辑器-->
<script>
	var SCOPE={
	    'city_url' : '{{url('bis/api/getCityByParentId')}}',
		'category_url' : '{{url('bis/api/getCategoryByParentId')}}',
		'uploadify_swf' : '/uploadify/uploadify.swf',
		'img_url' : '{{url('bis/api/upload')}}',
		'map_url' : '{{url('bis/api/map')}}'
	};
</script>
<script>
$(function(){
	var ue = UE.getEditor('editor');
	var ue1 = UE.getEditor('editor1');
});
var url = SCOPE.map_url;

$('.maptag').click(function () {
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            'address':$("#address").val(),
            '_token' :'{{ csrf_token() }}'
        },
        success: function (data) {
            console.log(data);

            if(data.msg == 'success'){
				$("#maptag").css("background","green");
			}else{
                $("#maptag").css("background","red");
                alert('位置获取失败');
            }
        },
        error: function (data) {
            alert('执行错误,请稍后重试!');
        }
    });
})
</script>
</body>
</html>