
<?php 
include('pop_up.php');

    $db_server="localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "db";
    $con = "";

try{
        $con= mysqli_connect(  $db_server, 
        $db_user ,
        $db_pass ,
        $db_name);
        

}
catch(mysqli_sql_exception){
    output_error("Could not connect <br>");   
}



?>