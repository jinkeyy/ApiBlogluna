<?php
namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ControllerPosts extends Controller{
    public function show(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $posts = array();
        $title = $request->input("title");
        $id = $request->input("id");
        if($title=="" && $id==""){
            $result= DB::select('select * from posts');
        }
        else if($title != "" && $id == "" ){
            $result= DB::select('select * from posts where title like "%'.$title.'%"');
        }else{
            $result= DB::select('select * from posts where id = "'.$id.'"');
        }
        foreach($result as $item){
            $item->createAt=date("g:i a, d-m-Y", $item->createAt);
        }
        return response()->json(($result));
        //  json_encode($result);
    }
    public function create(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $title = $request->input("title");
        $content = $request->input("content");
        $id = "1";   
        $createAt = strtotime(date("Y-m-d g:i a")); 
        if($request->hasFile("image")){
            $file = $request->file("image");
            $image = $file->getClientOriginalName();    
            $url = asset('images/'.$image);
            try{
                $file->move("images",$image);
                if($title != "" && $content != "" && $id != "" && $createAt != ""){
                    DB::insert('insert into posts (title,content,image,userId,createAt) values ("'.$title.'","'.$content.'","'.$url.'","'.$id.'","'.$createAt.'")');
                }
                return "success";
            }catch(Exception $e){
                echo $e;
            }           
        }else{
            return "fail";
        }
    }
    public function delete(Request $request){
        $idPost = $request->input("id");
        $result= DB::select('select * from posts where id = "'.$idPost.'"');
        if(count($result) <= 0){
            echo "Bản ghi không tồn tại";
        }
        else{
            try{
                DB::delete('delete from posts where id = "'.$idPost.'"');
                return "success";
            }catch(Exception $e){
                echo "Lỗi :".$e;
                return "failed";
            }       
        }
    }
    public function update(Request $request){
        $id = $request->input("id");
        if($id == ""){
            return "failed";
        }
        else{
            $title = $request->input("title");
            $content = $request->input("content");
            if($request->hasFile("image")){
                $file = $request->file("image");
                $image = $file->getClientOriginalName();    
                $url = asset('images/'.$image);
                DB::update(
                    'update posts set title = "'.$title.'", content = "'.$content.'" ,image = "'.$url.'" where id = "'.$id.'"'
                    
                );
                return "success";
            }else{
                DB::update(
                    'update posts set title = "'.$title.'", content = "'.$content.'" where id = "'.$id.'"'
                );
                return "success";
            }
        }
    }
}