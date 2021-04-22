<?php 
namespace PhPKnights\Model;

class Discussion {
    public function addThread($db, $title, $userId) {
        $query = "INSERT INTO threads
        (title, creation_date, last_post, last_post_user_id, user_id)
        VALUES (:title, NOW(), NOW(), :userId, :userId)";
        $pst = $db->prepare($query);
        $pst->bindParam(':title', $title);
        $pst->bindParam(':userId', $userId);
        
        // if added to db then return the last inserted id, else return 0;
        if ($pst->execute()) {
            $lastInsertId = $db->lastInsertId();
            return $lastInsertId;
        }
        return 0;
    }
    public function listThreads($db) {
        $query = "SELECT * FROM threads ORDER BY last_post DESC";
        $pst = $db->prepare($query);
        $pst->execute();
        return $pst->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getThread($db, $id) {
        $query = "SELECT * FROM threads WHERE id = :id";
        $pst = $db->prepare($query);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function updateThread($db, $id, $user_id) {
        $query = "UPDATE threads SET last_post = NOW(), last_post_user_id = :user_id WHERE id = :id";
        $pst = $db->prepare($query);
        $pst->bindParam(':id', $id);
        $pst->bindParam(':user_id', $user_id);
        $count = $pst->execute();
        return $count;
    }
}