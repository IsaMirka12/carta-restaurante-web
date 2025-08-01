<?php
require '../libs/JWT/JWT.php';
require '../conexion/conexion.php'

use Firebase\JWT\JWT;



function registrarUsuario($id){
    $expiracion = time() + 3600;
    $payload = [
    "iss" => "http://localhost",
    "aud" => "http://localhost",
    "iat" => time(),
    "exp" => $expiracion, 
    "sub" => $id
];


$jwt = JWT::encode($payload, $jwts, 'HS256');



return $jwt;

}


