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
<form action="{{url('user/doupdate/'.$data->user_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    姓名:<input type="text" value="{{$data->user_name}}" name="user_name"><br>
    工号:<input type="text" value="{{$data->user_num}}" name="user_num"><br>
    部门:<select name="unit" id="">
        <option @if($data->unit == '人事部') selected @endif value="人事部">人事部</option>
        <option @if($data->unit == '技术部') selected @endif value="技术部">技术部</option>
        <option @if($data->unit == '财务部') selected @endif value="财务部">财务部</option>
    </select><br>
    头像:<img src="{{env('UPLOADS_URL')}}/{{$data->user_pic}}" width="100"><input type="file" name="user_pic"><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit">修改</button>
</form>
</body>
</html>