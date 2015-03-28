<?php

    
    $jobtitle = "Oferta per programador senior";
    $url_fb = "https://apisocial.wallyjobs.com/login/facebook?urlOK=". urlencode("http://localhost/2015-inscripcio2/dist/");
    
    if (isset($_GET["new"]))
    {
        echo 'hola';
    }
    else
    {
        $currentUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $actual_link = $_SERVER['REQUEST_URI'];

        $parts = explode('/', $actual_link);
        array_pop($parts);
        $last = end($parts);

        $url = "https://demo1200974.mockable.io/mutualfriends";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result=curl_exec($ch);
        curl_close($ch);

        $friends = json_decode($result, true);
    }
    
/*
    $id_candidate, $id_job, $id_application;
    
    http://recommendme.wallyjobs.com?$id_candidate=
*/
    
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo $jobtitle . ' | WallyJobs'; ?></title>

    <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo $currentUrl; ?>">
        <meta property="og:title" content="<?php echo $job['title']; ?>">
        <meta property="og:description" content="<?php echo $job['description']; ?>">
        <meta property="og:image" content="<?php echo $job['picture_url']; ?>">

        <meta property="twitter:card" content="summary">
        <meta property="twitter:url" content="<?php echo $currentUrl; ?>">
        <meta property="twitter:title" content="<?php echo $job['title']; ?>">
        <meta property="twitter:description" content="<?php echo $job['description']; ?>">
        <meta property="twitter:image" content="<?php echo $job['picture_url']; ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="css/hackajobs-stylesheet.css" rel="stylesheet">
    
    <script src="http://connect.facebook.net/en_US/all.js"></script>

    <script>
      var fbClick = function() {
      // assume we are already logged in
      FB.init({appId: '898845680138958', xfbml: true, cookie: true});

      FB.ui({
          method: 'send',
          name: 'People Argue Just to Win',
          link: 'https://www.facebook.com/',
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

<main>
    <div class="container">
        <article class="job-offer offer">
            <h1 class="offer-title"><?php echo $jobtitle; ?></h1>
            
            <div class="friends">
                <?php
                foreach ($friends as &$friend) {
                    // var_dump($friend);
                    echo "<div>name:" . $friend["name"] . "</div>";
                    echo "<img src=" . $friend["picture_url"] ." width=\"200px\", height=\"200px\" alt=\"Titol Oferta\"/>";
                }
                ?>
            </div>
            <hr/>
            <div class="offer-apply">
                <a class="btn btn-primary btn-lg" href="<?php echo $url_fb; ?>">Apply</a>
            </div>

            <div class="offer-apply">
                <a class="btn btn-primary btn-lg" href="#" onclick="fbClick();">Demanar als amics</a>
            </div>
        </article>
    </div>

</main>

<footer>
    <p class="small">©2015 Bla bla bla, ...</p>
</footer>



<script type="text/javascript" src="js/hackajobs-stylesheet-dependencies.js"></script>

</body>
</html>