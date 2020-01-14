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
<form class="form-horizontal" role="form" action="{{url('admin/brand_update/'.$info->brand_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$info->brand_name}}" name="brand_name" id="firstname" placeholder="请输入名字">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌LOGO</label>
        <div class="col-sm-10">
            <img src="{{env('UPLOADS_URL')}}/{{$info->brand_logo}}" width="100">
            <input type="file" name="brand_logo" id="inputfile">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$info->brand_url}}" name="brand_url" id="firstname" placeholder="请输入网址">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <label for="name">品牌介绍</label>
            <textarea class="form-control" name="brand_desc" rows="3">{{$info->brand_desc}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">完成</button>
        </div>
    </div>
</form>
</body>
</html>

