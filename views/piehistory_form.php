<!doctype html>
<html>
<head>
    <title>Pie Chart Demo (LibChart)- http://codeofaninja.com/</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
 
<?php
    // include the library
    require("../includes/libchart/libchart/classes/libchart.php");
    
    $spending_period = CS50::query("SELECT curr_sp FROM users WHERE id = ?",$_SESSION["id"]);
 
    for ($i = 1; $i <= $spending_period[0]["curr_sp"]; $i = $i + 1)
    {
        // new pie chart instance
        $chart = new PieChart( 500, 300 );
     
        //data set instance
        $dataSet = new XYDataSet();
        
        // actual data
        // get data from the database
        // query all records from the database
        $rows = CS50::query("SELECT * FROM categories WHERE user_id = ? AND sp_id = ?", $_SESSION["id"], $i);
     
        // get number of rows returned
        $num_rows = count($rows);
        
        $total_actual_spending = 0;
        $total_ideal_spending = 0;
     
        if( $num_rows > 0)
        {
        
            foreach($rows as $row)
            {
                extract($row);
                $dataSet->addPoint(new Point("{$category} {$actual_spending})", $actual_spending));
                $total_actual_spending += $actual_spending;
                $total_ideal_spending += $ideal_spending;
            }
        
            // finalize dataset
            $chart->setDataSet($dataSet);
     
            // set chart title
            $chart->setTitle("History");
            
            // render as an image and store under "img" folder
            $chart->render("../public/img/" . $i . ".png");
            
            echo "<strong>Spending Period " . $i . "</strong><br>";
        
            // pull the generated chart where it was stored
            echo "<img src='/img/" . $i . ".png' alt='Pie chart' style='border: 1px solid gray;'/>" . "<br>";
            
            // print comparison between actual spending and ideal spending in the spending period
            echo "Total Actual Spending: $" . $total_actual_spending . " vs. ";
            echo "Total Ideal Spending: $" . $total_ideal_spending . "<br>";
            echo "<hr>";
        
        // http://pngimg.com/upload/ice_cream_PNG5097.png
        // ~/finproj/generated/1.png
        }
    }
?>
 
</body>
</html>