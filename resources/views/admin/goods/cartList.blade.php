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
<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>商品名称</td>
            <td>商品货号</td>
            <td>商品单价</td>
            <td>购买数量</td>
            <td>商品库存</td>
            <td>商品图片</td>
            <td>操作</td>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $v)
            <tr>
                <td>{{$v->cart_id}}</td>
                <td>{{$v->cart_name}}</td>
                <td>{{$v->cart_id}}</td>
                <td>{{$v->cart_id}}</td>
                <td>{{$v->cart_id}}</td>
                <td>{{$v->cart_id}}</td>
                <td>{{$v->cart_id}}</td>
                <td>操作</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>