<!DOCTYPE html>
<head>
    <title>Hyperef</title>
    <link rel="stylesheet" href="style/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="rb"></div>
        <div class="tp">
            <nav class="navbar">
                <ul class="navbar-nav">
                    <h>Hyperef</h>
                    <li class="nav-item" id="login">
                        <link-text>Login</link-text>
                    </li>
                </ul>
            </nav>
            <fauna>HYPEREF</fauna>
        </div>
    <script src="style/p5.min.js"></script>
    <script src="style/vanta.topology.min.js"></script>
    <script>
    var code="#4da1a9"   /*<--- change this for dot-wave color #32ff00*/
    var back="#330c2f"   /*<--- change this for background color #222222*/
    VANTA.TOPOLOGY({
        el: "#rb",
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        color: code,
        backgroundColor: back
    })
    </script>
    <script>
        let x = document.getElementById("login");
        x.onclick = function() {
            window.location.href = 'signin.php';
        };
    </script>
</body>