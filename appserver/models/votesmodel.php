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

        try {        
            $data = array( 
                                ':item_id' => $vote_id_item,                 
                                ':state' => C::D("CODE_STATUS_NEW"), 
                                ':date' => date( 'Y-m-d H:i:s'),              
                                ':email' => $vote_email,
                                ':newsletter' => 1,                
                                ':grade_personal' => $vote_grade_personal, 
                                ':grade_cleanliness' => $vote_grade_cleanliness, 
                                ':grade_confort' => $vote_grade_confort, 
                                ':grade_location' => $vote_grade_location, 
                                ':grade_services' => $vote_grade_services, 
                                ':grade_pqratio' => $vote_grade_pqratio, 
                                ':grade_average' => 3, 
                                ':text' => $vote_text
                );

                $query = $this->db->prepare($sql);
                $query->execute($data);
                return $query;      
                
        } catch (PDOException $pdoE) {
            echo $pdoE->getMessage() . '<br/>';
            return -1;
        }
        
    }

}
