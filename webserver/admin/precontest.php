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
<legend><h1>User Management</h1></legend>
<fieldset>
<legend><h1>Add New User</h1></legend>
    <form id="addUserForm">
        School Code:<br>
        <input type="text" name="school_code"><br>
        School:<br>
        <input type="text" name="school"><br>
        Password:<br>
        <input type="password" name="password"><br>
        <input type="submit" value="Add User">
    </form>
    </fieldset>
    <fieldset>
    <legend><h1>User List</h1></legend>
    <div id="userListContainer">Loading...</div>
    </fieldset>
</fieldset>

<fieldset>
<legend><h1>Question Management</h1></legend>
<fieldset>
<legend><h1>Add New Question</h1></legend>
    <form id="addQuestionForm">
        ID:<br>
        <input type="number" name="qno"><br>
        Question:<br>
        <textarea name="question"></textarea><br>
        Score:<br>
        <input type="number" name="score"><br>
        <input type="submit" value="Add Question">
    </form>
</fieldset>
<fieldset>
    <legend><h1>Question List</h1></legend>
    <div id="questionListContainer">Loading...</div>
</fieldset>
<fieldset>
<legend><h1>Testcases</h1></legend>
    <form id="addTestcaseForm">
        Question:<br>
        <input type="number" name="id"><br>
        Inputs:<br>
        <textarea name="input"></textarea><br>
        Expected Output:<br>
        <textarea name="output"></textarea><br>
        <input type="submit" value="Add Testcase">
    </form>
</fieldset>
<fieldset>
    <legend><h1>Testcase List</h1></legend>
    <div id="testcaseListContainer">Loading...</div>
</fieldset>
</fieldset>
<script>
    $(document).ready(function() {
        loadUsers(); // Load users on page load
        loadQuestions(); // Load questions on page load
        loadTestcases();

        $(document).on('click', '.delete-btn', function() {
        console.log('Delete user button clicked'); // Add this line
        var schoolcode = $(this).val();
        deleteUser(schoolcode);
        });

        $(document).on('click', '.delete-question-btn', function() {
            console.log('Delete question button clicked'); // Add this line
            var questionId = $(this).val();
            deleteQuestion(questionId);
        });

        function deleteUser(schoolcode) {
            $.ajax({
                url: 'delete_users.php',
                type: 'POST',
                data: {action: 'delete', schoolcode: schoolcode},
                success: function(result) {
                    loadUsers(); // Refresh the list after deleting a user
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus + ": " + errorThrown);
                }
            });
        }

        function deleteQuestion(id) {
            $.ajax({
                url: 'delete_questions.php',
                type: 'POST',
                data: {action: 'delete', id: id},
                success: function(result) {
                    loadQuestions(); // Refresh the list after deleting a question
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus + ": " + errorThrown);
                }
            });
        }

        function deleteTestcase(id) {
            $.ajax({
                url: 'delete_testcase.php',
                type: 'POST',
                data: {action: 'delete', id: id},
                success: function(result) {
                    loadTestcases(); // Refresh the list after deleting a question
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus + ": " + errorThrown);
                }
            });
        }

        function loadUsers() {
            $.get('display_users.php', function(data) {
                $('#userListContainer').html(data);
            }).fail(function() {
                $('#userListContainer').html('<p>Error loading users.</p>');
            });
        }
            function loadQuestions() {
            $.get('display_questions.php', function(data) {
                $('#questionListContainer').html(data);
            }).fail(function() {
                $('#questionListContainer').html('<p>Error loading questions.</p>');
            });
        }

        function loadTestcases() {
            $.get('display_testcase.php', function(data) {
                $('#testcaseListContainer').html(data);
            }).fail(function() {
                $('#testcaseListContainer').html('<p>Error loading questions.</p>');
            });
        }

    function addUser() {
        var formData = $('#addUserForm').serialize();
        $.post('insert_users.php', formData, function(data) {
            loadUsers();
        }).fail(function() {
            alert('Error adding user.');
        });
    }

    function addQuestion() {
        var formData = $('#addQuestionForm').serialize();
        $.post('insert_questions.php', formData, function(data) {
            loadQuestions();
        }).fail(function() {
            alert('Error adding question.');
        });
    }
    function addTestcase() {
        var formData = $('#addTestcaseForm').serialize();
        $.post('insert_testcase.php', formData, function(data) {
            loadTestcases();
        }).fail(function() {
            alert('Error adding testcases.');
        });
    }

    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        addUser();
    });

    $('#addQuestionForm').on('submit', function(e) {
        e.preventDefault();
        addQuestion();
    });

    $('#addTestcaseForm').on('submit', function(e) {
        e.preventDefault();
        addTestcase();
    });

    // Attach event listener to delete buttons within the user table
    $(document).on('click', '.delete-user-btn', function() {
        var userEmail = $(this).val();
        deleteUser(userEmail);
    });

    // Attach event listener to delete buttons within the question table
    $(document).on('click', '.delete-question-btn', function() {
        var questionId = $(this).val();
        deleteQuestion(questionId);
    });
    $(document).on('click', '.delete-testcase-btn', function() {
        var tcinput = $(this).val();
        console.log(tcinput);
        deleteTestcase(tcinput);
    });
});
</script>
</body>
</html>
