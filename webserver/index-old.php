<?php
$error_message = "";
function state(){
    $filename = "admin/uyi7y8787tyguhjhg876/test.txt";    
    $fp = fopen($filename, "r");
    $contents = fread($fp, filesize($filename));
    fclose($fp);
    if ($contents == "c2h1cnUgaG8gZ2F5YSBiZW5jaG8="){
        return TRUE;
    }
    else{
        return FALSE;
    }
}

if (isset($_COOKIE['key'])) {
    $cookieValue = $_COOKIE['key'];
    $info = base64_decode($cookieValue);
    $info_data = explode("^", $info);
    $schoolcode = $info_data[0];
    $pass = $info_data[1];
} else {
    header('Location: login.html');
    exit();
}

if(state() === TRUE){

}
else{
    echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lobby</title>
    <script src="style/three.r134.min.js"></script>
    <script src="style/vanta.net.min.js"></script>
    <style>
    body, html {
        height: 100%;
        margin: 0;
    }
    #bruh {
        height: 100%;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        position: relative;
    }
    #spacer{
        border-width: 0;
        height:6vw;
        padding-bottom:3vh;
    }
    @font-face {
        font-family: "anurati";
        src: url("style/anurati.otf");
    }
    @font-face {
        font-family: "minecraft";
        src: url("style/minecraft.otf");
    }
    @font-face {
        font-family: "nasa";
        src: url("style/nasalisation.otf");
    }
    #heading{
        color:white;
        font-size:6vw;
        font-family:anurati;
    }
    #head{
        font-family:nasa;
        font-size:5vw;
        color:rgb(111, 0, 255);
    }
    ul {
        list-style: none;
        margin-left: 0;
        padding-top: 2vh;
        padding-left: 0;
    }

    li {
        padding-left: 1em;
        text-indent: -1em;
        font-size:30px;
        padding:20px;

    }

    li:before {
        content: ">";
        padding-right: 6px;
        padding-left: 3vw;
    }

    #box{
        border: 6px solid #ffffffab;
        margin: 4vw 4vw;
        border-radius: 20px;
        font-family: nasa;
    }
    </style>
</head>
<body bgcolor="black">
    <div id="bruh">
    <center><fieldset id="spacer"><h1 id="heading">H Y P E R E F</h1></fieldset></center><br>
    <fieldset id="box"><legend><font id="head">RULES</font></legend>
    <ul>
    <li>NO TEXT TO BE PRINTED WHILE TAKING INPUT(S).</li>
    <li>DO NOT CLOSE BROWSER DURING CONTEST.</li>
    <li>ONLY FIRST THREE SUBMISSIONS WILL BE REWARDED.</li>
    <li>NUMBER OF ATTEMPTS ARE UPDATED IN REAL TIME.</li>
    <li>CARRYING/USE OF ANY ELECTRONIC DEVICE IS PROHIBITED.</li>
    <li>GOOD LUCK!</li>
    </ul>
    </fieldset>
    </div>
    <script src="style/three.r134.min.js"></script>
    <script src="style/vanta.fog.min.js"></script>
    <script>
    VANTA.FOG({
    el: "#bruh",
    mouseControls: true,
    touchControls: true,
    gyroControls: false,
    minHeight: 200.00,
    minWidth: 200.00,
    highlightColor: 0xff0505,
    midtoneColor: 0xfc,
    lowlightColor: 0xcd00ff,
    baseColor: 0x141414,
    blurFactor: 0.90,
    speed: 2.40,
    zoom: 1.10
    })
    </script>
</body>
</html>
    ';
    exit();
}

include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query using prepared statements
$auth = "SELECT password, schoolcode FROM users WHERE schoolcode = ?";
$stmt = $conn->prepare($auth);
$stmt->bind_param("s", $schoolcode); // "s" indicates the type of the parameter (string)
$stmt->execute();
$authres = $stmt->get_result();

