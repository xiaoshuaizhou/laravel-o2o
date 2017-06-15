/**
 * Created by DELL on 2017/3/20.
 */
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
function o2o_del(url){

    layer.confirm('确认要删除吗？',function(index){
        window.location.href=url;
    });
}
/*排序相关*/
$(".listorder input").blur(function () {
    var id = $(this).attr('attr-id');
    var listorder = $(this).val();

    var postDate = {
        'id' : id ,
        'listorder' : listorder
    };
    var url = SCOPE.listorder_url;
    $.post(url , postDate , function (res) {
        //成功
        if (res.code == 1){
            location.href = res.data;
        }else{
            alert(res.msg);
        }
    } ,'json');
});
/*返回上级*/
$('#button').click(function () {
    location.href = history.go(-1);
});
/*异步获取二级城市*/
$('.cityId').change(function () {
    var city_id = $(this).val();
    var postData = {
        'id' : city_id
    };
    var url = SCOPE.city_url;
    $.post(url , postData , function (result) {
        //相关的业务逻辑
        if (result.status == 1){
            //将信息填充到html页面中
            var data = result.data;
            var City_html = '';
            $(data).each(function (i) {
                City_html += '<option name="" value="' + this.id + '">' + this.name + '</option>';
            });
            $('.se_city_id').html(City_html);
        }else if (result.status == 0){
            $('.se_city_id').html('');
        }
    });
});
/*异步获取二级分类*/
$('.categoryId').change(function () {
    var category_id = $(this).val();
    var postData = {
        'cid' : category_id
    };
    var url = SCOPE.category_url;
    $.post(url , postData , function (result) {
        //相关的业务逻辑
        if (result.status == 1){
            //将信息填充到html页面中
            var data = result.data;
             var Category_html = '';
            $(data).each(function (i) {
                Category_html += '<input name="se_category_id[]" id="checkbox-moban" value="'+ this.id +'" type="checkbox">' + this.name;
                Category_html += '<label for="checkbox-moban">&nbsp;</label>';
                $('.se_category_id').html(Category_html);
            });
        }else if (result.status == 0){
            $('.se_category_id').html('');
        }
    });
});
function selecttime(flag){
    if(flag==1){
        var endTime = $("#countTimeend").val();
        if(endTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',maxDate:endTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }else{
        var startTime = $("#countTimestart").val();
        if(startTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:startTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }
}


