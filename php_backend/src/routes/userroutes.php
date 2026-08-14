<?php
    require_once __DIR__ . '/../routes/router.php';
    require_once __DIR__ . '/../controller/usercontroller.php';
    $router=new Router();

    $router->post('/register',[usercontroller::class,'createUser']);
    $router->post('/users',[usercontroller::class,'getById']);
    $router->post('/email-varification',[usercontroller::class,'email_varification']);
    $router->post('/otp-varification',[usercontroller::class,'otpVarification']);




    return $router; 
?>