// Check if there is a matching user
if ($authres->num_rows > 0) {
    // Fetch data from the result set
    $row = $authres->fetch_assoc();
    $password = $row['password'];
    $team = $row['schoolcode'];

    // Verify password
    if ($password === $pass) {
    } else {
        // Passwords do not match, redirect to login page
        echo "Invalid token";
        sleep(5);
        header('Location: login.html');
        exit();
    }
} else {
    // No user found with the provided email
    header('Location: login.html');
    exit();
}

// Close connection
$stmt->close();
$conn->close();
?>
<?php
include 'creds.php';
$conn = new mysqli($host, $user, $passwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query using prepared statements
$auth = "SELECT password, schoolcode FROM users WHERE schoolcode = ?";
$stmt = $conn->prepare($auth);
$stmt->bind_param("s", $schoolcode); // "s" indicates the type of the parameter (string)
$stmt->execute();
$authres = $stmt->get_result();

// Check if there is a matching user
if ($authres->num_rows > 0) {
    // Fetch data from the result set
    $row = $authres->fetch_assoc();
    $password = $row['password'];
    $team = $row['schoolcode'];

    // Verify password
    if ($password === $pass) {
    } else {
        // Passwords do not match, redirect to login page
        echo "Invalid token";
        sleep(5);
        header('Location: login.html');
        exit();
    }
} else {
    // No user found with the provided email
    header('Location: login.html');
    exit();
}

// Close connection
$stmt->close();
$conn->close();
?>
<?php
    include 'creds.php';
    $conn = new mysqli($host, $user, $passwd, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }    
    
    $q1 = "SELECT question, score FROM questions WHERE id = 1";
    $q2 = "SELECT question, score FROM questions WHERE id = 2";
    $q3 = "SELECT question, score FROM questions WHERE id = 3";
    $q4 = "SELECT question, score FROM questions WHERE id = 4";
    $q5 = "SELECT question, score FROM questions WHERE id = 5";
    
    // Execute the query
    $r1 = $conn->query($q1);
    $r2 = $conn->query($q2);
    $r3 = $conn->query($q3);
    $r4 = $conn->query($q4);
    $r5 = $conn->query($q5);

    // Check if query execution was successful
    if ($r1 and $r2 and $r3 and $r4 and $r5 === false) {
        echo "Error: " . $conn->error;
    } else {
        // Check if any rows were returned
        if ($r1->num_rows > 0) {
            // Fetch data from the result set
            $row = $r1->fetch_assoc();
            $qn1 =  $row['question'];
            $qn1score = $row['score'];
        }
        if ($r2->num_rows > 0) {
            // Fetch data from the result set
            $row = $r2->fetch_assoc();
            $qn2 =  $row['question'];
            $qn2score = $row['score'];
        }
        if ($r3->num_rows > 0) {
            // Fetch data from the result set
            $row = $r3->fetch_assoc();
            $qn3 =  $row['question'];
            $qn3score = $row['score'];
        }
        if ($r4->num_rows > 0) {
            // Fetch data from the result set
            $row = $r4->fetch_assoc();
            $qn4 =  $row['question'];
            $qn4score = $row['score'];
        }
        if ($r5->num_rows > 0) {
            // Fetch data from the result set
            $row = $r5->fetch_assoc();
            $qn5 =  $row['question'];
            $qn5score = $row['score'];
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>hyperef</title>
    <style>
        @font-face {
            font-family: "anurati";
            src: url("style/anurati.otf");
        }
        @font-face {
            font-family: "minecraft";
            src: url("style/minecraft.otf");
        }
        @font-face {
            font-family: "nasa";
            src: url("style/nasalisation.otf");
        }
        body::-webkit-scrollbar{
            width: 0rem;
        }
        #qtl{
            font-family:nasa;
            color: #FFF;
            font-size: 1.2rem;
        }
        #scoreboard{
            font-family:nasa;
            color: #FFF;
            font-size: 1.2rem;
        }
        #schoolnamedisplay{
            font-family:nasa;
            color: #FFF;
        }
        body {
            margin: 0;
            padding: 0;
            font-family:nasa;
            background: #000;
            color: #FFF;
            font-size:26px;
        }
        #vanta-bg {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        input[type=submit], input[type=button]{
            max-width: auto;
            padding: 10px 10px;
            font-family: nasa;
            font-size: 20px;
            background-color: #ffffff00;
            color: #FFF;
            border: 6px solid #ffffffab;
            border-radius:10px;
            margin:10px;
        }
        input[type=submit]:hover, input[type=button]:hover{
            background: #000;
            color: #FFF;
            border: 6px solid #FFF;
        }
        .file-input {
            display:none;
        }
        .file-drop-zone {
            background: #ffffff00;
            color: #FFF;
            border: 6px solid #ffffffab;
            border-radius:10px;
            padding: 10px;
            margin: 17px 0;
            text-align: center;
            font-size:24px;
            font-family: "nasa";
            cursor: pointer;
        }
        .file-drop-zone.dragover {
            background: #000;
            color: #FFF;
            border: 6px solid #FFF;
        }
        .file-drop-zone:hover {
            background: #000;
            color: #FFF;
            border: 6px solid #FFF;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 10px; 
            margin-top: -10px;
        }
        table, th, td {
            border: 6px solid #ffffffab;
            border-radius: 10px;
        }
        th, td {
            padding: 20px;
            text-align: center;
        }
        fieldset{
            border-width:0px;
        }
        #heading{
            padding:0px;
            color:#FFF;
            font-family:"anurati";
            font-size:7.5vw;
            text-align: center;
        }
        #errbox{
            border: 6px solid #ffffffab;
            border-radius: 10px;
            color:yellow;
            font-family: "nasa";
            font-size:24px;
            margin:17px;
        }
        hr{
            height: 0px;
            border:3px solid #FFFFFF;
        }
        p{
            padding:0px;
        }
        #schoolnamedisplay{
            font-family:nasa;
            font-size:35px;
        }
    </style>
