<?php
/**
 * Model Class for handling data operations on Codes.
 * @package Data Layer
 * @category Codes      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Patryk, Swann
 */
class CodesModel {

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

    public function checkCodeExist($code) {
        $sql = "SELECT code FROM codes WHERE code = :code";
        $query = $this->db->prepare($sql);
        $query->execute(array(':code' => $code));
        return $query->fetch();
    }

    public function insertNewCode($item_id, $code) {
        $sql = "INSERT INTO codes (item_id, status, code) VALUES (:item_id, :status, :code)";
        $query = $this->db->prepare($sql);
        return $query->execute(array(':item_id' => $item_id, ':status' => C::D("CODE_STATUS_NEW"), ':code' => $code));
    }

    public function getItemCodes($item_id) {
        $sql = "SELECT * FROM codes WHERE item_id = :item_id ORDER BY item_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute(array(':item_id' => $item_id));
        return $query->fetchAll();
    }

    public function getCode($code) {
        $sql = "SELECT * FROM codes WHERE code = :code";
        $query = $this->db->prepare($sql);
        $query->execute(array(':code' => $code));
        return $query->fetch();
    }
    
    public function markUsedCode($item_id, $code) {
        $sql = "UPDATE codes SET status = ".C::D("CODE_STATUS_USED").", used_date = '". date( 'Y-m-d H:i:s')."' WHERE code = :code AND item_id = :item_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':code' => $code, ':item_id' => $item_id));
        return $query;        
    }
    
    public function markPrintedCodes($item_id) {
        $sql = "UPDATE codes SET status = ".C::D("CODE_STATUS_PRINT")." WHERE item_id = :item_id AND status = ".C::D("CODE_STATUS_NEW");
        $query = $this->db->prepare($sql);
        $query->execute(array(':item_id' => $item_id));
        return $query;        
    }    

}
