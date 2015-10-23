<?php

class Admin{
    static private $conn;

    private $id;
    private $userName;
    private $email;
    private $description;

    public static function setConnection(mysqli $newConnection){
        self::$conn = $newConnection;
    }

    static public function LogIn($email, $password){
        $sql = "SELECT * FROM users WHERE  email = '$email'";
        $result = self::$conn->query($sql);

        if ($result == true){
            if($result->num_rows ==1){
                $row = $result->fetch_assoc();

                if(password_verify($password, $row["password"])){
                    $loggedUser = new User($row["user_id"], $row["email"], $row["description"]);
                    return $loggedUser;
                }

            }
        }
        return false;
    }

    static public function register($newEmail, $password, $password2, $newDescription){
        if($password != $password2){
            return false;
        }

        $hasshedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql= "INSERT INTO users (email, password, description) VALUES ('$newEmail', '$hasshedPassword', '$newDescription')";
        $result = self::$conn->query($sql);

        if(self::$conn == true){
            $newUser = new User(self::$db->insert_id, $newEmail, $newDescription);
            return $newUser;

        }
        echo self::$conn->error;
        return false;
    }

    public function __construct($newId, $newEmail, $newDescription){
        $this->id=$newId;
        $this->email = $newEmail;
        $this->setDescription($newDescription);
    }


    public function saveToDB(){
        $sql = "UPDATE users SET description = '{$this->description}' WHERE user_id='{$this->id}'";
        $result=self::$conn->query($sql);
        return $result;
    }

    static public function getUserById($id){
        $sql = "SELECT * FROM users WHERE user_id = ($id)";
        $result = self::$conn->query($sql);
        if($result == true) {
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $loggedUser = new User($row['user'], $row['email'], $row['description']);
                return $loggedUser;
            }
        }
        return false;
    }

    static public function getAllUsers(){
        $ret=[];
        $sql = "SELECT * FROM users";
        $result= self::$conn->query($sql);
        if($result == true){
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $loadedUser = new User($row['user_id'], $row['email'], $row['description']);
                    $ret[] = $loadedUser;
                }
            }

        }

        return $ret;
    }

    public function loadUserTweets($userId){

        $ret = [];

        $sql = "SELECT * FROM tweets WHERE user_id = $userId";
        $result = self::$conn->query($sql);
        if($result == true){
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $userTweets = new Tweet($row['tweet_id'], $row['user_id'], $row['creation_date'], $row['text']);
                    $ret[] = $userTweets;
                }
            }
        }
        return $ret;
    }



    ///////////////////

    public function createTweet($tweetText){

    }

    public function getAllTweets(){
        $ret=[];
        return $ret;
        //after implementing tweet add
    }




    public function getAllComments(){
        $ret=[];
        return $ret;
        //after implementing tweet add
    }
    public function createComment(){
        $ret=[];
        return $ret;
        //after implementing tweet add
    }
    //////////////////////////

    public function getId()
    {
        return $this->id;
    }

    public function setUserName($newUserName){
        if(is_string($newUserName) && strlen($newUserName)<60){
            $this->userName = $newUserName;
        }
    }

    public function getUserName(){
        return $this->userName;
    }
    public function getEmail(){
        return $this->email;

    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($newDescription){
        if(is_string($newDescription) && strlen($newDescription)<255){
            return $this->description = $newDescription;
        }
    }
}
