<?php
include 'auth_admin.php';
include 'creds.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User & Question Management</title>
<script src="scripts/jquery.min.js"></script>
<link rel="stylesheet" href="style/main.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="precontest.php">Database Management</a></li>
        <li><a href="during_contest.php">Contest status</a></li>
        <li><a href="scoreboard.php">Scoreboard</a></li>
        <li><a href="batches.php">Batch Leaderboards</a></li>
    </ul>
</nav>

<fieldset>
    <legend>Scoreboard</legend>
    <div id="scoreboard">Loading...</div>
</fieldset>

<fieldset>
    <legend>Scoreboard by question</legend>
    <div id="scoreboardbyquestion">Loading...</div>
</fieldset>

<script>    
    $(document).ready(function() {
    function loadScores() {
    $.get('scoreboard_data.php', function(data) {
        $('#scoreboard').html(data);
    }).fail(function() {
        $('#scoreboard').html('<p>Error loading scoreboard.</p>');
    });
    }

    function loadScoresbyquestion() {
        $.get('scoreboardbyquestion_data.php', function(data) {
            $('#scoreboardbyquestion').html(data);
        }).fail(function() {
            $('#scoreboardbyquestion').html('<p>Error loading scoreboard by questions.</p>');
        });
    }

    loadScores();
    loadScoresbyquestion();

    setInterval(() => {
        loadScores();
        loadScoresbyquestion();
    }, 1000);
    });
</script>
</body>
</html>