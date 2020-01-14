<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_name = request()->input('student_name')?request()->input('student_name'):'';
        $where = [];
        if($student_name){
            $where[] = ['student_name','like',"%$student_name%"];
        }
        $data = DB::table('student')->where($where)->paginate(2);
        $query = request()->all();
        if(\request()->ajax()){
            return view('student.ajaxlist',['data'=>$data,'query'=>$query]);
        }
        return view('student.list',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.add');
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
        $res = DB::table('student')->insert($post);
        if($res){
            return redirect('student/list');
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
        $res = DB::table('student')->where('student_id',$id)->first();

        return view('student.update',['res'=>$res]);
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
        $post = $request->except('_token');

        $res = DB::table('student')->where('student_id',$id)->update($post);
        if($res !== false){
            return redirect('student/list');
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
        $res = DB::table('student')->where('student_id',$id)->delete();
        if($res){
            return redirect('student/list');
        }
    }
}
