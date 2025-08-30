<?php
namespace App;

class User
{
    public $id;
    private $name;
    private $surname;
    private $date_of_birth;
    private $phone_number;
    private $email;
    private $login;
    private $password;
    private $role_id;

    public function __construct($id)
    {
        require_once render_view(CONFIG_PATH, 'db.php');

        $conn = db_connect();

        $query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->surname = $row['surname'];
            $this->date_of_birth = $row['date_of_birth'];
            $this->phone_number = $row['phone_number'];
            $this->email = $row['email'];
            $this->login = $row['login'];
            $this->password = $row['password'];
            $this->role_id = $row['role_id'];
        }
    }

    public function get_date()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'login' => $this->login,
            'role_id' => $this->role_id,
        ];
    }
}
?>
