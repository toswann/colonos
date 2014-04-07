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

        $sql = "SELECT id, email, name, type, state, id_admin, zone FROM users WHERE email = :email AND password = :password AND type >= :type";
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

}
