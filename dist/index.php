<?php

    if ($_SERVER['SERVER_NAME'] == 'localhost')
    {
        // Retrieve application from BBDD
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Hackajobs";
        
        echo 'LOCALHOST';
    }
    else
    {
        // Retrieve application from BBDD
        $servername = "mySQL";
        $username = "hackajob";
        $password = "uiyr683d";
        $dbname = "Hackajobs";
    }
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT * FROM tbl_application WHERE id = " .$_GET["id_application"];
    $result = $conn->query($sql);

    $application = null;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $application = $row;
        }
    } else {
        // echo "0 results";
    }
    $conn->close();
    
    $jobtitle = "Oferta per programador senior";
    $url_fb = "https://apisocial.wallyjobs.com/login/facebook?urlOK=". urlencode("http://localhost/hackathon-mutual-friends/dist/");
    
    if (isset($_GET["new"]))
    {
        // echo 'hola';
    }
    else
    {
        $currentUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $actual_link = $_SERVER['REQUEST_URI'];

        $parts = explode('/', $actual_link);
        array_pop($parts);
        $last = end($parts);

        //$url = "https://demo1200974.mockable.io/mutualfriends";
        $url = "https://apisocial.wallyjobs.com/friends/facebook/" . $_GET["id_candidate"] . "/" . $application["user_id"];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result=curl_exec($ch);
        curl_close($ch);

        $friends = json_decode($result, true);
    }

    $textMail = "Bones, estic buscant feina i m'agradaria que em recomanessis per aquesta posició.";
    $link = "https://recommendme.wallyjobs.com?id_candidate=" . $_GET["id_candidate"] . "&id_job=" . $application["job_id"] . "&id_application=" . $application["id"];
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    
        <title>Mutual Friends</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" href="css/hackajobs-stylesheet.css" rel="stylesheet">
    
    <script src="http://connect.facebook.net/en_US/all.js"></script>

    <script>
      var fbClick = function() {
      // assume we are already logged in
      FB.init({appId: '898845680138958', xfbml: true, cookie: true});

      FB.ui({
          method: 'send',
          name: '<?=urlencode($textMail)?>',
          link: '<?=$link?>',
          });
      };
     </script>
</head>
<body>

<header>
    <div class="container">
        <div class="wally-logo">
            <img src="img/wallyJobsLogoHor.svg" alt="WallyJobs"/>
        </div>
        <div class="clearfix"></div>
    </div>

</header>

    <main class="container">

        <article class="offer-status">

            <h1 class="offer-title">Cambrer restaurant Platja</h1>

            <section class="offer-mutual-friends">
                <h4 class="mutual-friends-title">Tens <?=count($friends); ?> amics en comú amb l'anunciant:</h4>
                <div class="friends">
                <?php
                foreach ($friends as &$friend) {
                ?>
                    <article class="mutual-friend">
                        <div class="friend-image">
                            <img src="<?=$friend["picture_url"]?>">
                        </div>
                        <h5 class="friend-name"><?=$friend["name"]?> </h5>
                        <a class="friend-recommendation-request" href="#" onclick="fbClick();"><span class="badge">Sol·licita una recomanació</span></a>
                    </article>
                            
                <?php
                }
                ?>
                </div>
            </section>
        </article>
    </main>

    <footer>
        <p class="small">©2015 Bla bla bla, ...</p>
    </footer>

    <script type="text/javascript" src="js/hackajobs-stylesheet-dependencies.js"></script>
    
</body>
</html>