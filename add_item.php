<?php

include_once 'includes/add_item.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin: Add Inventory</title>
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
                <li class="active"><a href="#">Add Inventory<span class="sr-only">(current)</span></a></li>
                <li><a href="admin.php">Admin</a></li>
                <?php include_once 'includes/logincheck.php' ?>
            </ul>
        </div>
    </div>
</nav>
<section class="container">
    <div class="add_items">
        <h1>Add Inventory</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>

        <form class="form-horizontal" method="post" name="add_items_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
            <div class="container-fluid">
                <div class="form-group">
                    <label for="item_name" class="col-sm-2 control-label">Item Name</label>
                    <div class="col-sm-10">
                        <input type='text' name='item_name' id='item_name' placeholder="Item Name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="item_description" class="col-sm-2 control-label">Item Description</label>
                    <div class="col-sm-10">
                        <textarea rows="3" name="item_description" id="item_description" placeholder="Item Description"></textarea>
                    </div>
                </div>
                <div class="row">
                    <label for="price" class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" min="1.00" step="0.01" name="price" id="price" placeholder="Price"/>
                    </div>
                </div>
                <div class="row">
                    <label for="category" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10">
                        <select name='category' id='category'>
                            <option selected disabled>Choose Category...</option>
                            <option value="shoes">Shoes</option>
                            <option value="shorts">Shorts</option>
                            <option value="tops">Tops</option>
                            <option value="gear">Gear</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Add Item"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<footer class="footer col-md-12">Sporty Goods Store</footer>
</body>
</html>