</head>
<body>
<div id="vanta-bg"></div>
<fieldset>
<h1 id='heading'>H Y P E R E F</h1>
<hr>
<fieldset>
    <h1 id="schoolnamedisplay">Live Scoreboard:</h1>
    <table>
        <thead>
            <tr>
                <th id="qtl">Q1</th>
                <th id="qtl">Q2</th>
                <th id="qtl">Q3</th>
                <th id="qtl">Q4</th>
                <th id="qtl">Q5</th>
            </tr>
        </thead>
        <tbody id="scoreboard">
            <tr>
                <td colspan="7">Loading...</td>
            </tr>
        </tbody>
    </table>
</fieldset>
<br>
<hr>
<br>
<center>
    <fieldset id='errbox'>
        Submission status
    </fieldset>
</center>
<br>
<hr>
<br>
<?php
    echo "Q1) ".$qn1."<br><br>";
    echo "Max Score: ".$qn1score."<br>";
?>
    <p id="q1attempts"></p>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="file-drop-zone" id="file-drop-zone1"><div id="f1">Click to select a file</div></div>
        <input type="file" id="file1" name="file1" accept=".py,.java" class="file-input">
        <input type="hidden" id="team" name="team" value="<?php echo htmlspecialchars($team);?>">
        <input type="submit" value="Submit"><a href="pdfs/1.pdf"><input type="button" value="Info"></a>
        <br><br>
    </form>
<?php
    echo "Q2) ".$qn2."<br><br>";
    echo "Max Score: ".$qn2score."<br>";
?>  
    <p id="q2attempts"></p>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="file-drop-zone" id="file-drop-zone2"><div id="f2">Click to select a file</div></div>
        <input type="file" id="file2" name="file2" accept=".py,.java" class="file-input">
        <input type="hidden" id="team" name="team" value="<?php echo htmlspecialchars($team);?>">
        <input type="submit" value="Submit"><a href="pdfs/2.pdf"><input type="button" value="Info"></a>
        <br><br>
    </form>
<?php
    echo "Q3) ".$qn3."<br><br>";
    echo "Max Score: ".$qn3score."<br>";
?>  
    <p id="q3attempts"></p>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="file-drop-zone" id="file-drop-zone3"><div id="f3">Click to select a file</div></div>
        <input type="file" id="file3" name="file3" accept=".py,.java" class="file-input">
        <input type="hidden" id="team" name="team" value="<?php echo htmlspecialchars($team);?>">
        <input type="submit" value="Submit"><a href="pdfs/3.pdf"><input type="button" value="Info"></a>
        <br><br>
    </form>
