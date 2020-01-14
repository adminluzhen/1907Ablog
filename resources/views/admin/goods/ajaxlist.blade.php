@foreach($data as $v)
    <tr>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->goods_sn}}</td>
        <td>{{$v->brand_name}}</td>
        <td>{{$v->cate_name}}</td>
        <td>{{$v->goods_price}}</td>

        <td><img src="{{env('UPLOADS_URL')}}/{{$v->goods_img}}" width="100" alt=""></td>
        {{--            <td>@if($v->goods_imgs)--}}
        {{--                    @foreach($v->goods_imgs as $vv)--}}
        {{--                        <img src="{{env('UPLOADS_URL')}}/{{$vv}}" width="50" height="50" alt="">--}}
        {{--                    @endforeach--}}
        {{--                @endif--}}
        {{--            </td>--}}
        <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
        <td>
            <a href="{{url('goods/info')}}/{{$v->goods_id}}" class="btn btn-info">详情</a>
            {{--                    <a href="" class="btn btn-danger">删除</a>--}}
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="11"><center>{{$data->links()}}</center></td>
</tr>