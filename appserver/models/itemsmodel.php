<?php

class ItemsModel
{
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

    public function getAllActiveItems() {
        $sql = "SELECT * FROM items WHERE state > '0'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function getAdminItems($id) {
        $sql = "SELECT id, name, state FROM items WHERE id_admin = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
	
	public function saveEditItem($id, $name, $flatname, $category, $type, $city, $zone, $address, $phone, $email, $website, $description, $image, $galery, $lat, $long, $price) {
		$sql = "UPDATE items SET name=:name, flatname=:flatname, category=:category, type=:type, city=:city, zone=:zone, address=:address, phone=:phone, mail=:email, website=:website, description=:description, image=:image, galery=:galery, latitude=:lat, longitude=:long, price=:price WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(
        	':id' 			=> $id,
        	':name' 		=> $name,
        	':flatname' 	=> $flatname,
        	':category' 	=> $category,
        	':type' 		=> $type,
        	':city' 		=> $city,
        	':zone' 		=> $zone,
        	':address' 		=> $address,
        	':phone' 		=> $phone,
        	':email' 		=> $email,
        	':website' 		=> $website,
        	':description' 	=> $description,
        	':image' 		=> $image,
        	':galery' 		=> $galery,
        	':lat' 			=> $lat,
        	':long' 		=> $long,
        	':price' 		=> $price
		));

	}

    public function getItem($id) {
        $sql = "SELECT * FROM items WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }


}
