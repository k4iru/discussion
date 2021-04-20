<?php
namespace PhPKnights\Model;

class Polls
{
    public function getOptions($db){
        $query = "SELECT * FROM poll_answers WHERE poll_id = ?";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    
    public function getPollById($id, $db){
        $sql = "SELECT * FROM polls where id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }
    public function getAllPolls($dbcon){

        $sql = "SELECT p.*, GROUP_CONCAT(pa.options ORDER BY pa.id) AS options FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id GROUP BY p.id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $cars = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $cars;
    }

    public function addPoll($title, $options, $db)
    {
        $sql = "INSERT INTO polls (title) 
              VALUES (:title) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':title', $title);
                $count = $pst->execute();
        return $count;
    }

    public function addoptions($options, $db)
    {
        $sql = "INSERT INTO poll_answers ($options, $votes) 
              VALUES (:options, 0) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':options', $options);
                $count = $pst->execute();
        return $count;
    }

    public function deletePoll($id, $db){
        $sql = "DELETE FROM polls WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;

    }

    public function updatePoll($id, $title, $options, $db){
        $sql = "Update polls
                set title = :title,
                options = :options,
                WHERE id = :id
        
        ";

        $pst =  $db->prepare($sql);

        $pst->bindParam(':title', $title);
        $pst->bindParam(':options', $options);
        $pst->bindParam(':id', $id);

        $count = $pst->execute();

        return $count;
    }
}