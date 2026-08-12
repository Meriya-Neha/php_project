<?php
use Dotenv\Dotenv;

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../repository/userrepository.php';
require_once __DIR__ . '/../utils/Exception.php';
require_once __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

use Firebase\JWT\JWT;

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

        $existing = $this->userrepository->findByEmail($data['email']);
        if ($existing) {
            throw new InvalidRequestException('Email already registered');
        }
        $user=$this->userrepository->create($data);

       $secret = $_ENV['JWT_SECRET'];
$issuedAt = time();
$expire = $issuedAt + 3600;

$payload = [
    'iat'  => $issuedAt,
    'exp'  => $expire,
    'user_id'    => $user['id'],    // Use -> for objects
    'user_email' => $user['email'],
];

// This is the native way to "sign" the token
$token = JWT::encode($payload, $secret, 'HS256');

echo $token;



        return ['user'=>$user,
                'token'=>$token];
     }

     public function getById(array $input): array
     {
        $user = $this->userrepository->findByEmail($input['email']);
        if (!$user) {
            throw new NotFoundException('User not found');
        }
        echo "Retrieved user: " . json_encode($user) . "\n"; // Debugging line
        password_verify($input['password'], $user['password']);
        if(!password_verify($input['password'], $user['password'])) {
            throw new InvalidRequestException('Invalid password');
        }

        $secret = $_ENV['JWT_SECRET'];
$issuedAt = time();
$expire = $issuedAt + 3600;

$payload = [
    'iat'  => $issuedAt,
    'exp'  => $expire,
    'user_id'    => $user['id'],    // Use -> for objects
    'user_email' => $user['email'],
];

// This is the native way to "sign" the token
$token = JWT::encode($payload, $secret, 'HS256');

echo $token;


        // $check_password=$this->userrepository->findByPassword($input['password']);
        return ['user'=>$user,
                'token'=>$token];
     }
     

}
?>