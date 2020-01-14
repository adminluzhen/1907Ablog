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
</html>