<?php

namespace PhPKnights\Model;


class User
{
    public function getUsers($db)
    {
        $query = "SELECT * FROM users";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        $searchResults = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $searchResults;
    }

    public function userNameExists($db, $username)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $pst = $db->prepare($query);
        $pst->bindParam(':username', $username);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function emailExists($db, $email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $pst = $db->prepare($query);
        $pst->bindParam(':email', $email);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function addUser($db, $first, $last, $username, $password, $email)
    {
        $query = "INSERT INTO users 
        (first_name, last_name, date_added, username, password, email) 
        VALUES (:first, :last, NOW(), :username, :password, :email)";

        $hash = hash('sha256', $password);
        $pst = $db->prepare($query);
        $pst->bindParam(':first', $first);
        $pst->bindParam(':last', $last);
        $pst->bindParam(':username', $username);
        $pst->bindParam(':password', $hash);
        $pst->bindParam(':email', $email);

        return $pst->execute();
    }

    public function getUserId($db, $username)
    {
        $query = "SELECT id FROM users WHERE username = :username";
        $pst = $db->prepare($query);
        $pst->bindParam(':username', $username);

        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function authenticateUser($db, $username, $password)
    {
        $query =
            "SELECT id FROM users WHERE username = :username AND password = :password";
        $hash = hash('sha256', $password);
        $pst = $db->prepare($query);
        $pst->bindParam(':username', $username);
        $pst->bindParam(':password', $hash);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function getUser($db, $userId)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $pst = $db->prepare($query);
        $pst->bindParam(':id', $userId);

        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }
}
