<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/static/jquery.js"></script>
</head>
<body>
<h3>欢迎【<b>{{session('admin')['admin_name']}}</b>】登陆 <a href="{{url('logout')}}">退出登陆</a></h3>

<form>
    <input type="text" name="text_title">
    <select name="text_type_id" id="">
        <option value="">-请选择分类-</option>
        @foreach($res as $v)
            <option value="{{$v->text_type_id}}">{{$v->text_type_name}}</option>
        @endforeach
    </select>
    <button name="but">搜索</button>
</form>
<div id="test_div">
<table border="1">
    <tr>
        <td>ID</td>
        <td>文章标题</td>
        <td>文章分类</td>
        <td>文章重要性</td>
        <td>是否显示</td>
        <td>文章作者</td>
        <td>图片</td>
        <td>操作</td>
    </tr>

    @foreach($data as $v)
    <tr>
        <td>{{$v->text_id}}</td>
        <td>{{$v->text_title}}</td>
        <td>{{$v->text_type_name}}</td>
        <td>@if($v->text_imp == 1) 普通 @else 置顶 @endif</td>
        <td>@if($v->is_show == 1) √ @else × @endif</td>
        <td>{{$v->text_man}}</td>
        <td><img src="{{env('UPLOADS_URL')}}/{{$v->text_pic}}" width="100" alt=""></td>
        <td>
            <a name="del" href="{{url('text/del/'.$v->text_id)}}">删除</a>
            <a href="{{url('text/showup')}}">编辑</a>
        </td>
    </tr>
    @endforeach
</table>
{{$data->appends($query)->links()}}
</div>
</body>
</html>
<script>
    $('[name=but]').click(function () {
        var title_val = $('[name=text_title]').val();
        var type_id = $('[name=text_type_id]').val();

        $.ajax({
            type:'get',
            url:"{{url('text/list')}}",
            data:{title:title_val,type_id:type_id},
            dataType:'text',
            success:function (res) {
                $('#test_div').html(res);
            }
        })
        return false;
    });
    $(document).on('click','.pagination a',function () {

        var url = $(this).prop('href');

        $.ajax({
            type:'get',
            url:url,
            dataType:'text',
            success:function (res) {
                $('#test_div').html(res);
            }
        })
        return false;
    });
    $('[name=del]').click(function () {
        var text_id = $(this).attr('text_id');
        var url = $(this).prop('href');
        var _this = $(this);

        $.ajax({
            type:'get',
            data:{text_id:text_id},
            url:url,
            dataType:'json',
            success:function (json_info) {
                if(json_info.status == 200){
                    _this.parent().parent().remove();
                }else{
                    alert(json_info.msg)
                }
            }
        })
        return false;
    });
</script>