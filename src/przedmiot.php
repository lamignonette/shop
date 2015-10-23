<?php
class Przedmiot{
    static private $conn;

    public $id;
    public $price = 0;
    public $name ='';
    public $description='';
    public $availability='';


    public static function setConnection(mysqli $newConnection){
        self::$db = $newConnection;
    }

    public function __construct($newId,$newPrice,$newName,$newDescription){
            $this->id =$newId;
            $this->price =$newPrice;
            $this->name =$newName;
            $this->setDescription($newDescription);
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($newPrice)
    {
        $this->price = $newPrice;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($newName)
    {
        $this->name = $newName;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($newDescription)
    {
        $this->description = $newDescription;
    }
    public function getAvailability()
    {
        return $this->availability;
    }
    public function setAvailability($newAvailability)
    {
        $this->availability = $newAvailability;
    }


}