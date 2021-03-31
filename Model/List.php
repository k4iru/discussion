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


}