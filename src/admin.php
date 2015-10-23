<?php

/*
CREATE TABLE admins(
    admin_id INT AUTO_INCREMENT,
    email VARCHAR(60) UNIQUE,
    password CHAR(60),
    PRIMARY KEY(admin_id)
)
*/

class Admin
{
    static private $conn;

    private $id;
    private $name;
    private $email;
    private $password;

    public static function setConnection(mysqli $newConnection)
    {
        self::$conn = $newConnection;
    }

    static public function LogIn($email, $password)
    {
        $sql = "SELECT * FROM admins WHERE  email = '$email'";
        $result = self::$conn->query($sql);

        if ($result == true) {
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                if (password_verify($password, $row["password"])) {
                    $loggedAdmin = new Admin($row["admin_id"], $row["email"], $row["name"]);
                    return $loggedAdmin;
                }

            }
        }
        return false;
    }


    public function __construct($newId, $newName, $newEmail)
    {
        $this->id = $newId;
        $this->email = $newEmail;
        $this->name = $newName;

    }


    static public function getAdminById($id)
    {
        $sql = "SELECT * FROM admmins WHERE admin_id = ($id)";
        $result = self::$conn->query($sql);
        if ($result == true) {
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $loggedUser = new Admin($row['name'], $row['email']);
                return $loggedUser;
            }
        }
        return false;
    }

    public static function createMessage($id, $text){
        if(is_string($text) && strlen($text) <= 140){
            $sql = "INSERT INTO tweets(text, creation_date, user_id) VALUES ('$text', NOW(), '$userId')";
            $result = self::$conn->query($sql);
            if($result == true){
                $myTweet = new Tweet(self::$conn->insert_id, $userId, date("Y-m-d H:i:s"), $text);
                return $myTweet;
            }
        }
        return false;

    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }



    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPassword()
    {
        return $this->password;
    }









}


