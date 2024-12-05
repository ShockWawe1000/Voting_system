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
        </div>
</div>
<main>
     <div class="boxVote" style="background:#e1f1fd">
   
        <div id="userList" class="box_transparentUserList"></div>
        
        <div id="voteSection" >

                     <div class="voteBackButton">
                     <a href="home.php" class="btnBack">Back</a>
                    </div>
                    <div id="selectedUserInfo" class="box_transparentUserList">
                        <p>&lt; Select a user to endorse!</p>
                    </div>

                    
                        <div id="voteButtons" class="box_transparentUserList">
                            <div class="iconParent">
                                <div class="icon-button" id="voteButton1">
                                    <img class="voteIcon" src="src/end/makes_work_fun.png" alt="Work Fun" />
                                    
                                </div>
                                <span class="button-label">Makes Work Fun</span>
                            </div>
                            
                            <div class="iconParent" >
                                <div class="icon-button" id="voteButton2">
                                    <img class="voteIcon" src="src/end/team_player.png" alt="Team Player" />
                                    
                                </div> 
                                <span class="button-label">Team Player</span>
                            </div>
                            
                            <div class="iconParent" >
                                <div class="icon-button" id="voteButton3">
                                    <img class="voteIcon" src="src/end/culture_champ.png" alt="Culture Champion" />
                                </div>
                                <span class="button-label">Culture Champion</span>
                            </div>
                           

                            <div class="iconParent" >
                                <div class="icon-button" id="voteButton4">
                                    <img class="voteIcon" src="src/end/diff_maker.png" alt="Difference Maker" />
                                    
                                </div>
                                <span class="button-label">Difference Maker</span>
                            </div>
                        </div>
                    

                <div class="bottomVote box_transparentUserList">
                        <textarea name="commentField" id="commentField" placeholder="Leave a comment..." maxlength="500"></textarea>
                        <button id="endorseButton" disabled>Endorse</button>
                </div>
                    
        </div>


    </div>

</main>
<script>
$(document).ready(function() {
    // AJAX GET
    $.ajax({
        url: 'php/getUsers.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.length > 0) {
                var output = "";
                data.forEach(function(user) {
                    output += `<div class="userItem" data-id="${user.id}" data-name="${user.name}" data-surname="${user.surname}">
                                <img src="src/pfp.jpg" alt="${user.name}"> 
                                <span>${user.name} ${user.surname}</span>
                               </div>`;
                });
                $("#userList").html(output);
            } else {
                $("#userList").html("No users found.");
            }
        },
        error: function() {
            console.log("Error fetching user data.");
            $("#userList").html("Error fetching user data.");
        }
    });

  
    $(document).on('click', '.userItem', function() {
        $('.userItem').removeClass('selected');
        $(this).addClass('selected');
        $('#commentField').val('');
        $('.icon-button').removeClass('active');
        $('#endorseButton').prop('disabled', true);

        var userId = $(this).data('id');
        var userName = $(this).data('name');
        var userSurname = $(this).data('surname');

        $("#selectedUserInfo").html(`<p><strong>${userName} ${userSurname}</strong></p>
                                      <img class="pfpSelected" src="src/pfp.jpg" alt="${userName}"">`);

        $('#commentField').prop('disabled', false);
        $("#voteButtons").show();

        checkFormValidity();
    });

    
    $('.icon-button').on('click', function() {
        $(this).toggleClass('active');
        checkFormValidity();
    });


    function checkFormValidity() {
        var comment = $('#commentField').val().trim();
        var atLeastOneActive = $('.icon-button.active').length > 0;
        var atLeastOneUserSelected = $('.userItem.selected').length > 0;  


        if (comment.length > 0 && atLeastOneActive && atLeastOneUserSelected) {
            $('#endorseButton').prop('disabled', false);
        } else {
            $('#endorseButton').prop('disabled', true);
        }
    }

  
    $('#commentField').on('input', function() {
        checkFormValidity();
    });

    
    $('#endorseButton').on('click', function() {
        var selectedUserId = $(".userItem.selected").data('id'); 
        var comment = $('#commentField').val();

        var work_fun_temp = false;
        var culture_champ_temp = false;
        var team_player_temp = false;
        var diff_maker_temp = false;

        if ($('#voteButton1').hasClass('icon-button active')) {
            work_fun_temp = true;
        }
        if ($('#voteButton2').hasClass('icon-button active')) {
            team_player_temp = true;
        }
        if ($('#voteButton3').hasClass('icon-button active')) {
            culture_champ_temp = true;
        }
        if ($('#voteButton4').hasClass('icon-button active')) {
            diff_maker_temp = true;
        }

        $.ajax({
            url: 'php/submitVote.php',
            type: 'POST',
            data: {
               
                votee_id: selectedUserId,  

               
                work_fun: work_fun_temp, 
                team_player: team_player_temp,
                culture_champ: culture_champ_temp, 
                diff_maker: diff_maker_temp, 
                
                comment: comment  
            },
            success: function(response) {
                alert("Vote submitted successfully!");

                // Clear fields
                $('#commentField').val('');
                $('.icon-button').removeClass('active');
                $('#endorseButton').prop('disabled', true);
            },
            error: function() {
                alert("An error occurred while submitting your vote.");
            }
        });
    });
});
</script>

</body>
</html>
