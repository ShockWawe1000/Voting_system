<?php
session_start();

include("config.php");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


$id = $_SESSION['id'];


$query = "SELECT u.name, u.surname
            FROM endorsements e
            JOIN users u ON e.votee_id = u.id
            WHERE e.diff_maker = 1
            GROUP BY e.votee_id
            ORDER BY COUNT(e.votee_id) DESC
            LIMIT 1;
            ";


try{
    $result = mysqli_query($con,$query) or die("Select Error");
}
catch(mysqli_sql_exception){
     output_error("Query error")  ;
}
$row = mysqli_fetch_assoc($result);

if (empty($row))
{
    $row = array(     
            'name '=> 'There isnt a winner yet!',
            'surname' => ''
  
    );
    echo json_encode($row);  
}
else
echo json_encode($row);  

mysqli_close($con);  
?>
