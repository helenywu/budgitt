<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script type="text/javascript">
    
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart()
      {
        /*global table*/
        $(document).ready(function(){

        var actual_spending = <?php echo '["' . implode('", "', $actual_spending) . '"]' ?>;
        var categories = <?php echo '["' . implode('", "', $categories) . '"]' ?>;

        //var table = '<?php echo json_encode($actual_spending); ?>';
      
      <?php 
      $value = array_values($categories);
      $i = 0;
      echo 'alert(';
      echo 'categories['.$i.']';
      echo ');';
      ?>

        // console.log(table);

        
        var count = '<?php print($count); ?>';
        
        var datas = [];
        var optionss = [];
        var charts = [];
       
       
        for (var i = 0; i < count; i++)
        {
      
            var data = google.visualization.arrayToDataTable([
              ['Task', 'Hours per Day'],
            <?php
         
            for ($a = 0; $a <= $markers[0]; $a++)
            {
              echo '[categories['.$a.'], Number(actual_spending['.$a.'])], ';
            }
            ?>
          ]);
          datas.push(data);
        
        var options = {
          title: 'My Daily Activities'
        };
        optionss.push(options);t
      
        var string = "piechart" + i;
        var chart = new google.visualization.PieChart(document.getElementById(string));
        charts.push(chart);

        charts[i].draw(datas[i], optionss[i]);
      }
      
        });
      }
    </script>
  </head>
  <body>
    <?php 
    for ($i = 0; $i < $count; $i++)
    {
      print('<div id="piechart' . $i . '" style="width: 900px; height: 500px;"></div>');
    }
    ?>
  </body>
</html>