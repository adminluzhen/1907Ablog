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