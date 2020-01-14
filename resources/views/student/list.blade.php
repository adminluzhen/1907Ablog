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
<form>
    <input type="text" value="{{$query['student_name']??''}}" name="student_name"><button id="but">搜索</button>
</form>
<div id="test_div">
    <table border="1">
        <tr>
            <td>ID</td>
            <td>姓名</td>
            <td>性别</td>
            <td>班级</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
            <tr>
                <td>{{$v->student_id}}</td>
                <td>{{$v->student_name}}</td>
                <td>@if($v->student_sex == 1) 男 @else 女 @endif</td>
                <td>@if($v->class == 1) 1班 @else 2班 @endif</td>
                <td>
                    <a href="{{url('student/del/'.$v->student_id)}}">删除</a>
                    <a href="{{url('student/showup/'.$v->student_id)}}">编辑</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$data->appends($query)->links()}}
</div>


</body>
</html>
<script>
    $('#but').click(function () {
        var student_name = $('[name=student_name]').val();
        $.ajax({
            type:'get',
            url: "{{url('student/list')}}",
            data:{student_name:student_name},
            dataType: 'text',
            success:function (res) {
                $('#test_div').html(res);
            }
        });
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
        });
        return false;
    });

</script>