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
</head>
<body>
<h3>商品详情</h3>
当前访问量：{{$num}}
<hr/>
<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>商品名称</td>
            <td>商品货号</td>
            <td>品牌</td>
            <td>分类</td>
            <td>商品价格</td>
            <td>商品库存</td>
            <td>商品介绍</td>
            <td>商品图片</td>
            <td>商品相册</td>
        </tr>
    </thead>
    <tbody>

            <tr>
                <td>{{$goods_info->goods_id}}</td>
                <td>{{$goods_info->goods_name}}</td>
                <td>{{$goods_info->goods_sn}}</td>
                <td>{{$goods_info->brand_name}}</td>
                <td>{{$goods_info->cate_name}}</td>
                <td>{{$goods_info->goods_price}}</td>
                <td>{{$goods_info->goods_number}}</td>
                <td width="25%">{{$goods_info->goods_desc}}</td>
                <td><img src="{{env('UPLOADS_URL')}}/{{$goods_info->goods_img}}" width="100" alt=""></td>
                            <td>@if($goods_info->goods_imgs)
                                    @foreach($goods_info->goods_imgs as $v)
                                        <img src="{{env('UPLOADS_URL')}}/{{$v}}" width="50" height="50" alt="">
                                    @endforeach
                                @endif
                            </td>
            </tr>
            <tr>
                <td colspan="10">
                    <center>
                        <a goods_id="{{$goods_info->goods_id}}" href="javascript:;" id="cart" class="btn btn-info">加入购物车</a>
                    </center>
                </td>

            </tr>
    </tbody>
</table>
</body>
<script>

    $('#cart').click(function(){
        var goods_id = $(this).attr('goods_id');

        $.ajax({
            type:'get',
            url:"{{url('goods/cart')}}/"+goods_id,
            dataType:'json',
            success:function(json_info) {
                if(json_info.status == 200){
                    // alert(json_info.msg);
                    var res = window.confirm('添加成功是否去结算？');
                    if (res){
                        window.location.href="{{url('goods/cartList')}}";
                    }
                }
                if(json_info.status == 1){
                    alert(json_info.msg);
                }
                if(json_info.status == 2){
                    alert(json_info.msg);
                }
            }
        })
        return false;
    });
</script>
</html>