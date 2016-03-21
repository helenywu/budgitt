<?php

    // configuration
    require("../includes/config.php");
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        require("../includes/phpmailer/PHPMailerAutoload.php");
        
        // gets info from mySQL
        $query = CS50::query("SELECT alert_options, alert_sent, email, money_spent, total_budget, name, username FROM users WHERE id = ?", $_SESSION["id"]);
        $email = $query[0]["email"];
        $alert_sent = $query[0]["alert_sent"];
        $alert_options = $query[0]["alert_options"];
        $money_spent = $query[0]["money_spent"];
        $total_budget = $query[0]["total_budget"];
        $name = $query[0]["name"];
        $true = 0;
        
        // sends email
        if (($alert_options == 1) && ($alert_sent == 0) && ($money_spent > $total_budget))
        {
            
            $mail = new PHPMailer;
            
            //$mail->SMTPDebug = 3;                               // Enable verbose debug output
            
            // sender info
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'budgitt@gmail.com';                 // SMTP username
            $mail->Password = 'dalexdelendoy';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            
            // sendee info
            $mail->setFrom($email, 'Budgitt');
            $mail->addAddress($email, $name);     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            // $mail->isHTML(true);                                  // Set email format to HTML
            
            // email layout
            $mail->Subject = 'Spending Over Budget!';
            $mail->Body    = 'Hi ' . $name . '!  <br><br>Our services indicate that you are overspending by <b>$'.($money_spent - $total_budget).'</b>.  
            You can check this out on our website <a href="https://ide50-helenwu.cs50.io/">here</a>!  
            Thanks! <br><br>
            Love, <br><br>
            Budgitt <3
            <br><img src="http://wac.450f.edgecastcdn.net/80450F/hudsonvalleycountry.com/files/2015/01/cat4.jpg" alt="Cat" style="width:304px;height:228px;">';
            $mail->IsHTML(true);
            
            // checks if email is sent
            if(!$mail->send()) {
                
            }           
            else {
                
                // makes sure no more than one email is sent in each spending period
                CS50::query("UPDATE users SET alert_sent = 1 where id = ?", $_SESSION["id"]);
            }
        }
        
        // gets info from mySQL 
        $user = CS50::query("SELECT total_budget, spending_start, spending_end, curr_sp, money_spent FROM users WHERE id = ?", $_SESSION["id"]);
        $rows = CS50::query("SELECT category, ideal_spending, actual_spending FROM categories WHERE user_id = ? AND sp_id = ?", $_SESSION["id"], $user[0]["curr_sp"]);
        $start = $user[0]["spending_start"];
        $end = $user[0]["spending_end"];
        $money = $user[0]["money_spent"];
        
        // calculates remaining time in spending period
        $now = date("Y-m-d");
        $remaining = strtotime($end) - strtotime($now); 
        $remaining = floor($remaining/(60*60*24));
        
        $positions = [];
        
        // creates a table with current spending period info
        if ($rows !== false)
        {
            foreach($rows as $row)
            {
                $positions[] = 
                [
                    "category" => $row["category"],
                    "ideal_spending" => $row["ideal_spending"],
                    "actual_spending" => $row["actual_spending"]
                ];
            }
        }
        
        // render portfolio
        render("portfolio.php", ["title" => "Portfolio", "positions" => $positions, "budget" => $user[0]["total_budget"], "start" => $start, "end" => $end, "remaining" => $remaining, "money" => $money]);
        
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // check inputs in form
        if (empty($_POST["spending_period"]))
        {
            apologize("Please fill in all the fields.");
        }
        
        // checks for valid input
        if (!(is_numeric($_POST["spending_period"])))
        {
            apologize("Please enter a number for your new period length.");
        }
        
        $user = CS50::query("SELECT curr_sp FROM users WHERE id = ?", $_SESSION["id"]);
        
        $curr_sp = $user[0]["curr_sp"];
        $curr_sp++;
        
        $start = date("Y/m/d");
        $end = date("Y/m/d", strtotime("+". intval($_POST["spending_period"]) . " days"));
        
        // update users
        $user_update = CS50::query("UPDATE users SET spending_start = ?, spending_end = ?, 
        period_length = ?, curr_sp = ?, total_budget = 0, alert_sent = ?, money_spent = 0 
        where id = ?", $start, $end, $_POST["spending_period"], $curr_sp, false, $_SESSION["id"]); 
        if ($user_update === false)
        {
            apologize("Error adding item to database.");
        }

        // go back to index to show updated table
        redirect("index.php");
    }
?>