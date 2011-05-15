<?php
class test
{
    public function benchmarkMysqlA(){
        //Standard
        $time_start = $this->microtime_float();
        
        mysql_connect('localhost','root','');
        mysql_selectdb('lista');
        $num = rand(0,255);
        $query = 'select num from lista where num = '.$num.' and timestamp > from_unixtime('.mktime(0, 0, 0, date('m'), date('d')-1, date('Y')).')';
        $result = mysql_query($query);
        $i = -1;
        while($row = mysql_fetch_row($result)){
            $i++;
        }
        mysql_close();
        
        $time_end = $this->microtime_float();
        $time = $time_end - $time_start;
        
        return $time;                                                              

    }
    
    public function benchmarkMysqlB(){
        //Lets the database do the work
         $time_start = $this->microtime_float();
         
         
        mysql_connect('localhost','root','');
        mysql_selectdb('lista');
        $num = rand(0,255);
        $query = 'select count(*) from lista where num = '.$num.' and timestamp > from_unixtime('.mktime(0, 0, 0, date('m'), date('d')-1, date('Y')).')';
        $result = mysql_query($query);
        $row = mysql_fetch_row($result);
        mysql_close();
        
        $time_end = $this->microtime_float();
        $time = $time_end - $time_start;
        
        return $time;   
    }
    
    public function benchmarkMysqlC(){
        //Speed of mysql_num_rows
         $time_start = $this->microtime_float();
         
        mysql_connect('localhost','root','');
        mysql_selectdb('lista');
        $num = rand(0,255);
        $query = 'select num from lista where num = '.$num.' and timestamp > from_unixtime('.mktime(0, 0, 0, date('m'), date('d')-1, date('Y')).')';
        $result = mysql_query($query);
        $i = mysql_numrows($result);
        mysql_close();
        
        $time_end = $this->microtime_float();
        $time = $time_end - $time_start;
        
        return $time;   
    }
    
    public function benchmarkFiles($file){
        // $file se deberia borrar cada noche mediante cron
         $time_start = $this->microtime_float();
        
        $lines = file($file);
        $num = rand(0,255);
        $i = 0;
        foreach($lines as $line){
            if($line == $num) $i++;
        }
        
        $time_end = $this->microtime_float();
        $time = $time_end - $time_start;
        
        return $time;   
        
    }
    
    
    public function scaffoldMysql($file){
        mysql_connect('localhost','root','');
        mysql_selectdb('lista');
        
        $lines = file($file);
        foreach($lines as $line){
            $query2 = 'insert into lista (num) values  ('.$line.');';
            $result2 = mysql_query($query2);
            if(!$result2) die('why do I have to die?');
        }
        
        echo 'Scaffolding of '.$file.' Mysql complete!';
        
    }
    
    private function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }


   
}
?>