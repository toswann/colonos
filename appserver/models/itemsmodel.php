<?php

class ItemsModel {

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function apiGetAllActiveItems() {
        $sql = "SELECT * FROM items WHERE state > '0' ";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function GetAllActiveItems() {
        $sql = "SELECT * FROM items WHERE state > '0' ".F::getUserConstraints();
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }    

    public function getAdminItems() {
        //$sql = "SELECT item_id, name, state FROM items WHERE item_id = :item_id".F::getUserConstraints();
        $sql = "SELECT item_id, name, state, owner_id FROM items WHERE item_id IS NOT NULL ".F::getUserConstraints();

        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function saveEditItem($item_id, $name, $flatname, $category, $type, $city_id, $zone_id, $address, $phone, $email, $website, $description, $image, $lat, $long, $price) {
        $sql = "UPDATE items SET name=:name, "
                . "                             flatname=:flatname, "
                . "                             category=:category, "
                . "                             type=:type, "
                . "                             city_id=:city_id, "
                . "                             zone_id=:zone_id, "
                . "                             address=:address, "
                . "                             phone=:phone, "
                . "                             mail=:email, "
                . "                             website=:website, "
                . "                             description=:description, "
                . "                             image=:image, "
                . "                             latitude=:lat, "
                . "                             longitude=:long, "
                . "                             price=:price "
                . "WHERE item_id = :item_id";

        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':name' => $name,
            ':flatname' => $flatname,
            ':category' => $category,
            ':type' => $type,
            ':city_id' => $city_id,
            ':zone_id' => $zone_id,
            ':address' => $address,
            ':phone' => $phone,
            ':email' => $email,
            ':website' => $website,
            ':description' => $description,
            ':image' => $image,
            ':lat' => $lat,
            ':long' => $long,
            ':price' => $price,
            ':item_id' => $item_id            
        ));
    }
    
     public function saveNewItem($item_id, $name, $flatname, $category, $type, $city_id, $zone_id, $address, $phone, $email, $website, $description, $image, $lat, $long, $price) {
        $sql = "INSERT INTO items (name, flatname, category, type, city_id, zone_id, address, phone, mail, website, description, image, latitude, longitude, price) "
                . "                 VALUES (:name, :flatname, :category, :type, :city_id, :zone_id, :address, :phone, :email, :website, :description, :image, :lat, :long, :price);";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':name' => $name,
                ':flatname' => $flatname,
                ':category' => $category,
                ':type' => $type,
                ':city_id' => $city_id,
                ':zone_id' => $zone_id,
                ':address' => $address,
                ':phone' => $phone,
                ':email' => $email,
                ':website' => $website,
                ':description' => $description,
                ':image' => $image,
                ':lat' => $lat,
                ':long' => $long,
                ':price' => $price
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }

    public function getItem($item_id) {
        
        $sql = "SELECT * FROM items WHERE item_id = :item_id ".F::getUserConstraints();

        $query = $this->db->prepare($sql);
        $query->execute(array(':item_id' => $item_id));

        return $query->fetch();
    }

    public function getItemGalery($item_id) {
        $sql = "SELECT galery FROM items WHERE item_id = :item_id".F::getUserConstraints();
        $query = $this->db->prepare($sql);
        $query->execute(array(':item_id' => $item_id));
        return $query->fetch();
    }

    public function updateItemGalery($item_id, $galery) {
        $sql = "UPDATE items SET galery=:galery WHERE item_id = :item_id";
        $query = $this->db->prepare($sql);
        return $query->execute(array(':item_id' => $item_id, ':galery' => $galery));
    }

}
