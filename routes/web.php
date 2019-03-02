<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//$router->get('/holaMundo', function () use ($router) {
  //  return "Hola mundo!!";
//});

//$router->get('/hola', ["uses" =>
   // "UserController@index"
//]);

//$router->get('/manchego', ["uses" =>
    //"UserController@tipoQueso"
//]);

$router->get('/key', function(){
    return str_random(32);
});

$router->post('/createUser', ["uses" =>
    "UserController@postUser"
]);
$router->put('/post/{id}',["uses"=>"
    PostController@createPost"]);

$router->post('/laquequieran', ["uses" =>
    "UserController@comoQuieran"
]);

$router->get('/login', ["uses" => "UserController@login"]);

$router->post('/post', ["uses" =>
    "PostController@createPost"
]);

$router->get('/posts', ["uses" =>
    "PostController@getPosts"
]);

$router->get('/posts/{id}', ["uses" =>
    "PostController@getPostsByID"
]);
$router->get('/postsUser/{id}', ["uses" =>
    "PostController@getPostsByUserID"
]);
//Grupo de rutas para usar el authGuard
$router->group(['middleware' => ['auth']],function() use ($router){
//Rutas que vamos a checar
////////////////////////////USERS///////////////////////////////////////////
$router->get('/users', ["uses" =>
    "UserController@indexUsers"
]);

$router->get('/user/{id}', ["uses" =>
    "UserController@getUser"
]);

$router->delete('/deleteUser/{id}', ["uses" =>
    "UserController@deleteUser"
]);

$router->put('/updateUser/{id}', ["uses" =>
    "UserController@updateUser"
]);

});

//////////////////////////////////POSTS/////////////////////////////////////////////////////////
// Crear un post
$router->post('/post', ["uses" =>
    "PostController@createPost"
]);

//update
$router->put('/post/{id}', ["uses" =>
    "PostController@updatePost"
]);
//obtener datos post
$router->get('/posts', ["uses" =>
    "PostController@getPosts"
]);
//obtener los datos por id
$router->get('/post/{id}', ["uses" =>
    "PostController@getPostsByID"
]);

//upload imagen
$router->post('/file', ["uses" =>
    "PostController@uploadFile"
]);
//obtener un post de un usuario con id 
$router->get('/postsUser/{id}', ["uses" =>
    "PostController@getPostsByUserID"
]);
//borrar post
$router->delete('/post/{id}', ["uses" =>
    "PostController@deletePost"
]);


//////////////////////////////////////////COMENTARIOS////////////////////////////////////////////////////////////


//crear un comentario
$router->post('/comentario', ["uses" =>
    "comentarioController@createComentario"
]);
//ver los comentarios
$router->get('/comentarios', ["uses" =>
    "comentarioController@getComentario"
]);
//Mostrar un comentario por su id
$router->get('/comentario/{id}', ["uses" =>
    "comentarioController@getComentarioByID"
]);
//mostrar un comentario por su post_id
$router->get('/comentario_post/{id}', ["uses" =>
    "comentarioController@getcomentarioByUserID"
]);
//mostrar un comentario por su usuario_id
$router->get('/comentario_user/{id}', ["uses" =>
    "comentarioController@getcomentarioByUserID"
]);
//editar un comentario
$router->put('/comentario/{id}', ["uses" =>
    "comentarioController@updateComentario"
]);
//borrar un comentario 
$router->delete('/comentario/{id}', ["uses" =>
    "comentarioController@deletecomentario"
]);

///////////////////////////////////////LIKES//////////////////////////////////////////////////////////

//crear un like
$router->post('/like', ["uses" =>
    "likeController@createLike"
]);
//ver los likes
$router->get('/likes', ["uses" =>
    "likeController@getLike"
]);
//Mostrar un like por su id
$router->get('/like/{id}', ["uses" =>
    "likeController@getlikeByID"
]);
//mostrar un like por su usuario_id
$router->get('/like_user/{id}', ["uses" =>
    "likeController@getlikeByUserID"
]);
//mostrar un like por su comentario_id
$router->get('/like_comentario/{id}', ["uses" =>
    "likeController@getlikeByComentarioID"
]);
//mostrar un like por su post_id
$router->get('/like_post/{id}', ["uses" =>
    "likeController@getlikeByPostID"
]);
//borrar un comentario 
$router->delete('/comentario/{id}', ["uses" =>
    "likeController@deleteLike"
]);
