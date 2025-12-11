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
?>