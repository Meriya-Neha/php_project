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
        // echo "Received data: " . json_encode($data) . "\n"; 
        // Debugging line
        try {
        $user = $this->userservice->createUser($data);
        ResponseHelper::created('User created', $user);
    } catch (InvalidRequestException $e) {
        ResponseHelper::InvalidRequest($e->getMessage());
    }
  }

public function getById(): void
{
    try{
        $input = json_decode(file_get_contents('php://input'), true);
        echo json_encode($input);
        $login=$this->userservice->getById($input);
        ResponseHelper::ok('User found', $login);
    } catch (NotFoundException $e) {
        ResponseHelper::GeneralResponse(404, false, $e->getMessage());
    }
}

}
?>