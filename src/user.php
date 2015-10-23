<?php


class User
{
    private static $conn;
    private $user_id;
    private $name;
    private $surname;
    private $email;
    private $address;

    public static function setConnection(mysqli $newConnection)
    {
        self::$conn = $newConnection;
    }
    public static function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = self::$conn->query($sql);
        if ($result == true) {
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $loggedUser = new user($row["user_id"], $row["name"], $row["surname"], $row["email"],
                        $row["userAdress"]);
                    return $loggedUser;
                }
            }
        }
        return false;
    }
    public static function register($newname, $newsurname, $newemail, $password, $password2, $newaddress)
    {
        if ($password != $password2) {
            return false;
        }
        $hasshedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users(name, surname, email, password, address)
            VALUES ('$newname','$newsurname','$newemail','$hasshedPassword',
            '$newaddress')";

        $result = self::$conn->query($sql);
        if ($result == true) {
            $newUser = new user(self::$conn->insert_id, $newname, $newsurname, $newemail, $newaddress);
            return $newUser;
        }
        return false;
    }
    public static function getuser($user_id = null)
    {
        $userTab = [];
        $sql = "SELECT * FROM user" . ($user_id === null ? '' : 'WHERE itemId =' . $user_id);
        $result = self::$conn->query($sql);
        if ($result == true) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $shownUser = new user($row["user_id"], $row["name"], $row["surname"], $row["email"],
                    $row["userAdress"]);
                $userTab[] = $shownUser;
            }
        }
        return $userTab;
    }
    public function __construct($newuser_id, $newname, $newsurname, $newemail, $newaddress)
    {
        $this->user_id = $newuser_id;
        $this->setname($newname);
        $this->setsurname($newsurname);
        $this->setemail($newemail);
        $this->setaddress($newaddress);
    }
    public function getuser_id()
    {
        return $this->user_id;
    }
    public function getname()
    {
        return $this->name;
    }
    public function setname($name)
    {
        $this->name = $name;
    }
    public function getsurname()
    {
        return $this->surname;
    }
    public function setsurname($surname)
    {
        $this->surname = $surname;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function setemail($email)
    {
        $this->email = $email;
    }
    public function getaddress()
    {
        return $this->address;
    }
    public function setaddress($address)
    {
        $this->address = $address;
    }
}