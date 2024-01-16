<?php

use function Symfony\Component\String\b;

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "tujupus";
    
    $connect = mysqli_connect($host, $username, $password, $database);
    $query = "SELECT 'hotelRoomID','roomNumber', 'outletName', 'maxOccupancy', 'roomType', 'roomPrice', 'breakfastincluded', 'roomStatus', 'image' FROM hotelroom";
    $resultset = mysqli_query($connect, $query);
    $json_array = array();
    while($row = mysqli_fetch_assoc($resultset))
    {
        $json_array[] = $row;
    }
    echo "<pre>";
    print_r($json_array);
    echo"</pre>";
?>