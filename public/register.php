<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // conditions if form fields not entered correctly
        if (empty($_POST["name"]))
        {
            apologize("Please enter a name.");
        }
        else if (empty($_POST["username"]))
        {
            apologize("Please enter a username.");
        }
        else if (empty($_POST["password"] || $_POST["confirmation"]))
        {
            apologize("You must enter a password/confirmation.");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Your password and confirmation don't match.");
        }
        else if (empty($_POST["period_length"]) || $_POST["period_length"] > 
        999 || $_POST["period_length"] < 1)
        {
            apologize("Please enter a valid spending period (length in days).");
        }
        else if (empty($_POST["email"]) || (strpos($_POST["email"],'@') == false))
        {
            apologize("Please enter an email address.");
        }
        
        // username taken
        $result = CS50::query("SELECT * FROM users WHERE username = ?", $_POST["username"]);
        if ($result != false)
        {
            apologize("That username is already taken.");
        }
        // else register user and automatically login after successful registration
        else
        {
            // convert alert option to ints
            // 0=none, 1=email
            $alert = 0;
            if (isset($_POST["email_alerts"]))
            {
                $alert += 1;
            }
            
            // calculate start and end dates
            $start = date("Y/m/d");
            $end = date("Y/m/d", strtotime("+". intval($_POST["period_length"]) . " days"));
            
            // insert fields into users in SQL
            CS50::query("INSERT IGNORE INTO users (name, username, hash, 
            total_budget, spending_start, spending_end, email, alert_options, curr_sp, period_length) 
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, 1, ?)", $_POST["name"], $_POST["username"], 
            password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["total_budget"], $start, $end,
            $_POST["email"], $alert, $_POST["period_length"]);
            
            // save user id for automatic login
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"];
            
            // return to homepage
            redirect("index.php");
        }
    }
?>