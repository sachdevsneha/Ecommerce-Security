<?php

include_once 'includes/registeration.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Secure Login: Registration Form</title>
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
                <li class="active"><a href="#">Sign Up<span class="sr-only">(current)</span></a></li>
                <li><a href="admin.php">Admin</a></li>
                <?php include_once 'includes/logincheck.php'; ?>
            </ul>
        </div>
    </div>
</nav>
<section class="container">
    <div class="signup">
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Register with us</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <ul>
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one upper case letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
            <li>Your must be 18 or older to register.</li>
        </ul>
        <form class="form-horizontal" method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
            <div class="container-fluid">
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type='text' name='username' id='username' placeholder="Username"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" id="email" placeholder="Email ID"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" id="password" placeholder="Password"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirmpwd" class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirm Password"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type='text' name='firstname' id='firstname' placeholder="First Name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type='text' name='lastname' id='lastname' placeholder="Last Name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">Age</label>
                    <div class="col-sm-10">
                        <input type='number' name='age' id='age' placeholder="Age"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="button" value="Register" onclick="return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd, this.form.firstname, this.form.lastname, this.form.age);" />
                    </div>
                </div>
            </div>
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
    </div>
</section>
<footer class="footer col-md-12">Sporty Goods Store</footer>
</body>
</html>
