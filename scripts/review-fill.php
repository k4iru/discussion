<?php

//Fill select function to populate MOVIE dropdown from top 250 movies table when user creates a review OR updates a review.
function fillSelect($options, $select = "")
{

    $html_dropdown = "";
    foreach ($options as $title) {
        $selected = $select == $title->title ? "selected" : "";
        $html_dropdown .= "<option $selected value='$title->title'>$title->title</option>";
    }
    return $html_dropdown;
}