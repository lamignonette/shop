<?php

class User
{
    static private $conn;

    private $id;
    private $name;
    private $surname;
    private $mail;
    private $password;

    public static function setConnection(mysqli $newConnection){
        self::$db = $newConnection;
    }
    static public function logIn($email,$password){
        $sql = "SELECT * FROM users WHERE email= '$email'";
        $result = self::$conn->query($sql);

        if($result == true){
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
                if(password_verify($password, $row["password"])){
                    $loggedUser = new User($row["user_id"], $row["email"], $row['surname']);
                    return $loggedUser;
                }
            }
        }
        return false;
    }
    static public function register( $newEmail, $password, $password2, $newSurname){
        if($password != $password2){
            return false;
        }
        $hasshedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users(email,password,surname)
                VALUES('$newEmail', '$hasshedPassword', '$newSurname')";

        $result= self::$conn->query($sql);
        if($result == true){
            $newUser = new User(self::$conn->insert_id, $newEmail, $newSurname);
            return $newUser;
        }
        return false;
    }

    public function __construct($newId,$newName, $newEmail, $newSurname){
        $this->id = $newId;
        $this->name = $newName;
        $this->email = $newEmail;
        $this->surname = $newSurname;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($newName)
    {
        $this->name = $newName;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname($newSurname)
    {
        $this->surname = $newSurname;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function setMail($newMail)
    {
        $this->mail = $newMail;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($newPassword)
    {
        $this->password = $newPassword;
    }

}