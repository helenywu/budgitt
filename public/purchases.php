<?php

    // configuration
    require("../includes/config.php");
    
    // get current spending period and category id's for purchases
    $spending_period = CS50::query("SELECT curr_sp FROM users WHERE id = ?", $_SESSION["id"]);
    $category_ids = CS50::query("SELECT id, category FROM categories WHERE user_id = ? AND sp_id = ?", $_SESSION["id"], $spending_period[0]["curr_sp"]);
    $rows = [];
    
    // update "rows" array with items in each category
    foreach ($category_ids as $category_id)
    {
        $returns = CS50::query("SELECT * FROM items WHERE category_id = ?", $category_id["id"]);
        foreach ($returns as $return){
            array_push($rows, $return);
        }
    }
    
    // print out items in categories
    uasort($rows, function ($i, $j) 
    {
        $a = $i["spending_date"];
        $b = $j["spending_date"];
        if ($a == $b) return 0;
        else if ($a < $b) return 1;
        else return -1;
    });
    
    // if no purchases had been made
    if (!($rows))
    {
        apologize("No transactions made.");
    }
    
    // render history
    render("purchases_form.php", ["title" => "Purchases", "purchases" => $rows]);
?>