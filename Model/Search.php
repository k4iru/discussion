<?php
namespace PhPKnights\Model;

class Search
{

//SEARCH
    public function SearchTop250Movies($dbcon)
    {

        $key = trim($_GET["search"]);
        //search query
        $query = "SELECT * FROM top250Movies WHERE `title` LIKE '%$key%'";
        $pdostm = $dbcon->prepare($query);
        $pdostm->execute();

        $searchResults = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $searchResults;
    }

}