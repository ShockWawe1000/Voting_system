<?php
session_start();

include("config.php");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


$id = $_SESSION['id'];


$query = "SELECT 
    e.id AS endorsement_id,
    u1.name AS voter_name,
    u1.surname AS voter_surname,
    u2.name AS votee_name,
    u2.surname AS votee_surname,
    e.work_fun,
    e.team_player,
    e.culture_champ,
    e.diff_maker,
    e.comment,
    e.timestamp
FROM endorsements e
JOIN users u1 ON e.voter_id = u1.id
JOIN users u2 ON e.votee_id = u2.id
ORDER BY e.timestamp DESC
LIMIT 15;
";


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
        $data[] = $row;  
    }
}

echo json_encode($data);  

mysqli_close($con);  
?>
