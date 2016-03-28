<?php
include_once 'includes/functions.php';
?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Secure Login: Registration Success</title>
    <?php include_once 'static/style/headscripts.html'; ?>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">	<span class="sr-only">Toggle navigation</span> 	<span class="icon-bar"></span> 	<span class="icon-bar"></span> 	<span class="icon-bar"></span>
            </button>	<a class="navbar-brand" href="#">Sporty Goods Store</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php include_once "static/style/navbar.html"; ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Home<span class="sr-only">(current)</span></a></li>
                <li><a href="admin.php">Admin</a></li>
                <?php include_once 'includes/logincheck.php'; ?>
            </ul>
        </div>
    </div>
</nav>
<h1>Registration successful!</h1>
<p>You can now go back to the <a href="index.php">login page</a> and log in</p>
<footer class="footer col-md-12">Sporty Goods Store</footer>
</body>
</html>
