<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Goods;
use App\Mail\SendCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    public function send_email()
    {
        Mail::to('2443701616@qq.com')->send(new SendCode());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Goods::select('goods.*','brand.brand_name','category.cate_name')
            ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
            ->leftjoin('category','goods.cate_id','=','category.cate_id')
            ->paginate(3);
        foreach ($data as $v){
            $v->goods_imgs = explode('|',$v->goods_imgs);
        }
//        dd($data);
        if(\request()->ajax()){
            return view('admin/goods/ajaxlist',['data'=>$data]);
        }
        return view('admin/goods/list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = DB::table('brand')->get();
        $cate = DB::table('category')->get();
        $cate = cateTree($cate);
        return view('admin/goods/add',['brand'=>$brand,'cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');
//        dd($post);
        if($request->hasFile('goods_img')){
            $post['goods_img'] = $this->upload('goods_img');
        }
        if($post['goods_imgs']){
            $post['goods_imgs'] = moreuploads('goods_imgs');
            $post['goods_imgs'] = implode('|',$post['goods_imgs']);
        }
        $post['add_time'] = time();
        $post['update_time'] = time();
//        dd($post);
        $res = Goods::insert($post);
//        dd($res);
        if($res){
            return redirect('goods/list');
        }
    }

    public function upload($filename){
        if(\request()->file($filename)->isValid()){
            $photo = \request()->file($filename);
            $res = $photo->store('uploads/goods');
            return $res;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function goodsinfo($id)
    {   
        //访问量
        $num = Redis::setnx('num_'.$id,1);
        if(!$num){
            Redis::incr('num_'.$id);
        }
        $num = Redis::get('num_'.$id);
        $goods_info = Goods::select('goods.*','brand.brand_name','category.cate_name')
            ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
            ->leftjoin('category','goods.cate_id','=','category.cate_id')
            ->where('goods_id',$id)
            ->first();
        $goods_info['goods_imgs'] = explode('|',$goods_info['goods_imgs']);
//        dd($goods_info);
        return view('admin/goods/info',['goods_info'=>$goods_info,'num'=>$num]);
    }

    /**
     * 加入购物车
     */
    public function cart($goods_id){
        if(!session('admin')){
            return $this->cookieCart($goods_id);
        }else{
            $this->addCrat($goods_id);
        }
    }

    public function cookieCart($goods_id)
    {
        $cart_info = Cookie::get('cart');

        $goods_info = Goods::where('goods_id',$goods_id)->first();
        if($goods_info['goods_number']<1){
            echo json_encode(['status'=>2,'msg'=>'商品库存不足']);die;
        }
        $data = json_decode(Cookie::get('cart'),true);
//        dd($data);
        if(!empty($data) && array_key_exists('cart_'.$goods_id,$data)){
            $data['cart_'.$goods_id]['buy_number'] += 1;
//            dd($data);
            return response()->json(['status'=>200,'msg'=>'添加购物车成功'])->cookie('cart',json_encode($data),30);
        }
        $data['cart_'.$goods_id] = [
            'goods_id'=>$goods_id,
            'buy_number'=>1,
            'goods_price'=>$goods_info->goods_price,
            'add_time'=>time()
        ];

        $data = json_encode($data);

        return response()->json(['status'=>200,'msg'=>'添加购物车成功'])->cookie('cart',$data,30);

    }

    /**
     * 如果用户登陆就向数据库添加购物车信息
     * @param $goods_id
     */
    public function addCrat($goods_id)
    {
        //获取用户的id
        $admin_id = $this->getAdminId();
        //获取要购买商品的信息
        $goods_info = Goods::where('goods_id',$goods_id)->first();
        if($goods_info['goods_number']<1){
            echo json_encode(['status'=>2,'msg'=>'商品库存不足']);die;
        }
        $repeat = Cart::where(['admin_id'=>$admin_id,'goods_id'=>$goods_info->goods_id])->first();
//        dd($repeat);
        if($repeat){
            $result = Cart::where(['admin_id'=>$admin_id,'goods_id'=>$goods_info->goods_id])->increment('buy_number');
            if ($result){
                echo json_encode(['status'=>200,'msg'=>'添加购物车成功']);die;
            }
        }
        $data = [
            'goods_id'=>$goods_id,
            'admin_id'=>$admin_id,
            'buy_number'=>1,
            'goods_price'=>$goods_info->goods_price,
            'add_time'=>time()
        ];
        $res = Cart::insert($data);
        if($res){
            echo json_encode(['status'=>200,'msg'=>'添加购物车成功']);die;
        }else{
            echo json_encode(['status'=>1,'msg'=>'添加购物车失败']);die;
        }
    }

    /**
     * 获取用户的id
     */
    public function getAdminId()
    {
        $admin_info = \request()->session()->get('admin');
        $admin_id = $admin_info->admin_id;
        return $admin_id;
    }

    /**
     * 购物车列表
     */
    public function cartList()
    {
        if(!session('admin')){

        }else{
            $data = Cart::get();
//            dd($data);
        }
        return view('admin/goods/cartList',['data'=>$data]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Goods::where('goods_id',$id)->delete();
        if($res){
            return [
                'status'=>200,
                'msg'=>'success',
                'data'=>[]
            ];
        }else{
            return [
                'status'=>1,
                'msg'=>'删除失败',
                'data'=>[]
            ];
        }
    }
}
