
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      google.load('visualization', '1', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
            // Create and populate the data table.
            var data = new google.visualization.DataTable();
            
            var raw_data = [
            <?php
require_once('test.class.php');
    
for($y=0;$y<5;$y++){
    set_time_limit(2400);
    
    $test = new test();
    
    for($i=0;$i<50;$i++){
        $mysqlA_time += $test->benchmarkMysqlA();
    }
    for($i=0;$i<50;$i++){
        $mysqlB_time += $test->benchmarkMysqlB();
    }
    for($i=0;$i<50;$i++){
        $mysqlC_time += $test->benchmarkMysqlC();
    }
    
    for($i=0;$i<50;$i++){
        $files_time += $test->benchmarkFiles('files/lista100k.txt');
    }
    $mysqlA[] = $mysqlA_time;
    $mysqlB[] = $mysqlB_time;
    $mysqlC[] = $mysqlC_time;
    $files[] = $files_time;
    
    $mysqlA_time = 0;
    $mysqlB_time = 0;
    $mysqlC_time = 0;
    $files_time = 0;
}

echo '[\'MysqlA\', '.$mysqlA[0].', '.$mysqlA[1].', '.$mysqlA[2].', '.$mysqlA[3].', '.$mysqlA[4].'],';
echo '[\'MysqlB\', '.$mysqlB[0].', '.$mysqlB[1].', '.$mysqlB[2].', '.$mysqlB[3].', '.$mysqlB[4].'],';
echo '[\'MysqlC\', '.$mysqlC[0].', '.$mysqlC[1].', '.$mysqlC[2].', '.$mysqlC[3].', '.$mysqlC[4].'],';
echo '[\'Files\', '.$files[0].', '.$files[1].', '.$files[2].', '.$files[3].', '.$files[4].']';
?>
                            ];
            
            var years = ['1st', '2nd', '3rd', '4th', '5th'];
                            
            data.addColumn('string', 'Time');
            for (var i = 0; i  < raw_data.length; ++i) {
              data.addColumn('number', raw_data[i][0]);    
            }
            
            data.addRows(years.length);
          
            for (var j = 0; j < years.length; ++j) {    
              data.setValue(j, 0, years[j].toString());    
            }
            for (var i = 0; i  < raw_data.length; ++i) {
              for (var j = 1; j  < raw_data[i].length; ++j) {
                data.setValue(j-1, i+1, raw_data[i][j]);    
              }
            }
            
            // Create and draw the visualization.
            new google.visualization.BarChart(document.getElementById('chart_div')).
                draw(data,
                     {title:"Time it takes to do 50 requests on a 10M line file",
                      width:600, height:400,
                      vAxis: {title: "Time"},
                      hAxis: {title: "Seconds"}}
                );
    }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>
