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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Home</title>
</head>
<body>
    <div class="nav">
          <img class="logo" src="src/logo-final.svg" alt="Logo" href="home.php"/>
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
            <a href="php/logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>

    <main>
     <div class="box" style="background: #e1f1fd; width:900px;">
       <div class="main-box top"  style=" display: flex; flex-direction: row; justify-content:space-between;">
          
                <div class="box_transparent" style="padding: 10px; ">
                    <div>
                        <div class="user" style="background-image:url('src/pfp.jpg'); display: inline-block; vertical-align: middle;"></div>
                        <p style="display: inline-block; vertical-align:middle; margin-left: 10px;">
                            Hello <span style="color:rgb(84, 178, 211); font-size:20px;"><b> <?php echo $name ?></b> <b><?php echo $surname ?></b> </span>, <br>Welcome</p>
                    </div>
                </div>

                
                    <a href="vote.php" style="display: inline-block; vertical-align:middle; margin-right: 10px;">
                        <button class="btn" style ="padding: 0px 40px; margin-top: 0px; display: inline-block; vertical-align:middle;">Vote</button>
                    </a>
                
          </div>

          <div class="bottom">
              <div class="box_transparentVotes" >
                    
                    <div class="box_transparent" style=" flex-direction:column;  align-items:center; width:188px; height:100%;">
                    <img src="src/win/makes_work_fun_winner.png" alt="cultureChampWinner" style=" width: 100px; height: 100px;   ">
                        Makes Work Fun
                        <div id="workFunWinner" class="textWinner" "></div> 
                    </div>
                    <div class="box_transparent" style=" flex-direction:column;  align-items:center; width:188px; height:100%;">
                    <img src="src/win/team_player_winner.png" alt="cultureChampWinner" style=" width: 100px; height: 100px; ">
                        Team Player
                        <div id="teamPlayerWinner"  class="textWinner" "></div> 
                    </div>
                    <div class="box_transparent" style=" flex-direction:column;  align-items:center; width:188px; height:100%;">
                    <img src="src/win/culture_champ_winner.png" alt="cultureChampWinner" style=" width: 100px; height: 100px; ">
                        Culture Champ
                        <div id="cultureChampWinner" class="textWinner"> >No Person Won this yet!</div> 
                    </div>
                    <div class="box_transparent" style=" flex-direction:column;  align-items:center; width:188px; height:100%;" >
                    <img src="src/win/diff_maker_winner.png" alt="cultureChampWinner" style=" width: 100px; height: 100px;  ">
                        Difference Maker
                        <div class="textWinner" id="diffMakerWinner"  >No Person Won this yet!</div> 
                    </div>
              </div>
          </div>

          <div class="bottom">
              <div style="display: flex; flex-direction: row; justify-content:space-between;">
                    <div class="box_transparent"style=" flex-direction:column;  align-items:center; width:250px; height: 250px; ">
                            <img src="src/win/winner.png" alt="cultureChampWinner" style=" width: 100px; height: 100px;  ">
                               
                            Most Active Voter
                            <div  id="mostVoter" class="textWinner" >No Person Won this yet!</div> 
                    </div>


                    <div class="box_transparent"  id="latestVotes" style="overflow:scroll; overflow-x: hidden; height:250px; margin-left: 35px; width:100%; ">No votes yet</div>
              </div>
          </div>
       </div>
       </div>
    </main>

   
 
    <script>
        $(document).ready(function() {

            function handleResponse(response, targetElement) {
        
        if (response.trim() === '' || response.trim() === 'null') {
            $(targetElement).html('No one got this yet');
        } else {
            
            var data = JSON.parse(response);
            
            
            var nameAndSurname = data.name + " " + data.surname;
            $(targetElement).html(nameAndSurname);
        }
    }

            $.ajax({
                url: 'php/getWinner_work_fun.php', 
                type: 'GET',
                success: function(response) {
                    handleResponse(response, '#workFunWinner');
                    
                },
                error: function() {
                    $('#workFunWinner').html('Error fetching data');
                }
            });

            $.ajax({
                url: 'php/getWinner_team_player.php', 
                type: 'GET',
                success: function(response) {
                    handleResponse(response, '#teamPlayerWinner'); 
                },
                error: function() {
                    $('#teamPlayerWinner').html('Error fetching data');
                }
            });

            $.ajax({
                url: 'php/getWinner_culture_champ.php', 
                type: 'GET',
                success: function(response) {
                    if(response==null)
                {
                    console.log("errpor");
                }
                else
                    handleResponse(response, '#cultureChampWinner'); 
                },
                error: function() {
                    $('#cultureChampWinner').html('No winner found yet!');
                }
            });

            $.ajax({
                url: 'php/getWinner_diff_maker.php', 
                type: 'POST',
                success: function(response) {
                    handleResponse(response, '#diffMakerWinner');
                    
                },
                error: function() {
                    $('#diffMakerWinner').html('Error fetching data');
                }
            });

           
            $.ajax({
                url: 'php/getMostOftenVoter.php',
                type: 'GET',
                success: function(response) {
                   handleResponse(response, '#mostVoter');
                },
                error: function() {
                    $('#mostVoter').html('Error fetching data');
                }
            });

           
            $.ajax({
    url: 'php/getlatestVotes.php', 
    type: 'POST',
    success: function(response) {
    var votesData = JSON.parse(response);

    var tableHTML = `
        <table >
       
            <tbody>
    `;

    votesData.forEach(function(entry) {
    tableHTML += `
        <tr class="table">
            <td>${entry.voter_name} ${entry.voter_surname}</td>
            <td>></td>
            <td>${entry.votee_name} ${entry.votee_surname}</td>
            <td class="">${entry.work_fun === "1" ? '<img class = "tableItems " src="src/end/makes_work_fun.png" alt="Work Fun" />' : ''}</td>
            <td>${entry.team_player === "1" ? '<img  class = "tableItems " src="src/end/team_player.png" alt="Team Player" />' : ''}</td>
            <td>${entry.culture_champ === "1" ? '<img class = "tableItems " src="src/end/culture_champ.png" alt="Culture Champ" />' : ''}</td>
            <td>${entry.diff_maker === "1" ? '<img  class = "tableItems " src="src/end/diff_maker.png" alt="Difference Maker" />' : ''}</td>
        </tr>
    `;
});


        
        tableHTML += `
                </tbody>
            </table>
        `;

       
        $('#latestVotes').html(tableHTML); 
    },
    error: function() {
        $('#latestVotes').html('Error fetching data');
    }
});


            
        });


        
    </script> 

</body>
</html>
