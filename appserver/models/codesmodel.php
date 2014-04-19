<?php

class CodesModel
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

	public function checkCodeExist($code) {
        $sql = "SELECT code FROM codes WHERE code = :code";
        $query = $this->db->prepare($sql);
        $query->execute(array(':code' => $code));
        return $query->fetch();		
	}

	public function insertNewCode($id_item, $code) {
        $sql = "INSERT INTO codes (id_item, status, code) VALUES (:id_item, :status, :code)";
        $query = $this->db->prepare($sql);
        return $query->execute(array(':id_item' => $id_item, ':status' => C::D("CODE_STATUS_NEW"), ':code' => $code));
	}

	public function getItemCodes($id_item) {
		$sql = "SELECT * FROM codes WHERE id_item = :id_item ORDER BY id ASC";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id_item' => $id_item));
        return $query->fetchAll();
	}

    public function getCode($code) {
        $sql = "SELECT * FROM codes WHERE code = :code";
        $query = $this->db->prepare($sql);
        $query->execute(array(':code' => $code));
        return $query->fetch();
    }
}

