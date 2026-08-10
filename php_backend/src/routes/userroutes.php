<?php
    require_once __DIR__ . '/../routes/router.php';
    require_once __DIR__ . '/../controller/usercontroller.php';
    $router=new Router();

    $router->post('/register',[usercontroller::class,'createUser']);
    $router->get('/users',[usercontroller::class,'getById']);

    return $router; 
?>