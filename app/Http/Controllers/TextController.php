<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = DB::table('text_type')->get();

            $title = request()->input('title');
            $type_id = request()->input('type_id');
            $where = [];
            if($title){
                $where[] = ['text_title','like',"%$title%"];
            }
            if($type_id){
                $where[] = ['text.text_type_id','=',$type_id];
            }

        $data = DB::table('text')->join('text_type','text.text_type_id','=','text_type.text_type_id')->where($where)->paginate(2);
        $query = request()->all();
        if(request()->ajax()){
            return view('text/ajaxlist',['data'=>$data,'query'=>$query]);
        }
        return view('text/list',['data'=>$data,'res'=>$res,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = DB::table('text_type')->get();
        return view('text/add',['res'=>$res]);
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
        if($request->hasFile('text_pic')){
            $post['text_pic'] = $this->upload('text_pic');
        }
        $res = DB::table('text')->insert($post);
        if($res){
            return redirect('text/list');
        }


    }

    public function checkdoadd(Request $request){
        $title = $request->except('_token');
//            dd($title);
        $res = DB::table('text')->where('text_title','=',$title)->first();
        if($res){
            return [
                'status'=>1,
                'msg'=>'标题重复',
                'data'=>[]
            ];
        }else{
            return [
                'status'=>2,
                'msg'=>'success',
                'data'=>[]
            ];
        }
    }

    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $photo = \request()->file($filename);
            $res = $photo->store('uploads/text');
            return $res;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('text/update');
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
        $res = DB::table('text')->where('text_id',$id)->delete();
        if($res){
            return [
                'status'=>200,
                'msg'=>'success',
                'data'=>[]
            ];
        }else{
            return [
                'status'=>2,
                'msg'=>'删除失败',
                'data'=>[]
            ];
        }
    }
}
