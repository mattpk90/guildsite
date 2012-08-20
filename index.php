<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/i/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">

  <!-- Mobile viewport optimized: h5bp.com/viewport -->
  <meta name="viewport" content="width=device-width">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <link rel="stylesheet" href="css/style.css">

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except this Modernizr build.
       Modernizr enables HTML5 elements & feature detects for optimal performance.
       Create your own custom Modernizr build: www.modernizr.com/download/ -->
  <script src="js/libs/modernizr-2.5.3.min.js"></script>

  <?php try{ $dbh = new PDO('mysql:host=localhost;dbname=forum', "root", ""); }
  catch(Exception $e){ die("Unable to connect: " . $e->getMessage()); }
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  include "./functions.php";
  require('PasswordHash.php'); ?>
</head>
<body>
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <a href="index.php">
  <div id="banner">
    Forum
  </div></a>

  <nav>
    <a href="index.php">Home</a>
    <a href="../guildwars2">Guild Wars 2 News</a>
  </nav>

  <div id="usercp">
    <?php panel(); ?>
  </div>

  <div id="controls">
    <a href="addpost.php"><button class="controlbutton">Add Post</button></a>
  </div>

  <div role="main">

      <?php
      try {
        foreach($dbh->query('SELECT id,author,date,title,body FROM posts') as $post) {
          $id = $post['id'];
          echo "<article class='post' id='$id'><header>".
          "<h4>".$post['title']."</h4>".
          "Posted: ".$post['date']."<br />".
          "Author: ".$post['author'].
          "</header>".
          "<p>".$post['body']."</p><br />".
          "<a href='addpost.php?reply=1&id=$id'><button>Reply</button></a>".
          "<a href='posthandler.php?delpost=1&id=$id'><button>Delete</button></a></article>";

          foreach($dbh->query("SELECT id,parent,date,author,body FROM replies WHERE parent = '$id'") as $replies) {
            $replyid = $replies['id'];
            echo "<article class='reply'><header>".
            "Posted: ".$replies['date']."<br />".
            "Author: ".$replies['author'].
            "</header>".
            "<p>".$replies['body']."</p><br />".
            "<a href='posthandler.php?delreply=1&id=$replyid'><button>Delete</button></a></article>";
          }
        }
      }
      catch (PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
      }

      /*try {
        foreach($dbh->query('SELECT id,parent,date,author,body FROM replies WHERE parent = $id') as $replies) {
          echo "<article class='reply'><header>".
          "Posted: ".$replies['date']."<br />".
          "Author: ".$replies['author'].
          "</header>".
          "<p>".$replies['body']."</p><br />".
          "<button>Delete</button></article>";
        }
      }
      catch (PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
      }*/

      $dbh = null;
    ?>

  <footer>
    &copy; 2012
  </footer>


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
  <script src='js/libs/jquery-ui.js'></script>

  <!-- scripts concatenated and minified via build script -->
  <script src='js/script.js'></script>
  <script src="js/plugins.js"></script>
  <!-- end scripts -->

  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->
  <script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
</body>
</html>