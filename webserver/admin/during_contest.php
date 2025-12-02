<?php
include 'auth_admin.php';
include 'creds.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>STATUS</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        function fetchFileContent() {
            fetch('read_file.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('file-status').innerText = data.content;
                });
        }

        function fetchLeaderboard() {
            fetch('leaderboard.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('leaderboard').innerHTML = data;
                });
        }

        function fetchSubmissions() {
            fetch('submissions.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('submissions').innerHTML = data;
                });
        }

        function fetchOccupiedSlots() {
            fetch('occupied_slots.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('occupied-slots').innerHTML = data;
                });
        }

        function sendFormData(formData) {
            fetch('update.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('copy-confirmation').innerText = data;
                fetchOccupiedSlots();
                fetchFileContent();
                fetchSubmissions();
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('start-btn').addEventListener('click', function(e) {
                e.preventDefault();
                const formData = new FormData();
                formData.append('start', 'start');
                sendFormData(formData);
                console.log(formData);
                console.log(start);
            });

            document.getElementById('end-btn').addEventListener('click', function(e) {
                e.preventDefault();
                const formData = new FormData();
                formData.append('end', 'end');
                sendFormData(formData);
            });

            document.getElementById('copy-table-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('reset', 'reset');
                sendFormData(formData);
            });

            document.getElementById('truncate-current').addEventListener('click', function(e) {
                e.preventDefault();
                const formData = new FormData();
                formData.append('truncate', 'truncate');
                sendFormData(formData);
            });

            setInterval(fetchFileContent, 1000);
            setInterval(fetchLeaderboard, 1000);
            setInterval(fetchSubmissions, 1000);
            setInterval(fetchOccupiedSlots, 1000);
        });
    </script>
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
<legend><h1>Contest Status:</h1></legend>
<p id="file-status">Loading...</p>

<form id="start-end-form">
    <button id="start-btn">Start</button>
    <button id="end-btn">End</button>
</form>
</fieldset>
<fieldset>
<legend><h1>Copy Leaderboard Table</h1></legend>
<form id="copy-table-form" method="post">
    <label for="number">Enter a number:</label>
    <input type="number" id="number" name="number" required>
    <button type="submit">Copy Table</button>
</form>

<form id="truncater">
    <button id="truncate-current">Truncate</button>
</form>
</fieldset>
<fieldset>
<legend><h1>Submissions</h1></legend>
<div id="submissions">Loading...</div>
<p id="copy-confirmation"></p>
</fieldset>
<fieldset>
<legend><h1>Occupied Slots</h1></legend>
<div id="occupied-slots">Loading...</div>
<div id="leaderboard"></div>
    </fieldset>
</body>
</html>
