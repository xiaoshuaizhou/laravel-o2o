<!--包含头部文件-->
@include('bis.public.header')
<div class="cl pd-5 bg-1 bk-gray mt-20"> 添加分店信息</div>
<article class="page-container">
    <form class="form form-horizontal" id="form-article-add" method="post" action="{{url('/bis/location/edit')}}">
        基本信息：
        {!! csrf_field() !!}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分店名称：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->name}}" placeholder="" id="" name="name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
            <div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select name="city_id" class="select cityId">
					<option value="0">--请选择--</option>
                    @foreach($citys as $city)
                        <option value="{{$city->id}}" @if($location->city_id == $city->id) selected="selected" @endif>{{$city->name}}</option>
                    @endforeach
				</select>
				</span>
            </div>
            <div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select name="se_city_id" class="select se_city_id">
					<option value="0">{{getSeCityName($location->city_path)}}</option>
				</select>
				</span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img  id="upload_org_code_img" src="{{$location->logo}}" width="150" height="150">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">门店介绍：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor"  type="text/plain" name="content" style="width:80%;height:300px;">{{$location->content}}</script>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
            <div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select name="category_id" class="select categoryId">
					<option value="0">--请选择--</option>
                    @foreach($categorys as $category)
                        <option value="{{$category->id}}" @if($location->category_id == $category->id) selected="selected" @endif>{{$category->name}}</option>
                    @endforeach
				</select>
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">所属子类：</label>
            <div class="formControls col-xs-8 col-sm-3 skin-minimal">
                <div class="check-box se_category_id">
                    @if(getCategoryByCategoryPath($location->category_path))
                    <input type="checkbox" checked="checked" value="">{{getCategoryNameBySeCategoryId($location->category_path)}}
                    @endif
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">地址：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->api_address}}" placeholder="" id="" name="address">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">电话:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->tel}}" placeholder="" id="" name="tel">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">银行账号:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->bank_info}}" placeholder="" id="" name="bank_info">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">联系人:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->contact}}" placeholder="" id="" name="contact">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">营业时间:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->open_time}}" placeholder="" id="" name="open_time">
            </div>
        </div>


    </form>
</article>
@include('bis.public.footer')


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
</body>
</html>