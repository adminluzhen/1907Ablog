<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <script src="/static/bootstrap/jquery/2.1.1/jquery.min.js"></script>
    <script src="/static/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<h3>登陆</h3>
<hr>

<center>
    <b style="color: red"></b>
    <form class="form-horizontal" role="form" action="{{url('dologin')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">用户名：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="admin_name" id="firstname" placeholder="请输入用户名">
            </div>
        </div>
        
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">密码：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="admin_pwd" id="firstname" placeholder="请输入密码">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-default" value="登陆">
{{--                <button type="submit" >登陆</button>--}}
            </div>
        </div>
    </form>
</center>

</body>
</html>

