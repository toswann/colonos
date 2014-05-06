<?php

class TasksModel {

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    
    private $_rowsPerView = 10;
    
    function __construct($db) {
        try {
            $this->db = $db;
            $this->_rowsPerView = C::D('ROWS_PER_VIEW');
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function insertNewTask($type, $details, $comments = "") {
        $sql = "INSERT INTO tasks (type, state, admin_id, details, create_date, comments ) VALUES (:type, :state, :admin_id, :details, :create_date, :comments)";
        $query = $this->db->prepare($sql);

        $query->execute(array(   ':type' => $type, 
                                                        ':state' => C::D('ITEM_STATE_OFFLINE'), 
                                                        ':admin_id' => F::getUserId(),
                                                        ':details' => $details,            
                                                        ':create_date' => F::getCurrentDateTime(),            
                                                        ':comments' => $comments
                                            ));
        return $this->db->lastInsertId();
    }

    public function getTasks($page = 1) {
        $sql = "SELECT t.*, u.name FROM tasks t, users u WHERE t.admin_id = u.user_id AND t.state = ".C::D('TASK_STATE_NEW')." ORDER BY task_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getTaskDetails($task_id) {
        $sql = "SELECT * FROM tasks WHERE task_id = :task_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':task_id' => $task_id));
        return $query->fetch();
    }
    
    public function markDoneTask($task_id, $state ="", $comments="") {
        $sql = "UPDATE tasks SET state = :state, comments = :comments WHERE task_id = :task_id".F::getUserConstraints();
        $query = $this->db->prepare($sql);
        $query->execute(array(':task_id' => $task_id, ':comments' => $comments, ':state' => C::D($state)));
        return $query;        
    }
    
    public function processTask($task_id) {
        $sql = "UPDATE tasks SET stat = ".C::D("ITEM_STATE_OFFLINE").", used_date = '". date( 'Y-m-d H:i:s')."' WHERE code = :code AND yask_id = :task_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':code' => $code, ':item_id' => $item_id));
        return $query;        
    }    

}
