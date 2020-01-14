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
<form action="{{url('text/doadd')}}" id="myform" method="post" enctype="multipart/form-data">
    @csrf
    <table border="1">
        <tr>
            <td>文章标题</td>
            <td><input type="text" name="text_title"><span id="span_title">*</span></td>
        </tr>
        <tr>
            <td>文章分类</td>
            <td>
                <select name="text_type_id" id="">
                    <option value="">-请选择分类-</option>
                    @foreach($res as $v)
                        <option value="{{$v->text_type_id}}">{{$v->text_type_name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>文章重要性</td>
            <td>
                <input type="radio" checked name="text_imp" value="1">普通
                <input type="radio" name="text_imp" value="1">置顶
            </td>
        </tr>
        <tr>
            <td>是否显示</td>
            <td>
                <input type="radio" checked name="is_show" value="1">显示
                <input type="radio" name="is_show" value="1">不显示
            </td>
        </tr>
        <tr>
            <td>文章作者</td>
            <td><input type="text" name="text_man"></td>
        </tr>
        <tr>
            <td>作者email</td>
            <td><input type="text" name="man_email"></td>
        </tr>
        <tr>
            <td>关键字</td>
            <td><input type="text" name="keyword"></td>
        </tr>
        <tr>
            <td>网页描述</td>
            <td><textarea name="web_intro" cols="30" rows="10"></textarea></td>
        </tr>
        <tr>
            <td>网页图片</td>
            <td><input type="file" name="text_pic"></td>
        </tr>
        <tr>
            <td><button type="submit">添加</button></td>
            <td></td>
        </tr>
    </table>
</form>
</body>
<script>
    var flag = 0;
    $('[name=text_title]').focus(function () {
        $('#span_title').text('*');
    });
    $('[name=text_title]').blur(function () {
        var title_val = $('[name=text_title]').val();
        var _token = $('[name=_token]').val();

        if(title_val == ''){
            $('#span_title').text('标题不能为空');
            return false;
        }
        $.ajax({
            type:'post',
            data:{title:title_val,_token:_token},
            url:"{{url('text/checkdoadd')}}",
            async: false,
            dataType:'json',
            success:function (json_info) {
                if(json_info.status == 1){
                    $('#span_title').text(json_info.msg);
                }
            }
        })

    });

    $('[type=submit]').click(function () {
        var title_val = $('[name=text_title]').val();
        var _token = $('[name=_token]').val();
        if(title_val == ''){
            $('#span_title').text('标题不能为空');
            return false;
        }else{
            $.ajax({
                type:'post',
                data:{title:title_val,_token:_token},
                url:"{{url('text/checkdoadd')}}",
                async: false,
                dataType:'json',
                success:function (json_info) {
                    if(json_info.status == 1){
                        $('#span_title').text(json_info.msg);
                        flag = 1;
                        // return false;
                    }else{ //如果php页面只返回状态码 1 的话else下面的代码是不会执行的
                        flag = 0;
                        // return true;
                    }
                }
            })
            if(flag == 1){
                return false;
            }else if(flag == 0){
                return true;
            }
        }

        var type_id = $('[name=text_type_id]').val();
        if(type_id == ''){
            alert('分类必选');
            return false;
        }
    });



</script>
</html>
