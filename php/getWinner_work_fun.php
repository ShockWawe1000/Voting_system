<?php
session_start();

include("config.php");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


$id = $_SESSION['id'];


$query = "SELECT 
    votee_id,
    SUM(work_fun) AS work_fun_votes
FROM 
    votes_table
GROUP BY 
    votee_id
ORDER BY 
    work_fun_votes DESC
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

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;  
    }
}

echo json_encode($users);  

mysqli_close($con);  
?>
