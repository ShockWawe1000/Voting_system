<?php
session_start();

include("config.php");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['id'];

$query = "SELECT id, name, surname FROM users WHERE id != '$id' ORDER BY name ASC";

try {
    $result = mysqli_query($con, $query);
    if (!$result) {
        throw new Exception("Query error: " . mysqli_error($con));
    }
} catch (Exception $e) {
    die(json_encode(["error" => $e->getMessage()]));
}


$users = [];


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}


echo json_encode($users);


mysqli_close($con);
?>
