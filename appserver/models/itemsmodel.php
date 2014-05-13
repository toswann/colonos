<?php
/**
 * Model Class for handling data operations on Places/Items.
 * @package Data Layer
 * @category Places  
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Patryk, Swann
 */
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

    /**
     * Retrieves information about all active items from DB for API call
     * @return Array 
     * @author Patryk
     * @todo Limit retrievied fields. No need for user to know all the details
     */    
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
    
    /**
     * Retrieves information about all active items from DB for internal call
     * @return Array 
     * @author Patryk
     */        
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

    /**
     * Retrieves information about all active items managed by specific user basing on his constaints
     * @param int $owner_id ID of owner, if filtering is on
     * @param bool $assigned Filter to decide whether to show only not assigned places
     * @return Array 
     * @author Patryk
     */        
    public function getAdminItems($owner_id="", $assigned=true) {
        
        $sql = "SELECT item_id, name, state, task_id, zone_id, owner_id, averagegrade, owner_name FROM v_items_users WHERE item_id IS NOT NULL ".F::getUserConstraints();
        $params = array();
        
        if (is_numeric($owner_id) && $owner_id != ""){
            $sql = str_replace("WHERE " , "WHERE owner_id = :owner_id AND ", $sql);
            $params[':owner_id'] = $owner_id;  
        }
        
        if (!$assigned) {
            $sql = str_replace("WHERE owner_id = :owner_id AND " , "WHERE ", $sql);
            unset($params[':owner_id']);
            $sql = str_replace("WHERE " , "WHERE (owner_id IS NULL OR owner_id = 0) AND ", $sql);
        }
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        $query = $this->db->prepare($sql);
        $query->execute($params);
        
        return $query->fetchAll();
    }

    
    /**
     * Retrieves information about all active items from DB for API call
     * @param text $phrase Search phrase
     * @return Array 
     * @todo Set minimum number of chars to start searching
     * @author Patryk
     */        
    public function searchItems($phrase="") {
        $sql = "SELECT item_id, name, state, owner_id FROM items WHERE item_id IS NOT NULL AND state > '0' AND name LIKE :p ".F::getUserConstraints();
        $query = $this->db->prepare($sql);
        $query->execute(array(':p' => "%".$phrase."%"));
        return $query->fetchAll();            
    }       
    
    /**
     * Sets ownership of Item to Owner
     * @param int $item_id ID of Item
     * @param int $owner_id ID of Owner
     * @return Object 
     * @author Patryk
     */        
    public function setOwner($item_id, $owner_id) {
        $sql = "UPDATE items SET owner_id=:owner_id WHERE item_id = :item_id";

        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':owner_id' => $owner_id,
            ':item_id' => $item_id            
        ));
    }

    /**
     * Sets active state of Item
     * @param int $item_id ID of Item
     * @return Object 
     * @author Patryk
     */    
    public function activatePlace($item_id) {

        $sql = "UPDATE items SET state = :state, task_id=0 WHERE item_id = :item_id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':item_id' => $item_id,                
                ':state' => C::D('ITEM_STATE_VALID')
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }   

    /**
     * Sets not active state of Item
     * @param int $item_id ID of Item
     * @return Object 
     * @author Patryk
     */        
    public function deactivatePlace($item_id) {

        $sql = "UPDATE items SET state = :state, task_id=0 WHERE item_id = :item_id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':item_id' => $item_id,                
                ':state' => C::D('ITEM_STATE_OFFLINE')
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }       
        
    /**
     * Saves information about Item
     * @param int $item_id ID of Item
     * @param text $name Name of Item
     * @param text $flatname URL-friendly name of Item
     * @param int $category Category code of Item
     * @param int $type Type code of Item
     * @param int $city_id City code of Item
     * @param int $zone_id Zone code of Item
     * @param text $address Address of Item
     * @param text $phone Phone number of Item
     * @param text $email Contact Email of Item
     * @param text $website Website address of Item
     * @param text $description Description of Item
     * @param text $image Serialized information about Logotype of Item
     * @param text $lat Latitute in Openstreetmap.org format
     * @param text $long Longitude in Openstreetmap.org format
     * @param text $price Lowest price for this Item
     * @return Object 
     * @author Swann
     */        
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

        $keys = array(
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
                );        
         
        $pending = F::getPendingUploadedFile('logo');

        if (is_array($pending) && isset($pending['item_id']) && $pending['item_id'] == $item_id){
            if ($pending['operation'] == "update")
                $keys[':logo'] = $pending['filename'];
            else
                $keys[':logo'] = "";
            $sql = str_replace("image=:image, ", "image=:image, logo=:logo, ", $sql);
        }
         
        $query = $this->db->prepare($sql);
        $query->execute($keys);

    }
    
    /**
     * Adds new Item
     * @param int $item_id ID of Item
     * @param text $name Name of Item
     * @param text $flatname URL-friendly name of Item
     * @param int $category Category code of Item
     * @param int $type Type code of Item
     * @param int $city_id City code of Item
     * @param int $zone_id Zone code of Item
     * @param text $address Address of Item
     * @param text $phone Phone number of Item
     * @param text $email Contact Email of Item
     * @param text $website Website address of Item
     * @param text $description Description of Item
     * @param text $image Serialized information about Logotype of Item
     * @param text $lat Latitute in Openstreetmap.org format
     * @param text $long Longitude in Openstreetmap.org format
     * @param text $price Lowest price for this Item
     * @return Object 
     * @author Patryk
     */     
     public function saveNewItem($item_id, $name, $flatname, $category, $type, $city_id, $zone_id, $address, $phone, $email, $website, $description, $image, $lat, $long, $price) {
        $sql = "INSERT INTO items (owner_id, cruser_id, name, flatname, category, type, city_id, zone_id, address, phone, mail, website, description, image, logo, latitude, longitude, price) "
                . "                 VALUES (:owner_id, :cruser_id, :name, :flatname, :category, :type, :city_id, :zone_id, :address, :phone, :email, :website, :description, :image, :logo, :lat, :long, :price);";

        try {
            
            $pending = F::getPendingUploadedFile('logo');
            
            if (is_array($pending) && $pending['item_id'] == F::getTempId() && $pending['operation'] != "delete" ){
                $logo = $pending['filename'];
                F::setTempId(0);
            } else
                $logo = "";
            
            $owner_id = 0;
            if (F::getUserCurrentRole('ID') == C::D('ROLE_OWNER')){
                $owner_id = F::getUserId();
            }
            
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':owner_id' => $owner_id,
                ':cruser_id' => F::getUserId(),                
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
                ':logo' => $logo,                
                ':lat' => $lat,
                ':long' => $long,
                ':price' => $price
            ));

        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }

    /**
     * Gets information about single Item
     * @param int $item_id ID of Item
     * @return Object 
     * @author Patryk
     */          
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
   
    
    public function updateItemLogo($item_id, $onOrOf) {
        $sql = "UPDATE items SET image=:image WHERE item_id = :item_id";
        $query = $this->db->prepare($sql);
        return $query->execute(array(':item_id' => $item_id, ':image' => $onOrOf));
    }    
    
    public function setTaskId($item_id, $task_id) {

        $sql = "UPDATE items SET task_id=:task_id WHERE item_id = :item_id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':item_id' => $item_id,                
                ':task_id' => $task_id
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }
        
    public function getItemsCount() {
        return count($this->getAdminItems());
    }    

    public function getUnasignedItemsCount() {
        return count($this->getAdminItems('', false));
    }     
    
    
}
