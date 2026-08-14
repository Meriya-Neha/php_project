<?php

require_once __DIR__ ."/../config/db.php";

class userrepository{
    private PDO $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }


    public function create(array $data): array
    {
        $stmt = $this->db->prepare(
            'INSERT INTO users (name, email,password,mobile_no, created_at) VALUES (:name, :email, :password, :mobile_no, NOW())'
        );
    $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'mobile_no' => $data['mobile_no'],
        ]);

        return [
            'id' => (int)$this->db->lastInsertId(),
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_no' => $data['mobile_no'],
        ];
       
    }

//    public function findByEmail(array $data): array
//    {
//        print_r("email request in repository");
//        $email = $data['email'] ?? null;
//        print_r("data receive from service $email \n");
    
//     $email_find=$stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
//     // print_r($email_find);
//     $user=$stmt->execute(['email' => $email]);
//     print_r("database result print $user");
//     $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
//     print_r("FIND BY EMAIL $user");
//     return $user ?: [];

   
// }
public function findByEmail(array $data):array
{
    $email=$data['email'] ?? null;
    $query=('SELECT * FROM users WHERE email = :email');
    $stmt=$this->db->prepare($query);
    $user=$stmt->execute(['email' => $email]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo ("find by email repository result");
    print_r( $results);
    if(empty($results)){
        echo("array empty");
        return $results;
    }
    else
    {
        return $results[0];
    }
     
    
    
}

public function findEmailInOtp(array $data):array{
    $email=$data['email'];
    $query=('SELECT * FROM otp WHERE email = :email');

    $stmt=$this->db->prepare($query);
    $stmt->execute(['email'=>$email]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo("repository result");
    print_r($result);
    return $result;
    
    
}

public function addemail(string $email ):string
{
    $stmt=$this->db->prepare('INSERT INTO otp(email)VALUES(:email)');
    $email=$stmt->execute(['email'=>$email]);
    return $email;
}

public function update_otp(array $user,string $otp,string $expire_at):array{
    print_r($user);
    print_r($otp);
    print_r($expire_at);
    print_r($user[0]['email']);
    $email=$user[0]['email'];
    
    $stmt = $this->db->prepare('UPDATE otp SET otp = :otp, expire_at = :expire_at WHERE email = :email');

$stmt->execute([
    ':otp'       => $otp,
    ':expire_at' => $expire_at,
    ':email'     => $email
]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo("update otp");
    print_r($result);
    return $result;
}

// public function addEmailInOtp(array $data):array{
//     $stmp=$this->db->prepare('INSERT INTO otp ('email) VALUES ()')
// }

public function otpVarification (array $input):array
{
    $otp=$input['otp'];
    $stmt=$this->db->prepare('SELECT * FROM otp WHERE otp=:otp');
    $stmt->execute([
        'otp'=>$otp
    ]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo("otp repo");
    print_r($result);
    return $result;
}


public function otpDelete(array $data):array{
    print_r($data);
    $otp=$data[0]['otp'];
    $stmt=$this->db->prepare('DELETE FROM otp WHERE otp=:otp');
    $stmt->execute(['otp'=>$otp]);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
    return $result;
    
    
}
}
?>