<?php
    echo "Q4) ".$qn4."<br><br>";
    echo "Max Score: ".$qn4score."<br>";
?>  
    <p id="q4attempts"></p>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="file-drop-zone" id="file-drop-zone4"><div id="f4">Click to select a file</div></div>
        <input type="file" id="file4" name="file4" accept=".py,.java" class="file-input">
        <input type="hidden" id="team" name="team" value="<?php echo htmlspecialchars($team);?>">
        <input type="submit" value="Submit"><a href="pdfs/4.pdf"><input type="button" value="Info"></a>
        <br><br>
    </form>
<?php
    echo "Q5) ".$qn5."<br><br>";
    echo "Max Score: ".$qn5score;
?>  
    <p id="q5attempts"></p>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="file-drop-zone" id="file-drop-zone5"><div id="f5">Click to select a file</div></div>
        <input type="file" id="file5" name="file5" accept=".py,.java" class="file-input">
        <input type="hidden" id="team" name="team" value="<?php echo htmlspecialchars($team);?>"><br>
        <input type="submit" value="Submit"><a href="pdfs/5.pdf"><input type="button" value="Info"></a>
    </form>
</fieldset>
<script src="style/three.r134.min.js"></script>
<script src="style/vanta.fog.min.js"></script>
<script>
function fetchScoreboard() {
    fetch(`score.php`)
        .then(response => response.json())
        .then(data => {
            const scoreboard = document.getElementById('scoreboard');
            const schoolnamedisplay = document.getElementById('schoolnamedisplay');
            if (data.error) {
                scoreboard.innerHTML = `<tr><td colspan="7">No submissions from your school yet.</td></tr>`;
                schoolnamedisplay.innerHTML = `<td>Live scoreboard</td>`;
            } else {
                schoolnamedisplay.innerHTML = `<td>${data.schoolcode}</td>`;
                scoreboard.innerHTML = `
                    <tr>
                        <td>${data.q1}</td>
                        <td>${data.q2}</td>
                        <td>${data.q3}</td>
                        <td>${data.q4}</td>
                        <td>${data.q5}</td>
                    </tr>
                `;
            }
        })
        .catch(error => {
            console.error('Error fetching score data:', error);
        });
}
function fetchAttempts() {
    fetch(`attempts.php`)
        .then(response => response.json())
        .then(data => {
            const q1attempts = document.getElementById('q1attempts');
            const q2attempts = document.getElementById('q2attempts');
            const q3attempts = document.getElementById('q3attempts');
            const q4attempts = document.getElementById('q4attempts');
            const q5attempts = document.getElementById('q5attempts');
            if(data.error) {
                q1attempts.innerHTML = `Loading`;
                q2attempts.innerHTML = `Loading`;
                q3attempts.innerHTML = `Loading`;
                q4attempts.innerHTML = `Loading`;
                q5attempts.innerHTML = `Loading`;
            } else {
                q1attempts.innerHTML = `Attempts: ${data.qa1}`;
                q2attempts.innerHTML = `Attempts: ${data.qa2}`;
                q3attempts.innerHTML = `Attempts: ${data.qa3}`;
                q4attempts.innerHTML = `Attempts: ${data.qa4}`;
                q5attempts.innerHTML = `Attempts: ${data.qa5}`;
            }
        })
        .catch(error => {
            console.error('Error fetching attempt data:', error);
        });
}

function setupFileDropZone(zoneId, inputId, displayId) {
    const zone = document.getElementById(zoneId);
    const input = document.getElementById(inputId);
    const display = document.getElementById(displayId);
    
    zone.addEventListener('click', () => input.click());
    zone.addEventListener('dragover', (e) => {
        e.preventDefault();
        zone.classList.add('dragover');
    });
    zone.addEventListener('dragleave', () => {
        zone.classList.remove('dragover');
    });
    zone.addEventListener('drop', (e) => {
        e.preventDefault();
        zone.classList.remove('dragover');
        input.files = e.dataTransfer.files;
        displayFileNames(input.files, display);
    });
    input.addEventListener('change', () => {
        displayFileNames(input.files, display);
    });
}

