<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // render form
        render("settings_form.php", ["title" => "Settings"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // for different actions that the user chooses to do
        switch($_POST["options"]){
        
        // if user wants to add a new category
        case "new_cat":
            
            // save category name
            if (empty($_POST["new_cat"]))
            {
                apologize("Please enter a new category name.");
            }
            else 
            {
                $name = ucwords(strtolower($_POST["new_cat"]));
            }
            
            // save fields for later use
            $user = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
            $budget = $user[0]["total_budget"];
            $curr_period = $user[0]["curr_sp"];
            $result = CS50::query("SELECT * FROM categories WHERE user_id = ? AND category = ? AND sp_id = ?", $_SESSION["id"], $name, $curr_period);
    
            // check for incorrect entry conditions
            if ($result != false)
            {
                apologize("A category with the name ". $name . " already exists in this spending period.");
            }
            if (empty($_POST["target"]))
            {
                apologize("Please enter a spending target for " . $name);
            }
            if (!(is_numeric($_POST["target"])))
            {
                apologize("Please enter a numerical value for your spending target.");
            }
            else 
            {
                // insert new fields into categories in SQL
                CS50::query("INSERT IGNORE INTO categories (user_id, category, ideal_spending, actual_spending, sp_id) 
                VALUES(?, ?, ?, ?, ?)", $_SESSION["id"], $name, $_POST["target"], 0, $curr_period);

                // save the total budget for that category
                $budget += $_POST["target"];
                CS50::query("UPDATE users SET total_budget = ? WHERE id = ?", $budget, $_SESSION["id"]);
            }
        break;
        
        // edit the ideal spending for a category
        case "edit_category":
            
            // check for correct field entry
            if (!(is_numeric($_POST["cat_budget"])))
            {
                apologize("Please enter a numerical value for your category ideal spending change.");
            }
            else 
            {
                // save info for later use
                $user = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
                $budget = $user[0]["total_budget"];
                $curr_period = $user[0]["curr_sp"];
                $name = ucwords(strtolower($_POST["category_name"]));
                $category = CS50::query("SELECT ideal_spending FROM categories WHERE user_id = ? AND category = ? AND sp_id = ?", $_SESSION["id"], $name, $curr_period);
                
                // save the new spending target difference
                if ($category == false)
                {
                    apologize("You do not have a category named ". $name .".");
                }
                else 
                {
                    $cat_spending = $category[0]["ideal_spending"];
                }
                
                // conditions if the change is below or above the current target for that category
                switch($_POST["cat_options"])
                {
                    // if the user wants to increase the spending target
                    case "add_money":
                        $cat_spending += $_POST["cat_budget"];
                        $budget += $_POST["cat_budget"];
                    break;    
                    
                    // if the user wants to decrease the spending target
                    case "sub_money":
                        if ($cat_spending >= $_POST["cat_budget"]){
                            $cat_spending -= $_POST["cat_budget"];
                            $budget -= $_POST["cat_budget"];
                        }
                        else 
                        {
                            apologize("You cannot subtract $". $_POST["cat_budget"] . " from $" . $spending. ", which is the current ideal spending of " . $name . ".");
                        }
                    break;
                }
                
                // update information in categories and users in SQL
                CS50::query("UPDATE categories SET ideal_spending = ? WHERE user_id = ? AND category = ? AND sp_id = ?", $cat_spending, $_SESSION["id"], $name, $curr_period);
                CS50::query("UPDATE users SET total_budget = ? WHERE id = ?", $budget, $_SESSION["id"]);
            }
        break;
        
        // if the user wants to change alert options
        case "change_alerts":
            
            // convert alert options to ints
            // 0=none, 1=email
            
            // if no options selected
            if (!(isset($_POST["no_alerts"])) && !(isset($_POST["email_alerts"])))
            {
                apologize("You must select an option for changing your alerts.");
            }
            // if both options are selected
            if (isset($_POST["no_alerts"]) && isset($_POST["email_alerts"]))
            {
                apologize("Invalid selection.  Please try changing your alerts again.");
            }
            // save the new alert options (equivalent int values)
            $alert = 0;
            if (isset($_POST["email_alerts"]))
            {
                $alert += 1;
            }
            
            // update the users table with the changed alert options
            CS50::query("UPDATE users SET alert_options = ? WHERE id = ?", $alert, $_SESSION["id"]);
        break;
       }
       
       // return the user back to the homepage
       redirect("index.php");
    }
?>