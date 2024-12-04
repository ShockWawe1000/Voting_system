<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
          <img class= "logo" src = "src/logo-final.svg" alt="Logo" href="home.php"/>
        <div class="right-links">

            <?php 
            
                    $id = $_SESSION['id'];
                      $query = mysqli_query($con, "SELECT * FROM users WHERE id=$id");

                         if (!$query) {
                             die("Query failed: " . mysqli_error($con));
                         }
                         
                        while($result = mysqli_fetch_assoc($query)){
                            $username = $result['username'];
                            $name = $result['name'];
                            $surname = $result['surname'];
                            $id = $result['id'];
                        }

                        ?>

                        <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box" style="padding: 10px";>
                <div>
                      <div class="user" style="background-image:url('src/pfp.jpg'); display: inline-block; vertical-align: middle;"></div>
                      <p style="display: inline-block; vertical-align:bottom; margin-left: 10px;">
                        Hello <b><?php echo $name ?></b> <b><?php echo $surname ?></b>, <br>Welcome</p>
                 </div>
            </div>


            <div >
                <a href="vote.php"> <button class="btn">Vote</button> </a>
            <div>
            
                

                </div>
             </div>
          </div>
<div class="bottom">
     <div class="box">
               
     </div>
          </div>
       </div>

    </main>
</body>
</html>