

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Endorse</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
       
    </style>
</head>
<body>
<div class="nav">
    <img class="logo" src="src/logo-final.svg" alt="Logo" href="home.php"/>
    <div class="right-links">
        <a href="php/logout.php"><button class="btn">Log Out</button></a>
    </div>
</div>

<main>
    <div class="boxVote" style="background:#e1f1fd; height: 300px;">
        
        <div id="voteSection">
       <div class="textWinner" style="margin-bottom:20px;">Download your Certificate</div> 
            <form action="" method="POST">
                <div id="voteButtons" class="box_transparentUserList" style = "width: 560px;">
                    <div class="iconParent">
                        <button type="submit" name="vote" value="work_fun" class="icon-button" id="voteButton1">
                            <img class="voteIcon" src="src/end/makes_work_fun.png" alt="Work Fun" />
                        </button>
                        <span class="button-label">Makes Work Fun</span>
                    </div>
                    
                    <div class="iconParent">
                        <button type="submit" name="vote" value="team_player" class="icon-button" id="voteButton2">
                            <img class="voteIcon" src="src/end/team_player.png" alt="Team Player" />
                        </button> 
                        <span class="button-label">Team Player</span>
                    </div>
                    
                    <div class="iconParent">
                        <button type="submit" name="vote" value="culture_champ" class="icon-button" id="voteButton3">
                            <img class="voteIcon" src="src/end/culture_champ.png" alt="Culture Champion" />
                        </button>
                        <span class="button-label">Culture Champion</span>
                    </div>

                    <div class="iconParent">
                        <button type="submit" name="vote" value="difference_maker" class="icon-button" id="voteButton4">
                            <img class="voteIcon" src="src/end/diff_maker.png" alt="Difference Maker" />
                        </button>
                        <span class="button-label">Difference Maker</span>
                    </div>
                </div>
            </form>

            <div class="voteBackButton" style="justify-content:center;">
                <a href="home.php" class="btnBack" style="margin-top:20px;">Back</a>
            </div>
        </div>
    </div>
</main>

<?php
 
 session_start();
   include("php/config.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Call the corresponding PHP function based on the value of 'vote'
        if (isset($_POST['vote'])) {

            $query=null;
            $name = null;
            $surname = null;
            $endorsementWinner=null;

            $voteType = $_POST['vote'];





            switch ($voteType) {
                case 'work_fun':
                            $query = "SELECT u.name, u.surname
                            FROM endorsements e
                            JOIN users u ON e.votee_id = u.id
                            WHERE e.work_fun = 1
                            GROUP BY e.votee_id
                            ORDER BY COUNT(e.votee_id) DESC
                            LIMIT 1;";
                            $endorsementWinner="Makes Work Fun Person";
                    break;

                case 'team_player':
                    $query = "SELECT u.name, u.surname
                    FROM endorsements e
                    JOIN users u ON e.votee_id = u.id
                    WHERE e.team_player = 1
                    GROUP BY e.votee_id
                    ORDER BY COUNT(e.votee_id) DESC
                    LIMIT 1;";
                    $endorsementWinner="Team Player";
                break;


                case 'culture_champ':
                    $query = "SELECT u.name, u.surname
                    FROM endorsements e
                    JOIN users u ON e.votee_id = u.id
                    WHERE e.culture_champ = 1
                    GROUP BY e.votee_id
                    ORDER BY COUNT(e.votee_id) DESC
                    LIMIT 1;";
                    $endorsementWinner="Culture Champ";
                break;

                case 'difference_maker':
                    $query = "SELECT u.name, u.surname
                    FROM endorsements e
                    JOIN users u ON e.votee_id = u.id
                    WHERE e.diff_maker = 1
                    GROUP BY e.votee_id
                    ORDER BY COUNT(e.votee_id) DESC
                    LIMIT 1; ";
                    $endorsementWinner="Difference Maker";
                break;

                default:
                    echo "Invalid vote.";
            }

            $runQuery = mysqli_query($con, $query);

            if (!$runQuery) {
                die("Query failed: " . mysqli_error($con));
            }

            while($result = mysqli_fetch_assoc($runQuery)){
                
                $name = $result['name'];
                $surname = $result['surname'];
            }

            
            $_SESSION["certName"] = "{$name} {$surname}";
            $_SESSION["certEnd"] = $endorsementWinner;
          
            header("Location: php/printCertificates.php");
           
        }
    }
   



?>

</body>
</html>
