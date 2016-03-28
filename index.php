<?php

include_once 'includes/functions.php';

secure_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Secure Login: Log In</title>
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
                <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                <li><a href = "register.php">Register</a></li>
                <?php include_once 'includes/logincheck.php'; ?>
            </ul>
        </div>
    </div>
</nav>

<?php
if (isset($_GET['error'])) {
    echo '<p class="error">Error Logging In!</p>';
}
?>
<section class="container">
    <div class="login">
        <h1>Login to Sporty Goods Store</h1>
        <form class="form-horizontal" action="includes/login_process.php" method="post" name="login_form">
            <div class="container-fluid">
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" id="email" name="email" placeholder="Email"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" id="password" name="password" id="password" placeholder="Password"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<footer class="footer col-md-12">Sporty Goods Store</footer>
</body>
</html>