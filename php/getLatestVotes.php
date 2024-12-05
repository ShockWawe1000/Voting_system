<?php
session_start();

include("config.php");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
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
          ORDER BY e.timestamp DESC";

try {
    $result = mysqli_query($con, $query);
    if (!$result) {
        throw new Exception("Query error: " . mysqli_error($con));
    }
} catch (Exception $e) {
    die(json_encode(["error" => $e->getMessage()]));
}


$data = [];


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}


echo json_encode($data);


mysqli_close($con);
?>
