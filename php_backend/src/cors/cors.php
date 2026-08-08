<?php
header("Access-Control-Allow-Origin: *");
header("Access-control-Allow-Methods:GET,POST,PUT,DELETE");
header("Access-Cotrol-Allow-Headers:Content-Type,Authorization");
header("Content-type:application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
?>