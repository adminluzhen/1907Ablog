<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\StoreBrandgPost;
use Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * 展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = \request()->page?:1;
        // echo $page;
        $data = cache('data_'.$page); //如果有搜索和分页的解决方法一致
        dump($data);
        if(!$data){
            echo "数据库";
            $data = Brand::paginate(2);
            cache(['data_'.$page=>$data],5);
        }
        
        if(request()->ajax()){
            return view('admin.brand.ajaxlist',['data'=>$data]);
        }
        return view('admin.brand.list',['data'=>$data]);
    }
 
    /**
     * Show the form for creating a new resource.
     * 展示添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/brand/add');
    }

    /**
     * Store a newly created resource in storage.
     * 执行添加方法
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(StoreBrandgPost $request)
    public function store(Request $request)
    {
//        $validatedData = $request->validate([
//            'brand_name' => 'required|unique:brand|max:255',
//            'brand_url' => 'required',
//        ],[
//            'brand_name.required'=>'品牌名称必填！',
//            'brand_name.unique'=>'品牌名称已存在！',
//            'brand_url.required'=>'品牌网址必填！',
//        ]);
        $post = $request->except('_token');

        $va2lidator = Validator::make($post, [
            'brand_name' => 'required|unique:brand|max:255',
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填！',
            'brand_name.unique'=>'品牌名称已存在！',
            'brand_url.required'=>'品牌网址必填！',
        ]);

        if ($validator->fails()) {
            return redirect('admin/brand_showadd')
                ->withErrors($validator)
                ->withInput();
        }

        if(request()->hasFile('brand_logo')){
            $post['brand_logo'] = $this->upload('brand_logo');
        }
//        dd($post);
        $res = Brand::insert($post);
        if($res){
            return redirect('admin/brand_list');
        }
    }

    /**
     * 文件上传
     */
    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $photo = request()->file($filename);
            $store_result = $photo->store('uploads');
            return $store_result;
        }
    }

    /**
     * Display the specified resource.
     * 详情页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = Brand::find($id);

        return view('admin.brand.update',['info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     * 执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except('_token');

        if(request()->hasFile('brand_logo')){
            $post['brand_logo'] = $this->upload('brand_logo');
        }

        $res = Brand::where('brand_id',$id)->update($post);
        if($res !== false){
            return redirect('admin/brand_list');
        }
    }

    /**
     * Remove the specified resource from storage.
     * 删除方法
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        dd($id);
        $res = Brand::where(['brand_id'=>$id])->delete();
        if($res){
            return redirect('admin/brand_list');
        }
    }
}
