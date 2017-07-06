<!--包含头部文件-->
@include('bis.public.header')
@inject('FeaturedPresenter', 'App\Presenter\Admin\FeaturedPresenter')

<body>
<nav class="breadcrumb"></nav>
<div class="page-container">
  <div class="text-c"> 
  <form method="get" action="">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>选择推荐类别：</label>
      <div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
        <select name="type" class="select">
          {!! $FeaturedPresenter->selectFeatureds($featureds) !!}

        </select>
        </span>
      </div>

    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont"></i> 搜索</button>
  </form>
  </div>
  
  <div class="mt-20">
    <table class="table table-border table-bordered table-bg table-hover table-sort">
      <thead>
        <tr class="text-c">
          <th width="40">ID</th>
          <th width="150">标题</th>
          <th width="100">地址</th>
          <th width="150">新增时间</th>
          <th width="30">发布状态</th>
          <th width="30">操作</th>
        </tr>
      </thead>
      <tbody>
        @foreach($datas as $data)
        <tr class="text-c">
          <td>{{$data->id}}</td>
          <td><a href="" target="_blank">{{$data->title}}</a></td>
          <td class="text-c">{{$data->url}}</td>
          <td>{{$data->created_at}}</td>
          <td class="td-status">
            <a href="{{url('admin/featured/status', ['id' => $data->id, 'status'=>$data->status])}}" title="点击修改状态">{{changeStatus($data->status)}}</a>
          </td>
          <td class="td-manage">
            <a style="text-decoration:none" class="ml-5" onClick="o2o_del('{{$data->id}}', '{{url('admin/featured/del',['id'=>$data->id])}}')" href="javascript:;" title="删除">
              <i class="Hui-iconfont">&#xe6e2;</i>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--包含头部文件-->
@include('bis.public.footer')
<script>
    function o2o_del(id,url){

        layer.confirm('确认要删除吗？',function(index){
            window.location.href=url;
        });
    }
</script>

