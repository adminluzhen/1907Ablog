<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Validator;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        showMsg(1,'Hello World!');
        $book_name = \request()->input('book_name')??'';
//        dump($book_name);
        $where = [];
        if($book_name){
            $where[] = ['book_name','like',"%$book_name%"];
        }
        $data = Book::where($where)->paginate(2);
        $query = \request()->all();
        return view('book/list',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.add');
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
        $validator = Validator::make($post, [
            'book_name' => 'required|unique:book|max:15|min:2|alpha_dash ',
            'book_man' => 'required',
            'book_price' => 'required',
        ],[
            'book_name.required'=>'图书名称必填！',
            'book_name.unique'=>'图书名称已存在！',
            'book_name.max'=>'图书名称长度为2-15位！',
            'book_name.min'=>'图书名称长度为2-15位！',
            'book_name.alpha_dash'=>'名称格式为中文，字母，数字，下划线！',
            'book_man.required'=>'作者必填！',
            'book_price.required'=>'价格必填！',
        ]);

        if ($validator->fails()) {
            return redirect('book/showadd')
                ->with('data',$post)
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('book_pic')){
            $post['book_pic'] = $this->upload('book_pic');
        }else{
            return redirect('book/showadd');
        }

        $book_model = new Book();
        $book_model->book_name = $post['book_name'];
        $book_model->book_man = $post['book_man'];
        $book_model->book_price = $post['book_price'];
        $book_model->book_pic = $post['book_pic'];
        if($book_model->save()){
            return redirect('book/list');
        }

    }

    public function upload($filename){
        if(\request()->file($filename)->isValid()){
            $photo = \request()->file($filename);
            $res = $photo -> store('book');
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
        $res = Book::where('book_id',$id)->delete();
        if($res){
            return redirect('book/list');
        }
    }
}
