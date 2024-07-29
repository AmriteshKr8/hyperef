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
<style>
    /* Basic styling for demonstration */
    body { font-family: Arial, sans-serif; }
    fieldset { margin-bottom: 20px; }
    legend { font-weight: bold; }
    table, th, td { border: 1px solid #ddd; border-collapse: collapse; padding: 10px; }
    th, td:first-child { width: 150px; }
</style>
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
<style>
nav {
    background-color: #333;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

nav li {
    float: left;
}

nav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

nav li a:hover {
    background-color: #111;
}
</style>

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