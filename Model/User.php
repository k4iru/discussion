<?php 
namespace PhPKnights\Model;


class User {
    public function createTable($db) {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            date_added DATETIME NOT NULL,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            address VARCHAR(255) NOT NULL,
            postal VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            credit_card VARCHAR(255) NOT NULL
        )";

        $pdostm = $db->prepare($sql);
        $pdostm = $pdostm->execute();

        return $pdostm;
    }
    public function getUsers($db) {
        $query = "SELECT * FROM users";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        $searchResults = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $searchResults;
    }
}