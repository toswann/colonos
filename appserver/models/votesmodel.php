<?php

class VotesModel {

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

    public function saveVote(      $vote_id_item, 
                                                $vote_email, 
                                                $vote_grade_personal , 
                                                $vote_grade_cleanliness,
                                                $vote_grade_confort, 
                                                $vote_grade_location, 
                                                $vote_grade_services, 
                                                $vote_grade_pqratio, 
                                                $vote_text, 
                                                $vote_newsletter
                                        ) {
        $sql = "INSERT INTO ratings (rating_id, item_id, state, date, email, newsletter, grade_personal , grade_cleanliness, grade_confort, grade_location, grade_services, grade_pqratio, grade_average, text) "
                . "                     VALUES ('', :item_id, :state, :date, :email, :newsletter, :grade_personal, :grade_cleanliness,  :grade_confort, :grade_location, :grade_services, :grade_pqratio, :grade_average, :text)";
        
        
        $rating_array = array( $vote_grade_cleanliness,  $vote_grade_confort ,  $vote_grade_location,  $vote_grade_services,  $vote_grade_personal,  $vote_grade_pqratio );
        
        try {        
            $data = array( 
                                ':item_id' => $vote_id_item,                 
                                ':state' => C::D("CODE_STATUS_NEW"), 
                                ':date' => F::getCurrentDateTime(),              
                                ':email' => $vote_email,
                                ':newsletter' => $vote_newsletter,                
                                ':grade_personal' => $vote_grade_personal, 
                                ':grade_cleanliness' => $vote_grade_cleanliness, 
                                ':grade_confort' => $vote_grade_confort, 
                                ':grade_location' => $vote_grade_location, 
                                ':grade_services' => $vote_grade_services, 
                                ':grade_pqratio' => $vote_grade_pqratio, 
                                ':grade_average' => F::average($rating_array), 
                                ':text' => $vote_text
                );

                $query = $this->db->prepare($sql);
                $query->execute($data);
                die(F::average($rating_array));
                return $query;      
                
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            return -1;
        }
        
    }  
    
    public function activateVote($vote_id, $item_id){
        $sql = "UPDATE ratings SET state = :state WHERE rating_id = :vote_id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':vote_id' => $vote_id,                
                ':state' => C::D('ITEM_STATE_VALID')
            ));
            $this->updateAverage($item_id);
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }        
    }
    
    public function deactivateVote($vote_id, $item_id){
        $sql = "UPDATE ratings SET state = :state WHERE rating_id = :vote_id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array(
                ':vote_id' => $vote_id,                
                ':state' => C::D('ITEM_STATE_OFFLINE')
            ));
            $this->updateAverage($item_id);            
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            var_dump($pdoE);
        }  

    }    
    
    public function getVotes($item_id=""){
        $sql = "SELECT * FROM  v_ratings_places WHERE rating_id > 0 ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();       
    }
    
    public function getVote($vote_id){
        $sql = "SELECT * FROM  v_ratings_places WHERE rating_id = :vote_id ";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':vote_id' => $vote_id
        ));
        return $query->fetch();       
    }    

    private function updateAverage($item_id){       
        $sql = "UPDATE items SET averagegrade = (SELECT ROUND(AVG(grade_average),2) FROM ratings WHERE item_id = :item_id AND state = :state) WHERE item_id = :item_id";        
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':item_id' => $item_id,                
            ':state' => C::D('ITEM_STATE_VALID')
        ));        
    }
    
}
