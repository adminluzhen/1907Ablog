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
<h3>分类添加</h3>
<hr>

<form class="form-horizontal" role="form" action="{{url('cate/doadd')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="cate_name" id="firstname" placeholder="请输入名字">
            <b style="color: red;">{{$errors->first('brand_name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">父级分类</label>
        <div class="col-sm-10">
            <select name="parent_id" id="" class="form-control">
                <option value="0">-请选择父级分类-</option>
                @foreach($data as $v)
                <option value="{{$v->cate_id}}">{{'|'.str_repeat('—',$v->level)}}{{$v->cate_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-10">
            <input type="radio" name="is_show" checked value="1"> 是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="is_show" value="2"> 否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否导航栏显示</label>
        <div class="col-sm-10">
            <input type="radio" name="is_nav_show" value="1"> 是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="is_nav_show" checked value="2"> 否
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加品牌</button>
        </div>
    </div>
</form>
</body>
</html>