function displayFileNames(files, display) {
    display.innerHTML = '';
    for (const file of files) {
        const fileName = document.createElement('p');
        fileName.textContent = file.name;
        display.appendChild(fileName);
    }
}

// Set up drag-and-drop zones for each file input
setupFileDropZone('file-drop-zone1', 'file1','f1');
setupFileDropZone('file-drop-zone2', 'file2','f2');
setupFileDropZone('file-drop-zone3', 'file3','f3');
setupFileDropZone('file-drop-zone4', 'file4','f4');
setupFileDropZone('file-drop-zone5', 'file5','f5');

// Fetch the scoreboard and attempts every second
setInterval(fetchScoreboard, 1000);
setInterval(fetchAttempts, 1000);

// Initial fetch
fetchScoreboard();
fetchAttempts();

VANTA.FOG({
  el: "#vanta-bg",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00,
  highlightColor: 0xff0505,
  midtoneColor: 0xfc,
  lowlightColor: 0xcd00ff,
  baseColor: 0x141414,
  blurFactor: 0.70,
  speed: 2.40,
  zoom: 1.10
})
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['file1'])) {
        handleFormSubmission(1, $team, 1, $qn1score);
    } elseif (isset($_FILES['file2'])) {
        handleFormSubmission(2, $team, 2, $qn2score);
    } elseif (isset($_FILES['file3'])) {
        handleFormSubmission(3, $team, 3, $qn3score);
    } elseif (isset($_FILES['file4'])) {
        handleFormSubmission(4, $team, 4, $qn4score);
    } elseif (isset($_FILES['file5'])) {
        handleFormSubmission(5, $team, 5, $qn5score);
    } else {
        $error_message = "No file was submitted.";
    }
}

