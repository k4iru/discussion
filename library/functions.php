<?php
function populateDropdown($options, $select = "")
{
  $html_dropdown = "";
  foreach ($options as $make) {
    $selected = $select == $make->make ? "selected" : "";
    $html_dropdown .= "<option $selected value='$make->id'>$make->make</option>";
  }

  return $html_dropdown;
}
