<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get = \request()->input('user_name')?\request()->input('user_name'):'';
//        dd($get);
        $where = [];
        if($get){
            $where[] = ['user_name','like',"%$get%"];
        }
//        DB::connection()->enableQueryLog();
        $data = DB::table('user')->where($where)->paginate(2);
//        $logs = DB::getQueryLog();
//        dd($logs);

//        dd($data);
        $query = \request()->all();
        return view('user/list',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = request()->except('_token');

        if($request->hasFile('user_pic')){
            $post['user_pic'] = $this->upload('user_pic');
        }

        $res = DB::table('user')->insert($post);
        if($res){
            return redirect('user/list');
        }
    }

    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $ponto = request()->file($filename);
            $res = $ponto->store('uploads/user');
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
        $data = DB::table('user')->where('user_id',$id)->first();

        return view('user/update',['data'=>$data]);
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
        $post = request()->except('_token');

        if($request->hasFile('user_pic')){
            $post['user_pic'] = $this->upload('user_pic');
        }

        $res = DB::table('user')->where('user_id',$id)->update($post);
        if($res !== false){
            return redirect('user/list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('user')->where('user_id',$id)->delete();
        if($res){
            return redirect('user/list');
        }
    }
}
