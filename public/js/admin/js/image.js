/**
 * Created by DELL on 2017/3/21.
 */
/*异步上传api接口*/
$(function() {
    $("#file_upload").uploadify({
        'swf'             : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.img_url,
        'buttonText'      :'文件上传',
        'fileTypeDesc'    : 'Image file',
        'fileObjName'     : 'file' ,
        'folder': 'haha',//服务端的上传目录
        'fileTypeExts'    : '*.jpg;*.png;*.gif',
        'onUploadSuccess' : function(file, data, response) {
            // console.log(data); //将服务器返回的json数据转换成对象
            // console.log(response);
            if (response){
                var obj = JSON.parse(data);
                $("#upload_org_code_img").attr("src" , obj.data);
                $("#file_upload_image").attr("value" , obj.data);
                $("#upload_org_code_img").show();
            }
        }
    });
});
$(function () {
    $("#file_upload_other").uploadify({
        'swf'             : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.img_url,
        'buttonText'      :'文件上传',
        'fileTypeDesc'    : 'Image file',
        'folder': 'haha',//服务端的上传目录
        'fileObjName'     : 'file' ,
        'fileTypeExts'    : '*.jpg;*.png;*.gif',
        'onUploadSuccess' : function(file, data, response) {
            if (response){
                var obj = JSON.parse(data);
                $("#upload_org_code_img_other").attr("src" , obj.data);
                $("#file_upload_image_other").attr("value" , obj.data);
                $("#upload_org_code_img_other").show();
            }
        }
    });
});
