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
?>