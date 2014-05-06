<?php

// Init of PHP RBAC engine
require_once APP_FOLDER_NAME . '/utils/phprbac/Rbac.php';

class RbacModel {

    private $db = "";
    
    // reference to RBAC engine
    private $rbac=null;
    
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
            $this->rbac = new PhpRbac\Rbac($this->db);
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getRoles() {
        $sql = "SELECT * FROM rbac_roles WHERE 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function getPermisions() {
        $sql = "SELECT * FROM rbac_permissions WHERE 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function assignPermisions($roleId, $userId)  {
        if (!$this->rbac->Users->hasRole($roleId, $userId))
            $this->rbac->Users->assign($roleId, $userId);        
    }  
    
    public function unassignPermisions($roleId, $userId) {
        $this->rbac->Users->unassign($roleId, $userId);        
    }      
       
}
