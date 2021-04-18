<?php
namespace PhPKnights\Model;

class Lists
{
    public function getAllLists($dbcon){


        $sql = "SELECT * FROM lists";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $lists = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $lists;
    }

    public function addList($title, $creationDate, $userId, $db)
    {
        // SQL with placeholders (eg. :make)
        $sql = "INSERT INTO lists (list_name, creation_date, user_id) 
              VALUES (:title, :creationDate, :userId) ";
        $pst = $db->prepare($sql);

        // binding the values to the placeholders
        $pst->bindParam(':title', $title);
        $pst->bindParam(':creationDate', $creationDate);
        $pst->bindParam(':userId', $userId);

        // Running the SQL query
        $count = $pst->execute();

        // returns the count variable which is holding #of rows affected by query.
        return $count;
    }

    public function getListById($id, $db){
        $sql = "SELECT * FROM lists where id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }   

    public function updateList($id, $title, $creationDate, $userId, $db){
        $sql = "Update lists
                set list_name = :title,
                creation_date = :creationDate,
                user_id = :userId
                WHERE id = :id
        
        ";

        $pst =  $db->prepare($sql);

        $pst->bindParam(':title', $title);
        $pst->bindParam(':creationDate', $creationDate);
        $pst->bindParam(':userId', $userId);
        $pst->bindParam(':id', $id);

        $count = $pst->execute();

        return $count;
    }

    public function deleteList($id, $db){
        $sql = "DELETE FROM lists WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;

    }

    // ListXMovies Database Methods
    public function getListDetails($listId, $db){
        $sql = "SELECT * FROM listsxmovies where list_id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $listId);
        $pst->execute();

        $lists = $pst->fetchAll(\PDO::FETCH_OBJ);
        return $lists;

        // return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function getMovie($movieId, $db){
        $sql = "SELECT * FROM movie_info where id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $movieId);
        $pst->execute();

        return $pst->fetch(\PDO::FETCH_OBJ);
    }
}