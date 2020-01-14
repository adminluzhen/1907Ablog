<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form>
    <input type="text" name="book_name">
    <button type="submit">搜索</button>
</form>
<table border="">
    <tr>
        <td>ID</td>
        <td>名称</td>
        <td>作者</td>
        <td>价格</td>
        <td>封面</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->book_id}}</td>
        <td>{{$v->book_name}}</td>
        <td>{{$v->book_man}}</td>
        <td>{{$v->book_price}}</td>
        <td><img src="{{env('UPLOADS_URL')}}/{{$v->book_pic}}" width="100"></td>
        <td><a href="{{url('book/del/'.$v->book_id)}}">删除</a></td>
    </tr>
        @endforeach
</table>
{{$data->appends($query)->links()}}
</body>
</html>