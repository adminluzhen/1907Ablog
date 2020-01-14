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
    <input type="text" value="{{$query['user_name']??''}}" name="user_name" placeholder="员工姓名"><button>搜索</button>
</form>
<table border="1">
    <tr>
        <td>ID</td>
        <td>姓名</td>
        <td>工号</td>
        <td>职位</td>
        <td>头像</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->user_id}}</td>
        <td>{{$v->user_name}}</td>
        <td>{{$v->user_num}}</td>
        <td>{{$v->unit}}</td>
        <td><img src="{{env('UPLOADS_URL')}}/{{$v->user_pic}}" width="100" alt=""></td>
        <td>
            <a href="{{url('user/del/'.$v->user_id)}}">删除</a>
            <a href="{{url('user/update/'.$v->user_id)}}">编辑</a>
        </td>
    </tr>
        @endforeach
</table>
{{$data->appends($query)->links()}}
</body>
</html>