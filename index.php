<?php 
require_once('test.class.php');
//ini_set("memory_limit","10000M");
    
for($y=0;$y<5;$y++){
    //set_time_limit(2400);
    
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
echo '<pre>';
print_r($mysqlA);
print_r($mysqlB);
print_r($mysqlC);
print_r($files);
echo '</pre>'