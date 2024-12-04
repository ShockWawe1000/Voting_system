<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Endorse</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        *{
            border: 2px solid red;
            border-radius: 5px;
            align-items: center;
        }
        #container {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            align-self: center;
            border: 2px solid seagreen;
            max-width: 1000px;
        }
        #userList {
            width: 40%;
            max-height: 500px;
            overflow-y: scroll;
            border-right: 2px solid #ccc;
        }
        .userItem {
            display: flex;
            align-items: center;
            margin: 10px;
            cursor: pointer;
        }
        .userItem img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        #voteSection {
            width: 55%;
            padding: 20px;
            border-left: 2px solid #ccc;
        }
        #voteSection h2 {
            margin-top: 0;
        }
        /* Icon button styling */
        .icon-button {
            width: 70px;
            height: 70px;
            display: inline-block;
            background-color: #ddd;
            border-radius: 50%;
            text-align: center;
            line-height: 70px;
            cursor: pointer;
            margin-right: 20px;
            transition: background-color 0.3s ease;
        }
        .icon-button.active {
            background-color: #4CAF50; /* Active state color */
        }
        .icon-button:hover {
            background-color: #888;
        }
        /* Text below each button */
        .button-label {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }
        /* Comment field styling */
        #commentField {
            width: 100%;
            height: 100px;
            margin-top: 20px;
            padding: 10px;
            font-size: 16px;
        }
        /* Endorse button styling */
        #endorseButton {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        #endorseButton:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<div class="box">
    <div id="container">
        <div id="userList"></div>
        <div id="voteSection">
            <div id="selectedUserInfo">
                <p>No user selected yet.</p>
            </div>

            <div id="voteButtons">
                <div class="icon-button" id="voteButton1">
                    👍
                    <span class="button-label">Makes Work Fun</span>
                </div>
                <div class="icon-button" id="voteButton2">
                    👎
                    <span class="button-label">Team Player</span>
                </div>
                <div class="icon-button" id="voteButton3">
                    ❤️
                    <span class="button-label">Culture Champion</span>
                </div>
                <div class="icon-button" id="voteButton4">
                    🔥
                    <span class="button-label">Difference Maker</span>
                </div>
            </div>

            <textarea id="commentField" placeholder="Leave a comment..." maxlength="500"></textarea>
            <button id="endorseButton" disabled>Endorse</button>
        </div>
    </div>
</div>

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
    // AJAX
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
                                      <img src="src/pfp.jpg" alt="${userName}" style="width: 100px; height: 100px; border-radius: 50%;">`);

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

        // Enable the endorse button if comment is filled and at least one button is active
        if (comment.length > 0 && atLeastOneActive) {
            $('#endorseButton').prop('disabled', false);
        } else {
            $('#endorseButton').prop('disabled', true);
        }
    }

    $('#commentField').on('input', function() {
        checkFormValidity();
    });

    // Endorse button click (submit vote)
    $('#endorseButton').on('click', function() {
        
        var selectedUserId = $(".userItem.selected").data('id');  // Get the selected votee ID
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
                // voter id we get from session
                votee_id: selectedUserId,  

                //endorsements
                work_fun: work_fun_temp, 
                team_player: team_player_temp ,
                culture_champ: culture_champ_temp, 
                diff_maker: diff_maker_temp, 
                //comment
                comment: comment  
            },
            success: function(response) {
                alert("Vote submitted successfully!");
                
                //clear field
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
