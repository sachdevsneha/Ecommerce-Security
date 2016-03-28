<?php
if (login_check($mysqli) == true) {
    ?>
    <li><a href="checkout.php">Checkout</a></li>
    <li><a href="includes/logout.php">Logout</a></li>
    <?php
} else {
    ?>
    <li><a href="index.php">Login</a></li>
    <li><a href="register.php">Sign Up</a></li>
    <?php
}
?>