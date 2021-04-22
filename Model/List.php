<?php
namespace PhPKnights\Model;

class Lists
{
    public function getAllLists($dbcon){


        $sql = "SELECT * FROM lists";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute();

        $lists = $prepare->fetchAll(\PDO::FETCH_OBJ);
        return $lists;
    }

    public function addList($title, $creationDate, $userId, $db)
    {
        // SQL with placeholders (eg. :make)
        $sql = "INSERT INTO lists (list_name, creation_date, user_id) 
              VALUES (:title, :creationDate, :userId) ";
        $prepare = $db->prepare($sql);

        // binding the values to the placeholders
        $prepare->bindParam(':title', $title);
        $prepare->bindParam(':creationDate', $creationDate);
        $prepare->bindParam(':userId', $userId);

        // Running the SQL query
        $count = $prepare->execute();

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

    public function updateList($id, $title, $creationDate,$userId, $db){
        $sql = "Update lists
                set list_name = :title,
                creation_date = :creationdate,
                user_id = :userId
                WHERE id = :id
        
        ";

        $prepare =  $db->prepare($sql);

        $prepare->bindParam(':title', $title);
        $prepare->bindParam(':creationdate', $creationDate);
        $prepare->bindParam(':userId', $userId);
        $prepare->bindParam(':id', $id);

        $count = $prepare->execute();

        return $count;
    }

    public function deleteList($id, $db){
        $sql = "DELETE FROM lists WHERE id = :id";

        $prepare = $db->prepare($sql);
        $prepare->bindParam(':id', $id);
        $count = $prepare->execute();
        return $count;

    }

    // ListXMovies Database Methods
    public function getListDetails($listId, $db){
        $sql = "SELECT * FROM listsxmovies where list_id = :id";
        $prepare = $db->prepare($sql);
        $prepare->bindParam(':id', $listId);
        $prepare->execute();

        $lists = $prepare->fetchAll(\PDO::FETCH_OBJ);
        return $lists;

        // return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function addMovieToList($listId, $movieId, $db)
    {
        // SQL with placeholders (eg. :make)
        $sql = "INSERT INTO listsxmovies (list_id, movie_id) 
              VALUES (:listId, :movieId) ";
        $prepare = $db->prepare($sql);

        // binding the values to the placeholders
        $prepare->bindParam(':listId', $listId);
        $prepare->bindParam(':movieId', $movieId);

        // Running the SQL query
        $count = $prepare->execute();

        // returns the count variable which is holding #of rows affected by query.
        return $count;
    }

    public function deleteMovieFromList($listId, $movieId, $db){
        $sql = "DELETE FROM listsxmovies WHERE list_id = :listId AND movie_id = :movieId";

        $prepare = $db->prepare($sql);
        $prepare->bindParam(':listId', $listId);
        $prepare->bindParam(':movieId', $movieId);
        $count = $prepare->execute();
        return $count;

    }

    // Movie_Info Database Methods
    public function getMovie($movieId, $db){
        $sql = "SELECT * FROM movie_info where id = :id";
        $prepare = $db->prepare($sql);
        $prepare->bindParam(':id', $movieId);
        $prepare->execute();

        return $prepare->fetch(\PDO::FETCH_OBJ);
    }

    public function getAllMovies($dbcon){


        $sql = "SELECT * FROM movie_info";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute();

        $movies = $prepare->fetchAll(\PDO::FETCH_OBJ);
        return $movies;
    }



}