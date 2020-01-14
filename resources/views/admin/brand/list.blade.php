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
</head>
<body>

<h3>品牌列表</h3>
<hr>
<h3>欢迎【<b>{{session('admin')['admin_name']}}</b>】登陆 <a href="{{url('logout')}}">退出登陆</a></h3>
<a href="{{url('admin/brand_showadd')}}">添加品牌</a>
<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>品牌名称</td>
            <td>品牌LOGO</td>
            <td>品牌网址</td>
            <td>品牌介绍</td>
            <td>操作</td>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $v)
            <tr>
                <td>{{$v->brand_id}}</td>
                <td>{{$v->brand_name}}</td>
                <td><img src="{{env('UPLOADS_URL')}}/{{$v->brand_logo}}" width="100"></td>
                <td>{{$v->brand_url}}</td>
                <td>{{$v->brand_desc}}</td>
                <td>
                    <a href="{{url('admin/brand_del/'.$v->brand_id)}}" class="btn btn-danger">删除</a>
                    <a href="{{url('admin/brand_edit/'.$v->brand_id)}}" class="btn btn-info">编辑</a>
                </td>
            </tr>
        @endforeach
    <tr>
        <td colspan="6"><center>{{$data->links()}}</center></td>
    </tr>
    </tbody>
</table>

</body>
<script>
    $(document).on('click','.pagination a',function () {
        var url = $(this).prop('href');
        $.ajax({
           type:'get',
           url:url,
           dataType:'text',
           success:function (res) {
               $('tbody').html(res);
           }
        });
        return false;
    });

</script>
</html>