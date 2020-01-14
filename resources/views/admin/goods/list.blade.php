<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <script src="/static/jquery.js"></script>
    <script src="/static/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<h3>商品列表</h3>
<hr>
<h3>欢迎【{{session('admin')['admin_name']}}】登陆 &nbsp;&nbsp;&nbsp;<a href="{{url('logout')}}">退出登陆</a></h3>
<a href="{{url('goods/showadd')}}">添加商品</a>

<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>商品名称</td>
            <td>商品货号</td>
            <td>品牌</td>
            <td>分类</td>
            <td>商品价格</td>
            <td>商品图片</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $v)
        <tr>
                <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->goods_sn}}</td>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->cate_name}}</td>
                <td>{{$v->goods_price}}</td>
                <td><img src="{{env('UPLOADS_URL')}}/{{$v->goods_img}}" width="100" alt=""></td>
                <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
                <td>
                    <a href="{{url('goods/info')}}/{{$v->goods_id}}" class="btn btn-info">详情</a>
{{--                    <a href="" class="btn btn-danger">删除</a>--}}
                </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="11"><center>{{$data->links()}}</center></td>
        </tr>
    </tbody>
</table>

</body>
<script>
    $('.del').click(function () {
        var url = $(this).prop('href');
        var _this = $(this);
        $.ajax({
            type:'get',
            url:url,
            dataType:'json',
            success:function (json_info) {
                if(json_info.status == 200){
                    _this.parent().parent().remove();
                    window.location.href = "{{url('goods/list')}}"
                }else{
                    alert(json_info.msg)
                }
            }
        })
        return false;
    });


    $(document).on('click','.pagination a',function () {
        var url = $(this).prop('href');
        $.ajax({
            type:'get',
            url:url,
            dataType:'text',
            success:function (res) {
                $('tbody').html(res);
            }
        })
        return false;
    });
</script>
</html>