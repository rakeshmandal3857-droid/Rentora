<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'rentora';
    $conn ="";

    try{
        $conn = mysqli_connect($host, $username, $password, $database);
    }catch(mysqli_sql_exception){
        echo "DataBase Connection Failed. <br>" ;
    }

    function clean($data){
        return htmlspecialchars(strip_tags(trim($data)));
    }
    function formatNumber($num) {
        if ($num >= 1000000000) return round($num / 1000000000, 1).'B+';
        if ($num >= 1000000) return round($num / 1000000, 1).'M+';
        if ($num >= 1000) return round($num / 1000, 1).'K+';
        return $num;
    }
?>