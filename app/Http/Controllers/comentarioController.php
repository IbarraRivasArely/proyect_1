<?php

namespace App\Http\Controllers;

use App\comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class comentarioController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct()
    {

    }


   public function createComentario(Request $request){
        $data = $request->json()->all();

        try{
            $comentario = comentario::create(
                [  
                    "user_id" => $data["user_id"],
                    "body" => $data["body"],
                    "imagen_url" => $data["imagen_url"],
                    "post_id" =>$data["post_id"]
                ]);

                return response()->json([$comentario],201);

        }catch(\Illuminate\Database\QueryException $e){

            $respuesta = array("error" => $e->errorInfo,"codigo" => 500);
            return response()->json($respuesta, 500);
        }
        
    }

    public function getComentario(){
        $comentario = comentario::all();
        return response()->json([$comentario],200);
    }

      public function getComentarioByID($id){

        $comentario = comentario::find($id);
        return response()->json($comentario,200);
    }
  
    public function getcomentarioByUserID($id){
        $comentario = comentario::where(["user_id" => $id])->get();
        return response()->json($comentario,200);
    }
     public function updateComentario(Request $request,$id){
        $data = $request->json()->all();
        $comentario = comentario::find($id);

        $comentario->body = $data["body"];

        $comentario->save();

        return response()->json($comentario,200);
    }
     public function deleteComentario($id){
        try{
            $deleted = DB::delete('delete from comentarios where id = ?',[$id]);
            return response()->json("comentario borrado correctamente",200);

        } catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error"=> $e->errorInfo,"codigo"=>500);
            return response()->json($respuesta, 500);
        }
    }



}