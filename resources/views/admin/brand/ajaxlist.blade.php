@foreach($data as $v)
    <tr>
        <td>{{$v->brand_id}}</td>
        <td>{{$v->brand_name}}</td>
        <td><img src="{{env('UPLOADS_URL')}}/{{$v->brand_logo}}" width="100"></td>
        <td>{{$v->brand_url}}</td>
        <td>{{$v->brand_desc}}</td>
        <td>
            <a href="{{url('admin/brand_del/'.$v->brand_id)}}" class="btn btn-danger">删除</a>
            <a href="{{url('admin/brand_edit/'.$v->brand_id)}}" class="btn btn-info">编辑</a>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="6"><center>{{$data->links()}}</center></td>
</tr>