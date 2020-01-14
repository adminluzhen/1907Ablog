<?php

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}

function cateTree($data , $parent_id = 0 , $level = 1){
    static $new = [];
    if(!$data){
        return;
    }
    foreach($data as $k => $v){
        if($v->parent_id == $parent_id){
            $v->level = $level;
            $new[] = $v;
            cateTree($data , $v->cate_id , $level+1);
        }
    }
    return $new;
}

function moreuploads($filename){
    if(!$filename){
        return;
    }
    $imgs = request()->file($filename);

    $result = [];
    foreach ($imgs as $k => $v){
        $result[] = $v->store('uploads/goods');
    }
    return $result;
}


















