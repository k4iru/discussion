<?php
namespace PhPKnights\Model;

class Polls
{
    public function getOptions($db){
        $query = "SELECT * FROM poll_answers ";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    public function getOptionsforPoll($db, $poll_id){
        $query = "SELECT * FROM poll_answers WHERE poll_id = :id";
        $pdostm = $db->prepare($query);
        $pst->bindParam(':id', $poll_id);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    
    public function getPollById($id, $db){
        $sql = "SELECT poll_answers.options, polls.id, polls.title FROM polls, poll_answers where polls.id = poll_answers.poll_id AND polls.id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }
    public function getAllPolls($db){

        $sql = "SELECT p.*, GROUP_CONCAT(pa.options ORDER BY pa.id) AS options FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id GROUP BY p.id";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();

        $polls = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $polls;
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
        //$sql = "DELETE FROM polls WHERE id = :id";
        $sql = "DELETE FROM polls WHERE id = :id; DELETE FROM poll_answers WHERE poll_id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;

    }

    public function updatePoll($db, $id, $title, $options){
        $sql = "UPDATE polls SET title = :title, options = :options WHERE id = :id";

        $pst =  $db->prepare($sql);

        $pst->bindParam(':id', $id);
        $pst->bindParam(':title', $title);
        $pst->bindParam(':options', $options);        

        $count = $pst->execute();

        return $count;
    }
}