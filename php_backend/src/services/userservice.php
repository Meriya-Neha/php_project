<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../repository/userrepository.php';
require_once __DIR__ . '/../utils/Exception.php';

class userservice{

    private userrepository $userrepository;

        public function __construct()
        {
            $this->userrepository = new userrepository();
        }   

     public function createUser(array $data): array
     {
        if (empty($data['name']) || empty($data['email'])) {
            throw new InvalidRequestException('Name and email are required');
        }

        $password = $data['password'] ?? null;
        $hashedPassword =password_hash($password, PASSWORD_DEFAULT) ;
        $data['password'] = $hashedPassword;

        // if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        //     throw new InvalidRequestException('Invalid email format');
        // }

        // $existing = $this->userrepository->findByEmail($data['email']);
        // if ($existing) {
        //     throw new InvalidRequestException('Email already registered');
        // }

        return $this->userrepository->create($data);
     }

     public function getById(array $input): array
     {
        $user = $this->userrepository->findByEmail($input);
        if (!$user) {
            throw new NotFoundException('User not found');
        }

        // $check_password=$this->userrepository->findByPassword($input['password']);
        return $user;
     }

}
?>