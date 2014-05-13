<?php
/**
 * Model Class for handling data operations on Users/Owners/ZoneAdmins.
 * @package Data Layer
 * @category Users
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Patryk, Swann
 */
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

    public function checkUserUnique($email){
        $email = strip_tags($email);
        $sql = "SELECT user_id FROM users WHERE email = :email";
        $query = $this->db->prepare($sql);        
        $query->execute(array(':email' => $email));
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function checkAdminAuth($email, $password) {
        $email = strip_tags($email);
        $password = sha1(strip_tags($password));

        $sql = "SELECT user_id, email, name, type, state, cruser_id, zone_id FROM users, rbac_userroles r WHERE r.UserID = user_id AND email = :email AND password = :password";
        $query = $this->db->prepare($sql);
        //echo $sql;
        //echo $email.' '.$password;
        $query->execute(array(':email' => $email, ':password' => $password ));
        //die();
        return $query->fetch(PDO::FETCH_OBJ);
    }


    public function setNewPasswordAndChangeState($email, $password) {
        $password = sha1(strip_tags($password));

        $sql = "UPDATE users SET password = :password, state = :state WHERE email = :email";
        $query = $this->db->prepare($sql);
        
        return $query->execute(array(':email' => $email, ':state' => C::D('USER_STATE_ACTIVE'), ':password' => $password));
    }
    
    // POBIERANIE UZYTKOWNIKOW DLA WIDOKU ADMINISTRATORA STREFY MUSI BYC Z WIDOKU???
    private function getUsers($role_id){
        $sql = "SELECT user_id, cruser_id, email, name, type, state, zone_id, owner_task_id as task_id, count(user_id) as places_number FROM v_users_items_ownership WHERE role_id = :role_id".F::getUserConstraints(). " GROUP BY user_id";

        $query = $this->db->prepare($sql);
        
        $query->execute(array(':role_id' => $role_id));

        return $query->fetchAll();        
    }
    
    
    public function getZoneAdmins() {
        $sql = "SELECT user_id, cruser_id, email, name, state, zone_id FROM users, rbac_userroles r WHERE user_id = r.UserID AND (r.RoleID = :role_id OR r.RoleID IS NULL)".F::getUserConstraints();
        $query = $this->db->prepare($sql);
        
        $query->execute(array(':role_id' => C::D('ROLE_ZONE_ADMIN')));

        return $query->fetchAll();                

    }    
    
    public function getOwners() {
        return $this->getUsers(C::D('ROLE_OWNER'));
    }      
    
    public function getOwnersCount() {
        return count($this->getOwners());
    }     
    
    public function searchOwners($phrase="") {
        $sql = "SELECT user_id, email, name FROM v_users_items_ownership WHERE name LIKE :p AND  (role_id = :role_id OR role_id IS NULL)".F::getUserConstraints(). " GROUP BY user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':p' => "%".$phrase."%", ':role_id' => C::D('ROLE_OWNER')));
        return $query->fetchAll();            
    }   
        
    public function getZoneAdmin($user_id) {

        $sql = "SELECT user_id, email, name, type, state, zone_id, password FROM users, rbac_userroles r WHERE user_id = :user_id AND user_id = r.UserID AND (r.RoleID = :role_id OR r.RoleID IS NULL)";
        $query = $this->db->prepare($sql);
        
        $query->execute(array(':user_id' => $user_id, ':role_id' => C::D('ROLE_ZONE_ADMIN')));

        return $query->fetch();;
    }       
    
    public function getOwner($user_id) {

        $sql = "SELECT * FROM users WHERE user_id = :user_id AND type = :type";
        $query = $this->db->prepare($sql);
        
        $query->execute(array(':user_id' => $user_id, ':type' => C::D('TYPE_MODERATOR')));

        return $query->fetch();;
    }       
    
    public function addNewZoneAdmin($name, $email, $zone_id) {

        $sql = "INSERT INTO users (name, email, password, type, state, cruser_id, zone_id) VALUES (:name, :email, :password, :type, :state, :cruser_id, :zone_id);";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':password' => C::D('DEFAULT_PW_SHA1'),
                ':type' => C::D('TYPE_ZONE_ADMIN'),
                ':state' => C::D('USER_STATE_NEW'),
                ':cruser_id' => F::getUserId(),
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

        $sql = "UPDATE users SET state = :state, task_id=0 WHERE user_id = :user_id";

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

        $sql = "UPDATE users SET state = :state, task_id=0 WHERE user_id = :user_id";

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
    
    public function addNewOwner($name, $email) {

        $sql = "INSERT INTO users (name, email, password, type, state, cruser_id) VALUES (:name, :email, :password, :type, :state, :cruser_id);";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':password' => C::D('DEFAULT_PW_SHA1'),
                ':type' => C::D('TYPE_MODERATOR'),
                ':state' => C::D('USER_STATE_NEW'),
                ':cruser_id' => F::getUserId()
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }   
    
    public function updateOwner($user_id, $name, $email, $password) {

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
    
    public function setTaskId($user_id, $task_id) {

        $sql = "UPDATE users SET task_id=:task_id WHERE user_id = :user_id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':user_id' => $user_id,                
                ':task_id' => $task_id
            ));
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }
    }
    
 
  

}
