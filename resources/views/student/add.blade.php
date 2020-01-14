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
<form action="{{url('student/doadd')}}" method="post">
    @csrf
    姓名:<input type="text" name="student_name"><br>
    性别:男<input type="radio" checked name="student_sex" value="1">
    女<input type="radio" name="student_sex" value="2"><br>
    班级:<select name="class" id="">
        <option value="1">1班</option>
        <option value="2">2班</option>
    </select><br>
    <button type="submit">添加</button>
</form>
</body>
</html>