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
<form action="{{url('book/doadd')}}" method="post" enctype="multipart/form-data">
    @csrf
    图书名称:<input type="text" value="{{session('data')['book_name']}}" name="book_name"><b style="color: red">{{$errors->first('book_name')}}</b><br>
    图书作者:<input type="text" value="{{session('data')['book_man']}}" name="book_man"><b style="color: red">{{$errors->first('book_man')}}</b><br>
    图书价格:<input type="text" value="{{session('data')['book_price']}}" name="book_price"><b style="color: red">{{$errors->first('book_price')}}</b><br>
    图书封面:<input type="file" name="book_pic"><br>
    <button type="submit">添加</button>
</form>
</body>
</html>