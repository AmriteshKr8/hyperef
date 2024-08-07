<?php
include 'auth_admin.php';
include 'creds.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style/main.css">
    <title>STATUS</title>
    <script>
        function fetchFileContent() {
            fetch('read_file.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('file-status').innerText = data.content;
                });
        }

        function fetchSubmissions() {
            fetch('submissions.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('submissions').innerHTML = data;
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
            setInterval(fetchSubmissions, 1000);
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
    <input type="button" id="start-btn" value="Start">
    <input type="button" id="end-btn" value="end">
</form>
</fieldset>
<fieldset>
<legend><h1>Copy Table</h1></legend>
<form id="copy-table-form" method="post">
    <label for="number">Save Slot:</label>
    <input type="number" id="number" name="number" required>
    <input type="submit" value="Save">
</form>

<form id="truncater">
    <input type="button" id="truncate-current" value="Truncate">
</form>
</fieldset>
<fieldset>
<legend><h1>Submissions</h1></legend>
<div id="submissions">Loading...</div>
<p id="copy-confirmation"></p>
</fieldset>
</body>
</html>
