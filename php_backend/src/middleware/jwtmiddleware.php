<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$publicKey =getenv('JWT_SECRET');

$jwt = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
$jwt = str_replace('Bearer','',$jwt);

try{
    $decode=JWT::decode($jwt,new Key($publicKey,'HS256'));
     echo "Decoded Data:\n";
    print_r($decoded);

}
catch(Exception $e){
    echo "Error: The token has expired.";
}
catch(UnexpectedValueException $e){
    echo "Error: Invalid token.";
}
catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>


