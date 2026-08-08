<?php
    require __DIR__ . '../controller/usercontroller.php';

    $router=new Router();

    $router->post('/register',[userController::class,'add_user']);

?>