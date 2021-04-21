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
        // admin is usergroup 0
        // regular user is usergroup 1
        $query = "INSERT INTO users 
        (first_name, last_name, date_added, user_group, username, password, email) 
        VALUES (:first, :last, NOW(), 1, :username, :password, :email)";

        $hash = hash('sha256', $password);
        $pst = $db->prepare($query);
        $pst->bindParam(':first', $first);
        $pst->bindParam(':last', $last);
        $pst->bindParam(':username', $username);
        $pst->bindParam(':password', $hash);
        $pst->bindParam(':email', $email);

        // if added to db then return the last inserted id, else return 0;
        if ($pst->execute()) {
            $lastInsertId = $db->lastInsertId();
            return $lastInsertId;
        }
        return 0;
    }

    public function authenticateUser($db, $username, $password)
    {
        $query =
            "SELECT * FROM users WHERE username = :username AND password = :password";
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
