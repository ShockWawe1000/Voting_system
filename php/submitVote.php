<?php

session_start();

include("config.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $voter_id =  $_SESSION['id'];
    $votee_id = $_POST['votee_id'];
    
    $work_fun = ($_POST['work_fun'] === 'true');
    $team_player = ($_POST['team_player'] === 'true');
    $culture_champ = ($_POST['culture_champ'] === 'true');
    $diff_maker = ($_POST['diff_maker'] === 'true');

    $comment = $_POST['comment']; 
    echo ($endorsement_flags);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


$id = $_SESSION['id'];


$query = "INSERT INTO endorsements (voter_id, votee_id, work_fun, team_player ,culture_champ, diff_maker, comment) 
            VALUES ('$voter_id ' , '$votee_id ' , '$work_fun ' ,'$team_player ' , '$culture_champ ' , '$diff_maker ' ,  '$comment ')";


try{
    $result = mysqli_query($con,$query) or die("Select Error");
}
catch(mysqli_sql_exception){
     output_error("Query error")  ;
}

}


mysqli_close($con);

?>
