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

    public function findByEmail(array $data): array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $data['email']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

//     public function findById(int $id): ?array
//     {
        


// }
}

?>