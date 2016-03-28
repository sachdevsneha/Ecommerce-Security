<?php

include_once 'includes/functions.php';
secure_session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Secure Login: Protected Page</title>
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

                <?php include_once 'includes/logincheck.php'; ?>

            </ul>
        </div>
    </div>
</nav>

<?php if (login_check($mysqli) == true) : ?>
<p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>

<?php
    if ($select_stmt = $mysqli->prepare("SELECT item_id, item_name, item_description, price, category FROM inventory_info")) {
        $select_stmt->execute();
        $select_stmt->bind_result($item_id, $item_name, $item_description, $price, $category);
        while ($select_stmt->fetch()) {
?>
<div class="list-group">
    <br>
    <a href="item_detail.php?item_id=<?php echo $item_id; ?>" class="list-group-item active">
        <h4 class="list-group-item-heading">Item Name: <?php printf("%s", $item_name); ?></h4>
        <p class="list-group-item-text">Category: <?php printf("%s", $category); ?></p>
        <p class="list-group-item-text">Item Description: <?php printf("%s", $item_description); ?></p>
        <p class="list-group-item-text">Price: <?php printf("%s", $price); ?></p>
    </a>
    <?php

    }
    $select_stmt->close();
    }
?>
</div>
    <?php else : ?>
        <p><span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.</p>
    <?php endif; ?>
<footer class="footer col-md-12">Sporty Goods Store</footer>
</body>
</html>
