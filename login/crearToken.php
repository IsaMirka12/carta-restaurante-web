<?php
require '../libs/JWT/JWT.php';
require '../conexion/conexion.php';

use Firebase\JWT\JWT;



function registrarUsuario($id){
    $expiracion = time() + 3600;
    $payload = [
    "iss" => "https://carta-restaurante-web.onrender.com",
    "aud" => "https://carta-restaurante-web.onrender.com",
    "iat" => time(),
    "exp" => $expiracion, 
    "sub" => $id
];


$jwt = JWT::encode($payload, $jwts, 'HS256');



return $jwt;

}


