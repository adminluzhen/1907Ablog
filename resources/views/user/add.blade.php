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
<form action="{{url('user/doadd')}}" method="post" enctype="multipart/form-data">
    @csrf
    姓名:<input type="text" name="user_name"><br>
    工号:<input type="text" name="user_num"><br>
    部门:<select name="unit" id="">
        <option value="人事部">人事部</option>
        <option value="技术部">技术部</option>
        <option value="财务部">财务部</option>
    </select><br>
    头像:<input type="file" name="user_pic"><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit">添加</button>
</form>
</body>
</html>