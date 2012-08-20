<?php 
try{ $dbh = new PDO('mysql:host=localhost;dbname=forum', "root", ""); }
  catch(PDOException $e){ die("Unable to connect: " . $e->getMessage()); }
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!isset($_POST["title"])){
	$reply = true;
}

if(isset($_GET["delpost"])){
	$id = $_GET['id'];
	try{
		$sql = "DELETE FROM posts WHERE id = '$id'";
  		$dbh->exec($sql);
  		$sql1 = "DELETE FROM replies WHERE parent = '$id'";
  		$dbh->exec($sql1);
  		header('Location: index.php');
	} catch(PDOException $e){ echo "Delete unsuccessful: " . $e->getMessage(); }
	exit;
}

if(isset($_GET["delreply"])){
	$id = $_GET['id'];
	try{
		$sql = "DELETE FROM replies WHERE id = '$id'";
  		$dbh->exec($sql);
  		header('Location: index.php');
	} catch(PDOException $e){ echo "Delete unsuccessful: " . $e->getMessage(); }
	exit;
}

if(isset($_COOKIE['username'])){
	$author = $_COOKIE['username'];
}else{
	$author = "Anon";
}


if($reply){
	try{
		$parent = $_POST["id"]; 
		$body = $_POST["body"];

 		$stmt = $dbh->prepare('INSERT INTO replies (parent, author, body) VALUES (:parent, :author, :body)');

		$stmt->bindParam(':parent', $parent);
		$stmt->bindParam(':author', $author);
		$stmt->bindParam(':body', $body);
		$stmt->execute();
		header('Location: index.php');

	} catch(PDOException $e){ echo "Reply unsuccessful: " . $e->getMessage(); }
}
else{
	$title = $_POST["title"];
	$body = $_POST["body"]; 

	try{
		$stmt = $dbh->prepare('INSERT INTO posts (author, title, body) VALUES (:author, :title, :body)');

		$stmt->bindParam(':author', $author);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':body', $body);
		$stmt->execute();
		header('Location: index.php');

	} catch(PDOException $e){ echo "Post unsuccessful: " . $e->getMessage(); }
}

$dbh = null;
?>


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

  <title>Add Post</title>
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

  <div id="usercp"></div>

  <div role="main">
  	Post successful.
  </div>

  <footer>
    &copy; 2012
  </footer>


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

  <!-- scripts concatenated and minified via build script -->
  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>
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