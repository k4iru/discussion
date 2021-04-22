<?php

namespace PhPKnights\Model;

class Post
{
    public function addPost($db, $content, $threadId, $userId)
    {
        $query = "INSERT INTO posts
        (creation_date, comment, thread_id, user_id)
        VALUES (NOW(), :content, :threadId, :userId)";
        $pst = $db->prepare($query);
        $pst->bindParam(':content', $content);
        $pst->bindParam(':threadId', $threadId);
        $pst->bindParam(':userId', $userId);

        return $pst->execute();
    }
    public function getPosts($db, $threadId)
    {
        $query = "SELECT * FROM posts WHERE thread_id = :thread_id ORDER BY creation_date ASC";
        $pst = $db->prepare($query);
        $pst->bindParam(':thread_id', $threadId);
        $pst->execute();

        return $pst->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getThreadPostCount($db, $threadId)
    {
        $query = "SELECT COUNT(*) AS count FROM posts WHERE thread_id = :thread_id";
        $pst = $db->prepare($query);
        $pst->bindParam(':thread_id', $threadId);
        $pst->execute();

        return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function getUserPostCount($db, $user_id)
    {
        $query = "SELECT COUNT(*) AS count FROM posts WHERE user_id = :user_id";
        $pst = $db->prepare($query);
        $pst->bindParam(':user_id', $user_id);
        $pst->execute();

        return $pst->fetch(\PDO::FETCH_OBJ);
    }
}
