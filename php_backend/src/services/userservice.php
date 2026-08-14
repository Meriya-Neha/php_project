<?php
use Dotenv\Dotenv;

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../repository/userrepository.php';
require_once __DIR__ . '/../utils/Exception.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../utils/phpmailer.php';
require_once __DIR__ . '/../utils/response.php';

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
        print_r($data);
        
        if (empty($data['name']) || empty($data)) {
            throw new InvalidRequestException('Name and email are required');
        }

        $password = $data['password'] ?? null;
        $hashedPassword =password_hash($password, PASSWORD_DEFAULT) ;
        $data['password'] = $hashedPassword;
        
        $existing = $this->userrepository->findByEmail($data);
        // echo($existing);
        if ($existing) {
            throw new InvalidRequestException('Email already registered');
        }
        $user=$this->userrepository->create($data);
        $add_otp=$this->userrepository->addemail($data['email']);
        return [$user];
     }

     public function getById(array $input): array
     {
        print_r($input);
        print_r("hello ");
        $user = $this->userrepository->findByEmail($input);
        
        if ($user) {
            echo('User found');
        }
        // echo "Retrieved user: " . json_encode($user) . "\n"; // Debugging line
        // password_verify($input['password'], $user['password']);
        // if(!password_verify($input['password'], $user['password'])) {
        //     throw new InvalidRequestException('Invalid password');
        // }

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

$jwt_secret=$_ENV['JWT_REFRESH'];

$issuedAt = time();
$expire = $issuedAt + 3600;

$payload = [
    'iat'  => $issuedAt,
    'exp'  => $expire,
    'user_id'    => $user['id'],    // Use -> for objects
    'user_email' => $user['email'],
];

// This is the native way to "sign" the token
$refresh_token = JWT::encode($payload, $jwt_secret, 'HS256');
echo("refresh token $refresh_token");


// echo $token;


        // $check_password=$this->userrepository->findByPassword($input['password']);
        return [$input];
     }
     public function email_varification(array $input):array
     {
        echo("service1");
        print_r($input);
        $user=$this->userrepository->findEmailInOtp($input);
        print_r($user);
        if(! $user){
            $create_email=$this->userrepository->addemail($input[0]['email']);
        }
            $otp = random_int(100000, 999999);
            echo $otp;
            $now = new DateTimeImmutable('now', new DateTimeZone('America/New_York'));
            $currunt_time= $now->format('Y-m-d H:i:s') ;
            $extra_time = $now->modify('+5 minutes');
            $expire_time= $extra_time->format('Y-m-d H:i:s');
            $bodyText = "
    <h2>Email Verification</h2>
    <p>Your One-Time Password (OTP) is: <strong style='font-size: 20px;'>$otp</strong></p>
    <p>This code will expire in 5 minutes.</p>
";
            
            echo("mail sending log");
            // print_r($mail_send);
             $update_otp=$this->userrepository->update_otp($user,$otp,$expire_time);
             print_r($update_otp);
             $mail_send=send_custom_email($user[0]['email'],$bodyText);
           
            echo("email sending");
            print_r($mail_send);
            // if($mail_send){
            //     echo "mail sending success";
            // }
            // else{
            //     echo "mail sending fail";
            // }
            
            echo("after otp update");
            print_r($update_otp);
    
        return $user;

     }

     public function otpVarification(array $input):array{
        print_r($input);
        $find_otp=$this->userrepository->otpVarification($input);
        echo ("find otp");
        print_r($find_otp);
        if(!$find_otp){
            die("Resend OTP");
        }
        // $now=new DateTimeImmutable('now', new DateTimeZone('America/New_York'));
        // $currunt_time=now->format('Y-m-d H:i:s');
        print_r($find_otp);
        if($find_otp[0]['created_at'] > $find_otp[0]['expire_at']){
           ResponseHelper::notFound("otp expired");
        }
        echo("hello");
        $delete_otp=$this->userrepository->otpDelete($find_otp);
        return $find_otp;
        
     }

}
?>