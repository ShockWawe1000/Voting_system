<?php
session_start();

include("config.php");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


$id = $_SESSION['id'];


$query = "SELECT id, name, surname FROM users WHERE id != '$id'";


try{
    $result = mysqli_query($con,$query) or die("Select Error");
}
catch(mysqli_sql_exception){
     output_error("Query error")  ;
}

if (mysqli_num_rows($result)>0){
$row = mysqli_fetch_assoc($result);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;  
    }
}

echo json_encode($users);  // Return the users as a JSON response

mysqli_close($con);  // Close the database connection
?>
