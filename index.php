<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
</head>
<body>
<?php        

             include("php/config.php");
             if($_SERVER["REQUEST_METHOD"] == "POST"){
                $username = filter_input(INPUT_POST , "username" , FILTER_SANITIZE_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST , "password" , FILTER_SANITIZE_SPECIAL_CHARS);


             
               $result = null;
               try{
                     $result = mysqli_query($con,"SELECT * FROM users WHERE username='$username' AND password='$password' ") or die("Select Error");
    
              }
               catch(mysqli_sql_exception){
                      output_error("Query error")  ;
               }
             if (mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
             }
              
              
               

               if( !empty($row)){
                $_SESSION['id']=$row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['username'] = $row['username'];
                output_error("seucses");
               }
               else{
                output_error("Wrong Username or Password");
               }
               if(isset($_SESSION['username'])){
                   header("Location: home.php");
               }
             }else{

           
           ?>
      <div class="container">
        <div class="box form-box">

            <header>Login</header>
            <form action= "<?php htmlspecialchars($_SERVER["PHP_SELF"])  ?>" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Make an account first! <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        
      </div>

        <?php 
             }
        ?>
</body>
</html>