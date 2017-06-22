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
<article class="page-container">
    <form class="form form-horizontal"  ">
        基本信息：
        {!! csrf_field() !!}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商户名称：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$bis->name}}" placeholder="" id="" name="name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
            <div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select name="city_id" class="select cityId">
					<option value="0">--请选择--</option>
                    @foreach($citys as $city)
                        <option value="{{$city->id}}" @if($bis->city_id == $city->id) selected="selected" @endif>{{$city->name}}</option>
                    @endforeach
				</select>
				</span>
            </div>
            <div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select name="se_city_id" class="select se_city_id">
					<option value="0">{{getSeCityName($bis->city_path)}}</option>
				</select>
				</span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img  id="upload_org_code_img" src="{{$bis->logo}}" width="150" height="150">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">营业执照：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img  id="upload_org_code_img_other" src="{{$bis->licence_logo}}" width="150" height="150">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">商户介绍：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor1"  type="text/plain" name="description" style="width:80%;height:300px;">{{$bis->description}}</script>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">银行账号:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->bank_info}}" placeholder="" id="" name="bank_info">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">开户行名称:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$bis->bank_name}}" placeholder="" id="" name="bank_name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">开户行姓名:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$bis->bank_user}}" placeholder="" id="" name="bank_user">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">法人:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$bis->faren}}" placeholder="" id="" name="faren">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">法人电话:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$bis->faren_tel}}" placeholder="" id="" name="faren_tel">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>邮箱：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$bis->email}}" placeholder="" id="" name="email">
            </div>
        </div>
        总店信息：
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">电话:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->tel}}" placeholder="" id="" name="tel">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">联系人:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->contact}}" placeholder="" id="" name="contact">
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
            <label class="form-label col-xs-4 col-sm-2">商户地址：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->api_address}}" placeholder="" id="" name="address">
            </div>
            <a  class="btn btn-default radius ml-10 maptag">标注</a>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">营业时间:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$location->open_time}}" placeholder="" id="" name="open_time">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">门店简介：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor"  type="text/plain" name="content" style="width:80%;height:300px;">{{$location->content}}</script>
            </div>
        </div>

        账号信息：
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">用户名:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="{{$account->username}}" placeholder="" id="" name="username">
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
    };
</script>
<script>
    $(function(){
        var ue = UE.getEditor('editor');
        var ue1 = UE.getEditor('editor1');
    });
</script>
</body>
</html>