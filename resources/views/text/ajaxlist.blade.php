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
                <a href="">编辑</a>
            </td>
        </tr>
    @endforeach
</table>
{{$data->appends($query)->links()}}