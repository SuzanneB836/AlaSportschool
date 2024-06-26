<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexFlow</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <!-- Navigation Section -->
    <div id="nav_container">
        <a href="Index.php"><img id="nav_logo" src="IMAGES/logo.svg" alt="FlexFlow Logo"></a>
        <div class="nav_links">
            <a href="vindclub.html"><h2 class="nav_links">VIND EEN CLUB</h2></a>
            <a href="groepslessen.html"><h2 class="nav_links">GROEPSLESSEN</h2></a>
            <a href="overons.html"><h2 class="nav_links">OVER ONS</h2></a>
            <a href="service.html"><h2 class="nav_links">SERVICE/HELP</h2></a>
        </div>
        <!-- Profile -->
        <div id="lid_link">
            <?php
            session_start();

            // Check if user is logged
            if (isset($_SESSION['username'])) {
                echo '<a href="logout.php"><h2 class="lid_link">UITLOGGEN</h2></a>';

                // Display user's information
                if (isset($_SESSION['picture_path'])) {
                    $picture_path = $_SESSION['picture_path'];
                    echo '<div class="account">
                            <a href="#" id="account-link">
                                <img src="' . $picture_path . '" alt="Account" id="account-img" style="width: 50px; height: 40px; border: solid 1px orange;">
                            </a>
                          </div>';
                } else {
                    echo '<div class="account">
                            <a href="#" id="account-link">
                                <img src="IMAGES/user.png" alt="Account" id="account-img" style="width: 50px; height: 40px;">
                            </a>
                          </div>';
                }

                echo '<div id="blueSquare">
                        Welkom, ' . $_SESSION['username'] . '!
                      </div>';

            } else {
                // Display login link if user is not logged in
                echo '<a href="login.html"><h2 class="lid_link">INLOGGEN</h2></a>';
            }
            ?>
        </div>
    </div>
    
    <div id="banner">
        <h1>Sport nu!<br><span id="orange">4 weken</span> gratis</h1>
        <a href="register.html"><button id="lid-worden"><h2>WORD LID!</h2></button></a>
    </div>

    <h1 id="SPORT">━ sport waar je wilt ━ sport wanneer je wilt ━ sport hoe je wilt ━</h1>

    <div id="aanbod">
        <div id="een">
            <p>volg oneindig veel groepslessen!</p>
        </div>
        <div id="twee">
            <p>Neem gratis 5 keer per maand een buddy mee!</p>
        </div>
        <div id="drie">
            <p>Altijd de nieuwste sportapparatuur!</p>
        </div>
    </div>

    <div id="content_area"></div>

    <div id="footer_container">
        <p class="footer_text">Over ons</p>
        <p class="footer_text">Groepslessen</p>
        <p class="footer_text">Service/help</p>
        <p class="footer_text">TOS</p>
        <p class="footer_text">Contact</p>
    </div>

    <script>
        document.getElementById('account-link').addEventListener('click', function(event) {
            event.preventDefault();
            var accountImg = document.getElementById('account-img');
            var blueSquare = document.getElementById('blueSquare');
            if (blueSquare.style.display === 'block') {
                blueSquare.style.display = 'none';
            } else {
                var accountImgRect = accountImg.getBoundingClientRect();
                blueSquare.style.left = (accountImgRect.left - 400) + 'px';
                blueSquare.style.top = (accountImgRect.bottom + 10) + 'px';
                blueSquare.style.display = 'block';
            }
        });
    </script>
</body>
</html>
