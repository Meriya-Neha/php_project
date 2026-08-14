<?php

require_once __DIR__ . '/../services/userservice.php';
require_once __DIR__ . '/../utils/response.php';

class usercontroller{
        
private Userservice $userservice;
    public function __construct()
    {
        $this->userservice = new userservice();
    }


 public function createUser(): void
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];
        // echo $data[0];
        echo "Received data: " . json_encode($data) . "\n"; 
        // Debugging line
        try {
        $user = $this->userservice->createUser($data);
        // echo($user);
        ResponseHelper::created('User created', $user);
    } catch (InvalidRequestException $e) {
        ResponseHelper::InvalidRequest($e->getMessage());
    }
  }

public function getById(): void
{
    try{
        
        $input = json_decode(file_get_contents('php://input'), true);
        echo "receive data".json_encode($input);
        echo json_encode("hello ");
        $login=$this->userservice->getById($input);
        
        echo ("hello1");
        ResponseHelper::ok('User found', $login);
    } catch (NotFoundException $e) {
        ResponseHelper::GeneralResponse($e->getMessage());
    }
}

public function email_varification():void
{
    try{
        $input=json_decode(file_get_contents('php://input'),true);
         echo "receive data".json_encode($input);
        $email_varification=$this->userservice->email_varification($input);
        ResponseHelper::ok('OTP send',$input);
    }
    catch(e){
        echo("Error in controller");

    }
}

public function otpVarification():void
{
    try{
        $input=json_decode(file_get_contents('php://input'),true);
        $otp_varification=$this->userservice->otpVarification($input);
        ResponseHelper::ok('otp varify successfully',$input);
    }
    catch(e){
        echo ("error in controller");
    }
}

}
?>