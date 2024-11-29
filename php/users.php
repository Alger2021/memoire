<?php

class User {
    private $conn;
    private $table = 'user_table';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function user_data($matricule) {
        $sql = $this->conn->prepare("SELECT * FROM {$this->table} WHERE matricule = ?");
        $sql->bindParam(1, $matricule, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    
}

?>