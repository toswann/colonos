<?php

class UsersModel
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

    public function checkAdminAuth($email, $password) {
        $email = strip_tags($email);
        $password = sha1(strip_tags($password));

        $sql = "SELECT user_id, email, name, type, state, cruser_id, zone_id FROM users WHERE email = :email AND password = :password AND type >= :type";
        $query = $this->db->prepare($sql);
        
        $query->execute(array(':email' => $email, ':password' => $password, ':type' => C::D('TYPE_MODERATOR')));

        return $query->fetch(PDO::FETCH_OBJ);
    }


    public function setNewPasswordAndChangeState($email, $password) {
        $password = sha1(strip_tags($password));

        $sql = "UPDATE users SET password = :password, state = :state WHERE email = :email";
        $query = $this->db->prepare($sql);
        
        return $query->execute(array(':email' => $email, ':state' => C::D('USER_STATE_ACTIVE'), ':password' => $password));
    }
    
    // POBIERANIE UZYTKOWNIKOW DLA WIDOKU ADMINISTRATORA STREFY MUSI BYC Z WIDOKU???
    private function getUsers($type){
        $sql = "SELECT user_id, cruser_id, email, name, type, state, zone_id, count(user_id) as places_number FROM v_users_items_ownership WHERE type = :type".F::getUserConstraints(). " GROUP BY user_id";

        $query = $this->db->prepare($sql);
        
        $query->execute(array(':type' => $type));

        return $query->fetchAll();        
    }
    
    
    public function getZoneAdmins() {
        $sql = "SELECT user_id, cruser_id, email, name, state, zone_id FROM users WHERE type = :type".F::getUserConstraints();
        $query = $this->db->prepare($sql);
        
        $query->execute(array(':type' => C::D('TYPE_ZONE_ADMIN')));

        return $query->fetchAll();                

    }    
    
    public function getOwners() {
        return $this->getUsers(C::D('TYPE_MODERATOR'));
    }      
    
    public function getZoneAdmin($user_id) {

        $sql = "SELECT user_id, email, name, type, state, zone_id, password FROM users WHERE user_id = :user_id AND type = :type";
        $query = $this->db->prepare($sql);
        
        $query->execute(array(':user_id' => $user_id, ':type' => C::D('TYPE_ZONE_ADMIN')));

        return $query->fetch();;
    }       
    
    public function getOwner($user_id) {

        $sql = "SELECT * FROM users WHERE user_id = :user_id AND type = :type";
        $query = $this->db->prepare($sql);
        
        $query->execute(array(':user_id' => $user_id, ':type' => C::D('TYPE_MODERATOR')));

        return $query->fetch();;
    }       
    
    public function addNewZoneAdmin($name, $email, $zone_id) {

        $sql = "INSERT INTO users (name, email, password, type, state, admin_id, zone_id) VALUES (:name, :email, :password, :type, :state, :cruser_id, :zone_id);";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':password' => C::D('DEFAULT_PW_SHA1'),
                ':type' => C::D('TYPE_ZONE_ADMIN'),
                ':state' => C::D('USER_STATE_NEW'),
                ':cruser_id' => $_SESSION['user']->id,
                ':zone_id' => $zone_id
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }   
    
    public function updateZoneAdmin($user_id, $name, $email, $zone_id, $password) {

        $sql = "UPDATE users SET name = :name, email = :email, zone_id = :zone_id, password = :password WHERE user_id = :user_id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':user_id' => $user_id,                
                ':name' => $name,
                ':password' => $password,                
                ':email' => $email,
                ':zone_id' => $zone_id
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }    
    
    public function activateZoneAdmin($user_id) {

        $sql = "UPDATE users SET state = :state WHERE user_id = :user_id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':user_id' => $user_id,                
                ':state' => C::D('USER_STATE_ACTIVE')
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }   
    
    public function deactivateZoneAdmin($user_id) {

        $sql = "UPDATE users SET state = :state WHERE user_id = :user_id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':user_id' => $user_id,                
                ':state' => C::D('USER_STATE_NEW')
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }       
    
    public function addNewOwner($name, $email, $zone_id) {

        $sql = "INSERT INTO users (name, email, password, type, state, cruser_id, zone_id) VALUES (:name, :email, :password, :type, :state, :cruser_id, :zone_id);";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':password' => C::D('DEFAULT_PW_SHA1'),
                ':type' => C::D('TYPE_MODERATOR'),
                ':state' => C::D('USER_STATE_NEW'),
                ':cruser_id' => $_SESSION['user']->id,
                ':zone_id' => $zone_id
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }   
    
    public function updateOwner($user_id, $name, $email, $zone_id, $password) {

        $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE user_id = :user_id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':user_id' => $user_id,                
                ':name' => $name,
                ':password' => $password,                
                ':email' => $email
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }    
    
    public function activateOwner($user_id) {
        $this->activateZoneAdmin($user_id);
    }   
    
    public function deactivateOwner($user_id) {
        $this->deactivateZoneAdmin($user_id);
    }       
   

}
