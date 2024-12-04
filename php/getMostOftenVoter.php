<?php
session_start();

include("config.php");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


$id = $_SESSION['id'];


$query = "SELECT  name, surname
            FROM endorsements e
            JOIN users u ON e.voter_id = u.id
            GROUP BY e.voter_id
            ORDER BY COUNT(e.voter_id) DESC
            LIMIT 1;";


try{
    $result = mysqli_query($con,$query) or die("Select Error");
}
catch(mysqli_sql_exception){
     output_error("Query error")  ;
}

if (mysqli_num_rows($result)>0){
$row = mysqli_fetch_assoc($result);
}


echo json_encode($row);  

mysqli_close($con);  
?>
