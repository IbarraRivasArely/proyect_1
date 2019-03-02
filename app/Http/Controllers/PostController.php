<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(){
        $post = new Post();
        $post->title = "hola mundo";
        $post->body = "cuerpo del post";
        $post->imagen_url = "http://google.com";
        $post->user_id = 5;

        return response()->json($post,200);
    }

    public function createPost(Request $request){
        $data = $request->json()->all();

        try{
            $post = Posts::create(
                [
                    "title" => $data["title"],
                    "body" => $data["body"],
                    "imagen_url" => $data["imagen_url"],
                    "user_id" => $data["user_id"]
                ]);
                return response()->json([$post],201);
        }catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo" => 500);
            return response()->json($respuesta, 500);
        }
        
    }

    public function getPosts(){
        $posts = Posts::all();
        return response()->json([$posts],200);
    }

    public function getPostsByID($id){
        $posts = Posts::find($id);
        return response()->json($posts,200);
    }

    public function getPostsByUserID($id){
        $post = Posts::where(["user_id" => $id])->get();
        return response()->json($post,200);
    }

    //Updates
    public function updatePost(Request $request,$id){
        $data = $request->json()->all();
        $posts = Posts::find($id);

        $posts->title = $data["title"];
        $posts->body = $data["body"];

        $posts->save();

        return response()->json($posts,200);
    }

    //borrar post
    public function deletePost($id){
        try{
            $deleted = DB::delete('delete from posts where id = ?',[$id]);
            return response()->json("Post borrado correctamente",200);

        } catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error"=> $e->errorInfo,"codigo"=>500);
            return response()->json($respuesta, 500);
        }
    }
    //subir imagen
    public function uploadFile( Request $request){

        $destinationPath = "/cliente-servidor/proyect_1/storage/imagenes";

        $fileName = str_random(10).".jpg";
        $request->file('imagen')->move($destinationPath,$fileName);
    }
}