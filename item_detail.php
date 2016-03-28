<?php


include 'includes/add_review.php';
include 'includes/cart.php';


if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if(isset($_GET['item_id'])) {
    $_SESSION['item_id'] = $_GET['item_id'];
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
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Sporty Goods Store</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php include_once "static/style/navbar.html"; ?>
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
    $item_id = $_SESSION["item_id"];
    if ($select_stmt = $mysqli->prepare("SELECT item_name, item_description, price, category FROM inventory_info WHERE item_id=?")) {
        $select_stmt->bind_param("s", $item_id);
        $select_stmt->execute();
        $select_stmt->bind_result($item_name, $item_description, $price, $category);
        while ($select_stmt->fetch()) {
            ?>
            <div class="list-group">

                <br/>
                <a href="item_detail.php" class="list-group-item active">
                    <h4 class="list-group-item-heading">Item Name: <?php printf("%s", $item_name); ?></h4></a>
                <p class="list-group-item-text">Category: <?php printf("%s", $category); ?></p>
                <p class="list-group-item-text">Item Description: <?php printf("%s", $item_description); ?></p>
                <p class="list-group-item-text">Price: <?php printf("%s", $price); ?></p>
                <p class="list-group-item-text">Item ID: <?php printf("%s", $_SESSION["item_id"]); ?></p>
            </div>
            <form class="form-horizontal" method="post" name="add_to_cart" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" min="0" name="quantity" id="quantity" placeholder="Quantity"/>
                            <input name="item_id" type="hidden" id="item_id" value= "<?php echo $item_id; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">

                            <input type="submit" value="Add to Cart" />

                        </div>
                    </div>
            </form>
            <form class="form-horizontal" method="post" name="review" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="rating" class="col-sm-2 control-label">Rating</label>
                        <div class="col-sm-10">
                            <select name='rating' id='rating'>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review" class="col-sm-2 control-label">Review</label>
                        <div class="col-sm-10">
                            <textarea rows="3" name="review" id="review" placeholder="Review"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Add Review"/>
                        </div>
                    </div>
                </div>
            </form>

            <?php
        }
        $select_stmt->close();
    }

    if (!empty($error_msg)) {
        echo $error_msg;
    }

    $user_id = $_SESSION['user_id'];
    if ($select_stmt = $mysqli->prepare("SELECT v.username, r.rating, r.review FROM item_review as r, user_info as v WHERE r.item_id=? and v.user_id=r.user_id")) {
    $select_stmt->bind_param("s", $item_id);
    $select_stmt->execute();
    $select_stmt->bind_result($username, $rating, $review);
    while ($select_stmt->fetch()) {
    ?>
    <div class="list-group">
        <ul class="list-group-item active">
            <li class="list-group-item-text">Username: <?php printf("%s", $username); ?></li>
            <li class="list-group-item-text">Rating: <?php printf("%s", $rating); ?></li>
            <li class="list-group-item-text">Review: <?php printf("%s", $review); ?></li>
        </ul>
        <?php
        }
        $select_stmt->close();
        }
        ?>

        <?php else : ?>
            <p><span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
        <footer class="footer col-md-12">Sporty Goods Store</footer>
    </body>
    </html>
    <?php
}
else{ print("error");}
?>

