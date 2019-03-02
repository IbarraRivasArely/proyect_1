<?php

namespace App\Http\Controllers;

use App\like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class likeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

     public function createLike(Request $request){
        $data = $request->json()->all();

        try{
            $like = like::create(
                [  
                    "users_id" => $data["users_id"],
                    "post_id" =>$data["post_id"],
                    "comentarios_id"=>$data["comentarios_id"]
                  ]);  
            return response()->json([$like],201);

        }catch(\Illuminate\Database\QueryException $e){

            $respuesta = array("error" => $e->errorInfo,"codigo" => 500);
            return response()->json($respuesta, 500);
        }

}
    public function getLike(){
        $like = like::all();
        return response()->json([$like],200);
    
        }

   	public function getlikeByID($id){

        $like = like::find($id);
        return response()->json($like,200);

   		}

    public function getlikeByUserID($id){
        $like = like::where(["users_id" => $id])->get();
        return response()->json($like,200);

    	}
    public function getlikeByComentarioID($id){
        $like = like::where(["comentarios_id" => $id])->get();
        return response()->json($like,200);
        
    	}
    public function getlikeByPostID($id){
        $like = like::where(["post_id" => $id])->get();
        return response()->json($like,200);
        
    	}
    public function deleteLike($id){
        try{
            $deleted = DB::delete('delete from likes where id = ?',[$id]);
            return response()->json("Post borrado correctamente",200);

        } catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error"=> $e->errorInfo,"codigo"=>500);
            return response()->json($respuesta, 500);
        }
    }

    }










