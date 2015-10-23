<?php
class Item{
    static private $conn;

    public $id;
    public $price = 0;
    public $name ='';
    public $description='';
    public $availability='';


    public static function setConnection(mysqli $newConnection){
        self::$conn = $newConnection;
    }

    public function __construct($newId,$newName,$newPrice,$newDescription,$newAvailability){
            $this->id = $newId;
            $this->price =$newPrice;
            $this->name =$newName;
            $this->setDescription($newDescription);
    }
    public static function createItem($newName, $newPrice, $newDescription, $newAvailability)
    {
        $sql = "INSERT INTO items (name, rice, description, availability)
            VALUES ('$newName', '$newPrice', '$newDescription', '$newAvailability')";
        $result = self::$conn->query($sql);
        if ($result) {
            $newItem = new Item(self::$conn->insert_id, $newName, $newPrice, $newDescription, $newAvailability);
            return $newItem;
        }
    }

    public static function getItems($id = null)
    {
        $itemTab = [];
        $sql = "SELECT * FROM items" . ($id === null ? '' : 'WHERE id =' . $id);
        $result = self::$conn->query($sql);
        if ($result == true) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $shownItem = new Item($row['id'], $row['name'], $row['price'], $row['description'],
                    $row['itemCount']);
                $itemTab[] = $shownItem;
            }
        }
        return $itemTab;
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