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

<h3>分类列表</h3>
<hr>
<a href="{{url('cate/showadd')}}">添加分类</a>
<table class="table table-striped">
    <thead>
    <tr>
        <td>ID</td>
        <td>分类名称</td>
        <td>是否显示</td>
        <td>是否导航栏显示</td>
        <td>操作</td>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $v)
        <tr>
            <td>{{$v->cate_id}}</td>
            <td>{{'|'.str_repeat('—',$v->level)}}{{$v->cate_name}}</td>
            <td>@if($v->is_show == 1) √ @else × @endif</td>
            <td>@if($v->is_show == 1) × @else √ @endif</td>
            <td>
                <a href="{{url('cate/brand_del/'.$v->cate_id)}}" class="btn btn-danger">删除</a>
                <a href="{{url('cate/brand_edit/'.$v->cate_id)}}" class="btn btn-info">编辑</a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

</body>
</html>