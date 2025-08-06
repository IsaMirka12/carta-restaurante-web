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

 global $clave;

$jwt = JWT::encode($payload, $clave, 'HS256');



return $jwt;

}


