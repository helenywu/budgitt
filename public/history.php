<?php

    // configuration
    require("../includes/config.php");
    
    // save fields for later use
    $user = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    $curr_sp = $user[0]["curr_sp"];
    $actual_sp = $user[0]["money_spent"];
    
    // initialize variables for storage
    $categories = array();
    $actual_spending = array();
    $markers = array();
    
    // save categories and actual spending to be able to display in pie chart
    for ($i = 1; $i < $curr_sp; $i++)
    {
        $rows = CS50::query("SELECT * FROM categories WHERE user_id = ? AND sp_id = ?", $_SESSION["id"], $i);
        $actual_total = 0;
        foreach ($rows as $row)
        {
            array_push($categories,$row["category"]);
            array_push($actual_spending,$row["actual_spending"]);
        }
        $markers[$i - 1] = sizeof($rows);
    }
    $markers[0] = 1;
    $markers[1] = 3;
    
    // render history
    render("piehistory_form.php", ["title" => "History", "count" => $curr_sp - 1, "actual_spending" => $actual_spending, 
    "categories" => $categories, "markers" => $markers]);
?>