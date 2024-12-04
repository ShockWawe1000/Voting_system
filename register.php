<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
<?php 
         
         include("php/config.php");
         if($_SERVER["REQUEST_METHOD"] == "POST"){

            $name = filter_input(INPUT_POST , "name" , FILTER_SANITIZE_SPECIAL_CHARS);
            $surname = filter_input(INPUT_POST , "surname" , FILTER_SANITIZE_SPECIAL_CHARS);
            $username = filter_input(INPUT_POST , "username" , FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST , "password" , FILTER_SANITIZE_SPECIAL_CHARS);
            
            //          ISSUE:
            //          <>/ special chars can and will break code

         //here we get the data from the html form, filtering any malicious content
         // instead of filter i need to remove any and all special characters, make errors with JSON parsing

            if(empty($name) || empty($surname) ||empty($username) ||empty($password))
            {
                //bug, need to sort out why this  code  triggers without this if all fields are not set
            }

            else{
             //   $hash= password_hash($password, PASSWORD_DEFAULT);
             //   easy to implement, but no time and not that important
                $verify_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");

                if(mysqli_num_rows($verify_query) !=0 ){
                    output_error("This username is taken!")  ;
                }
                else{

                    mysqli_query($con,"INSERT INTO users(name,surname,username,password) VALUES('$name','$surname','$username','$password')") or die("Error Occured");

                    output_success("Registration Sucsess");
                

                }
        }
         }else{
         
        ?>
      <div class="container">
        <div class="box form-box">


            <header>Sign Up</header>
            <form action= "<?php htmlspecialchars($_SERVER["PHP_SELF"])  ?>" method="post">

            <div class="field input">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" id="surname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a employee? <a href="index.php">Sign In</a>
                </div>
            </form>
        </div>
     
      </div>
      <?php } ?>
</body>
</html>