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
    <script src="/static/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<h3>商品添加</h3>
<hr>
<form class="form-horizontal" role="form" action="{{url('goods/doadd')}}" method="post" enctype="multipart/form-data">
    @csrf

    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#goods_info" data-toggle="tab">商品信息</a></li>
        <li><a href="#goods_imgs" data-toggle="tab">商品相册</a></li>
        <li><a href="#goods_desc" data-toggle="tab">商品介绍</a></li>

    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="goods_info">
            <p>
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">商品名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="goods_name" id="firstname" placeholder="请输入名字">
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">货号</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="goods_sn" id="firstname" placeholder="请输入货号">
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">品牌</label>
                <div class="col-sm-10">
                    <select name="brand_id" id="" class="form-control">
                        <option value="">请选择品牌</option>
                        @foreach($brand as $v)
                            <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">分类</label>
                <div class="col-sm-10">
                    <select name="cate_id" id="" class="form-control">
                        <option value="">请选择分类</option>
                        @foreach($cate as $v)
                            <option value="{{$v->cate_id}}">{{'|'.str_repeat('—',$v->level)}}{{$v->cate_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">商品价格</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="goods_price" id="firstname" placeholder="请输入价格">
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">商品库存</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="goods_number" id="firstname" placeholder="请输入库存">
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">商品略缩图</label>
                <div class="col-sm-10">
                    <input type="file" name="goods_img" id="inputfile">
                </div>
            </div>
            </p>
        </div>
        <div class="tab-pane fade" id="goods_imgs">
            <p>
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">商品相册</label>
                <div class="col-sm-10">
                    <input type="file" multiple="multiple" name="goods_imgs[]" id="inputfile">
                </div>
            </div>
            </p>
        </div>

        <div class="tab-pane fade" id="goods_desc">
            <p>
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">商品介绍</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="goods_desc" rows="3"></textarea>
                </div>
            </div>
            </p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加商品</button>
        </div>
    </div>
</form>
</body>
</html>

