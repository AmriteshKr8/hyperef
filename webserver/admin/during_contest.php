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
        function fetchFileContent2() {
            fetch('read_file_2.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('file-status-format').innerText = data.content;
                });
        }
        function fetchFileContent3() {
            fetch('read_file_3.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('file-status-comms').innerText = data.content;
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
                fetchFileContent2();
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

            document.getElementById('blitz').addEventListener('click', function(e) {
                e.preventDefault();
                const formData = new FormData();
                formData.append('blitz', 'blitz');
                sendFormData(formData);
                console.log('blitz');
            });

            document.getElementById('normal').addEventListener('click', function(e) {
                e.preventDefault();
                const formData = new FormData();
                formData.append('normal', 'normal');
                sendFormData(formData);
                console.log('normal');
            });

            document.getElementById('commson').addEventListener('click', function(e) {
                e.preventDefault();
                const formData = new FormData();
                formData.append('commson', 'commson');
                sendFormData(formData);
                console.log('commson');
            });

            document.getElementById('commsoff').addEventListener('click', function(e) {
                e.preventDefault();
                const formData = new FormData();
                formData.append('commsoff', 'commsoff');
                sendFormData(formData);
                console.log('commsoff');
            });

            setInterval(fetchFileContent, 1000);
            setInterval(fetchFileContent2, 1000);
            setInterval(fetchFileContent3, 1000);
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
<legend><h1>Marking Format:</h1></legend>
<p id="file-status-format">Loading...</p>

<form id="marking">
    <input type="button" id="blitz" value="Blitz">
    <input type="button" id="normal" value="Normal">
</form>
</fieldset>

<fieldset>
<legend><h1>Comms Staus:</h1></legend>
<p id="file-status-comms">Loading...</p>

<form id="comms">
    <input type="button" id="commson" value="On">
    <input type="button" id="commsoff" value="Off">
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
