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
       <div class="main-box top">
          <div class="top">
                <div class="box" style="padding: 10px;">
                    <div>
                        <div class="user" style="background-image:url('src/pfp.jpg'); display: inline-block; vertical-align: middle;"></div>
                        <p style="display: inline-block; vertical-align:bottom; margin-left: 10px;">
                            Hello <b><?php echo $name ?></b> <b><?php echo $surname ?></b>, <br>Welcome</p>
                    </div>
                </div>

                <div>
                    <a href="vote.php"><button class="btn">Vote</button></a>
                </div>
          </div>

          <div class="bottom">
              <div class="box" style="flex-direction: row; justify-content:space-around;">
                    <div>
                        Makes Work Fun
                        <div id="workFunWinner"></div> 
                    </div>
                    <div>
                        Team Player
                        <div id="teamPlayerWinner"></div> 
                    </div>
                    <div>
                        Culture Champ
                        <div id="cultureChampWinner"></div> 
                    </div>
                    <div>
                        Difference Maker
                        <div id="diffMakerWinner"></div> 
                    </div>
              </div>
          </div>

          <div class="bottom">
              <div style="display: flex; flex-direction: row; justify-content:space-between;">
                    <div class="box" id="mostVoter">Most Voter</div>
                    <div class="box" id="latestVotes">Latest Votes</div>
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
                    handleResponse(response, '#cultureChampWinner'); 
                },
                error: function() {
                    $('#cultureChampWinner').html('No winner found yet!');
                }
            });

            $.ajax({
                url: 'php/getWinner_diff_maker.php', 
                type: 'GET',
                success: function(response) {
                    handleResponse(response, '#diffMakerWinner');
                    
                },
                error: function() {
                    $('#diffMakerWinner').html('Error fetching data');
                }
            });

           
            $.ajax({
                url: 'php/getWinner_work_fun.php',
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
    type: 'GET',
    success: function(response) {
        
        var votesData = JSON.parse(response);

       
        var tableHTML = `
            <table class="table">
                <thead>
                    <tr>
                        <th>Voter ID</th>
                        <th>Votee ID</th>
                        <th>Work Fun</th>
                        <th>Team Player</th>
                        <th>Culture Champ</th>
                        <th>Difference Maker</th>
                     
                    </tr>
                </thead>
                <tbody>
        `;

        
        votesData.forEach(function(entry) {
            tableHTML += `
                <tr>
                    <td>${entry.voter_id}</td>
                    <td>${entry.votee_id}</td>
                    <td>${entry.work_fun === "1" ? 'Yes' : 'No'}</td>
                    <td>${entry.team_player === "1" ? 'Yes' : 'No'}</td>
                    <td>${entry.culture_champ === "1" ? 'Yes' : 'No'}</td>
                    <td>${entry.diff_maker === "1" ? 'Yes' : 'No'}</td>
            
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
