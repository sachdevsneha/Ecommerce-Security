<?php

include_once 'includes/confirm_order.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Secure Login: Checkout Page</title>
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
            <?php include_once 'static/style/navbar.html'; ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Home<span class="sr-only">(current)</span></a></li>
                <li><a href="admin_list.php">Admin</a></li>
                <?php include_once 'includes/logincheck.php'; ?>

            </ul>
        </div>
    </div>
</nav>

<?php if (login_check($mysqli) == true) : ?>
    <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
    <?php
    $user_id = $_SESSION['user_id'];
    if ($select_stmt = $mysqli->prepare("SELECT i.item_id, i.item_name, i.item_description, i.price, i.category, s.quantity FROM inventory_info as i, cart_info as s where i.item_id=s.item_id and s.user_id = ?")) {
        $select_stmt->bind_param("s", $user_id);
        $select_stmt->execute();
        $select_stmt->bind_result($item_id, $item_name, $item_description, $price, $category, $quantity);
        ?>
        <form class="form-horizontal" method="post" name="order" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
        <div class="container-fluid">
        <?php
        while ($select_stmt->fetch()) {
            ?>
            <div class="form-group">
                <a href="item_detail.php?item_id=<?php echo $item_id; ?>" class="form-group-item active">
                    <h4 class="form-group-item-heading" id="item_name">Item Name: <?php printf("%s", $item_name); ?></h4></a>
                <p class="form-group-item-text" id="category">Category: <?php printf("%s", $category); ?></p>
                <p class="form-group-item-text" id="item_description">Item Description: <?php printf("%s", $item_description); ?></p>
                <p class="form-group-item-text" id="price">Price: <?php printf("%s", $price); ?></p>
                <p class="form-group-item-text" id="quantity">Quantity: <?php printf("%s", $quantity); ?></p>
            </div>
            <?php
        }
        $select_stmt->close();
    }
    ?>

    <h4>Credit Card Information</h4>
    <input type='number' name='card_number' id='card_number' placeholder="Credit Card Number"/>
    <input type="text" name="card_name" id="card_name" placeholder="Name on Credit Card"/>
    <input type="date" name="expiration_date" id="expiration_date" placeholder="Expiration Date"/>
    <input type='number' name='cvv_number' id='cvv_number' placeholder="CVV Number"/>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" value="Confirm Order" />
        </div>
    </div>
    </div>
    </form>

<?php else : ?>
    <p><span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.</p>
<?php endif; ?>
<footer class="footer col-md-12">Sporty Goods Store</footer>
</body>
</html>