function handleFormSubmission($fileInput, $directoryName, $questionId, $qnscore) {
    global $error_message;
    if (state() === TRUE) {

    } else {
        echo "The contest has ended. Please leave.";
        exit();
    }

    global $uploadedFile;
    $uploadedFile = $_FILES["file" . $fileInput];
    $targetDirectory = "uploads/" . $directoryName;
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
    $newExtension = ($fileExtension == 'py') ? '.py' : (($fileExtension == 'java') ? '.java' : '');
    $targetFilePath = $targetDirectory . "/" . $fileInput . $newExtension;

    if (move_uploaded_file($uploadedFile['tmp_name'], $targetFilePath)) {
        $filename = $targetFilePath;

        $executionCount = 0;
        $badcode = 0;

        // Fetch test cases from the database
        include 'creds.php';
        $conn = new mysqli($host, $user, $passwd, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT input, output FROM testcases WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Define the descriptors for stdin, stdout, and stderr
        $descriptorspec = array(
            0 => array("pipe", "r"), // stdin is a pipe that the child will read from
            1 => array("pipe", "w"), // stdout is a pipe that the child will write to
            2 => array("pipe", "w")  // stderr is a pipe that the child will write to
        );

        while ($row = $result->fetch_assoc()) {
            $input = $row['input'];
            $expectedOutput = $row['output'];

            $inputs = explode("^", $input);

            // Run the command for each test case
            if ($newExtension === ".py") {
                $process = proc_open("python3 $filename", $descriptorspec, $pipes);
            } else {
                $process = proc_open("java $filename", $descriptorspec, $pipes);
            }

            if (is_resource($process)) {

                foreach ($inputs as $singleInput) {
                    fwrite($pipes[0], $singleInput . PHP_EOL);
                }
                fclose($pipes[0]);

                $output = '';
                while (!feof($pipes[1])) {
                    $output .= fgets($pipes[1]);
                }
                fclose($pipes[1]);

                $errorOutput = '';
                while (!feof($pipes[2])) {
                    $errorOutput .= fgets($pipes[2]);
                }
                fclose($pipes[2]);

                $return_value = proc_close($process);
                $executionCount++;
                $output = trim($output);

                if ($expectedOutput != $output) {
                    $badcode = 1;
                    break;
                }
            } else {
                echo "Could not start the process.<br>";
            }

            if ($badcode == 1) {
                break;
            }
        }

        $stmt->close();
        $conn->close();

        if ($badcode == 0) {
            enterData($directoryName, $fileInput, $qnscore);
        } else {
            $error_message = "Wrong Output on question " . $fileInput . ".";
        }
    } else {
        $error_message = "Please select a file.";
    }
}

function enterData($team, $fileno, $qnscore) {
    global $error_message;
    include 'creds.php';
    $conn = new mysqli($host, $user, $passwd, $db);
    $score = 0;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the current score for the team
    $readscore = "SELECT score FROM leaderboard WHERE schoolcode = '$team'";
    $resultscore = $conn->query($readscore);

    if ($resultscore->num_rows > 0) {
        // Fetch data from the result set
        $row = $resultscore->fetch_assoc();
        $score = $row['score'];
    }

    // Check if the team has already answered this question
    $read = "SELECT * FROM leaderboard WHERE schoolcode = '$team' AND q$fileno IS NOT NULL";
    $result = $conn->query($read);

    if ($result->num_rows > 0) {
        $error_message = "Already answered question ".$fileno.".";
        $conn->close();
        return;
    }

    // Prepare the query to check other entries for the question
    $entries_read = $conn->prepare("SELECT * FROM leaderboard WHERE q$fileno IS NOT NULL AND schoolcode != ?");
    $entries_read->bind_param("s", $team);
    $entries_read->execute();
    $insertrez = $entries_read->get_result();
    $entries = $insertrez->num_rows;

    // Calculate the reward based on the number of entries
    if ($entries == 0) {
        $reward = $qnscore;
    } elseif ($entries == 1) {
        $reward = $qnscore - $qnscore / 4;
    } elseif ($entries == 2) {
        $reward = $qnscore - $qnscore / 2;
    } else {
        $reward = 0;
    }

    // Close the entries_read statement
    $entries_read->close();

    // Calculate new score
    $newscore = $score + $reward;

    // Prepare the update/insert query using a prepared statement
    $read2 = "SELECT * FROM leaderboard WHERE schoolcode = '$team'";

    $result2 = $conn->query($read2);
    if($reward > 0){
        if ($result2->num_rows > 0) {
            // Update existing record
            $update = $conn->prepare("UPDATE leaderboard SET score = ?, q$fileno = ? WHERE schoolcode = ?");
            $update->bind_param("iis", $newscore, $reward, $team);
            $submit = $conn->prepare("INSERT INTO submissions (schoolcode, question) VALUES (?,?)");
            $submit->bind_param("si", $team, $fileno);
        } else {
            // Insert new record
            $update = $conn->prepare("INSERT INTO leaderboard (schoolcode, score, q$fileno) VALUES (?, ?, ?)");
            $update->bind_param("sii", $team, $newscore, $reward);
            $submit = $conn->prepare("INSERT INTO submissions (schoolcode, question) VALUES (?,?)");
            $submit->bind_param("si", $team, $fileno);
        }

        // Execute the prepared statement
        $done = $update->execute();
        if($done){
            $submit->execute();
            $error_message = "Answer Accepted for question ".$fileno.".";
        }  
    }elseif($reward == 0){
        $error_message = "Submissions have ended for question ".$fileno.".";
        echo"<script>
            function displayerr(){
                const errbox = document.getElementById('errbox');
                var err= '$error_message';
                if(err != ''){
                    errbox.innerHTML = err;
                }
            }
            setTimeout(displayerr(), 100);
            </script>
";
    }
    // Close the statement and connection
    $update->close();
    $submit->close();
    $conn->close();
}

?>
<script>
function displayerr(){
    const errbox = document.getElementById('errbox');
    var err= "<?php echo $error_message; ?>";
    if(err != ""){
        errbox.innerHTML = err;
    }
}
setTimeout(displayerr(), 100);
</script>
</body>
</html>