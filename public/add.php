<?php

    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("add_form.php", ["title" => "Add Item"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // check inputs in form
        if (empty($_POST["object"]) || empty($_POST["category"]) || empty($_POST["spent"]) || empty($_POST["date"]))
        {
            apologize("Please completely fill in the form.");
        }
        
        // checks for valid input
        if (is_numeric($_POST["object"]) || is_numeric($_POST["category"]))
        {
            apologize("Please enter a word for the object and/or category.");
        }
        
        // enters standard format for category names into SQL
        $category = ucwords(strtolower($_POST["category"]));
        
        // checking various conditions (category DNE, date or spent formats wrong)
        
        $sp_id = CS50::query("SELECT curr_sp FROM users WHERE id = ?", $_SESSION["id"]);
        $cat = CS50::query("SELECT category FROM categories WHERE user_id = ? AND category = ? AND sp_id = ?", $_SESSION["id"], $category, $sp_id[0]["curr_sp"]);
        if ($cat == false)
        {
            apologize("The category you entered is not defined.");
        }
        if (!is_numeric($_POST["spent"])) 
        {
            apologize("Please enter the amount spent in the format --.--");
        }
        if (!is_numeric($_POST["date"][0]) || !is_numeric($_POST["date"][1]) ||
        !is_numeric($_POST["date"][2]) || !is_numeric($_POST["date"][3]) || $_POST["date"][4] != '-' ||
        !is_numeric($_POST["date"][5]) || !is_numeric($_POST["date"][6]) || $_POST["date"][7] != '-' ||
        !is_numeric($_POST["date"][8]) || !is_numeric($_POST["date"][9]))
        {
            apologize("Please enter the date of purchase in the format YYYY-MM-DD.");
        }
        
        // insert items into database
        $formatted_spent = number_format($_POST["spent"], 2, '.', '');
        $spending_period = CS50::query("SELECT curr_sp FROM users WHERE id = ?", $_SESSION["id"]);

        // update items in SQL
        $category_id = CS50::query("SELECT id FROM categories WHERE category = ? AND sp_id = ? AND user_id = ?", 
        $_POST["category"], $spending_period[0]["curr_sp"], $_SESSION["id"]);
        $items = CS50::query("INSERT INTO items (category_id, item, money_spent, spending_date) VALUES 
        (?, ?, ?, ?)", $category_id[0]["id"], $_POST["object"], $formatted_spent, $_POST["date"]);
        if ($insert === false)
        {
            apologize("Error adding item to database.");
        }
        
        // update categories in SQL
        $update = CS50::query("UPDATE categories SET actual_spending = actual_spending + ? where category = ? 
        AND user_id = ? AND sp_id = ?", $formatted_spent, $_POST["category"], $_SESSION["id"], $spending_period[0]["curr_sp"]);
        if ($update === false)
        {
            apologize("Error adding item to database.");
        }
        
        // update users in SQL
        $user_update = CS50::query("UPDATE users SET money_spent = money_spent + ? where id = ? 
        AND curr_sp = ?", $formatted_spent, $_SESSION["id"], $spending_period[0]["curr_sp"]);
        if ($user_update === false)
        {
            apologize("Error adding item to database.");
        }

        // go back to index to show updated table
        redirect("/");
    }

?>
