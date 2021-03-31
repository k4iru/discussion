<?php

namespace HTTP-5202-GROUP\models;

class List
{
    public function getAllLists($dbcon){


        $sql = "SELECT * FROM lists";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $lists = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $lists;
    }


}