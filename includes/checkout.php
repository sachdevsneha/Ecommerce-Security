<?php

include_once 'functions.php';
secure_session_start();

$error_msg = "";


if (isset($_POST['billing_name'], $_POST['billing_address'], $_POST['billing_city'], $_POST['billing_state'], $_POST['billing_code'], $_POST['shipping_name'], $_POST['shipping_address'], $_POST['shipping_city'], $_POST['shipping_state'], $_POST['shipping_code'])) {
    // Sanitize and validate the data passed in

    $billing_name = filter_input(INPUT_POST, 'billing_name', FILTER_SANITIZE_STRING);
    $billing_address = filter_input(INPUT_POST, 'billing_address', FILTER_SANITIZE_STRING);
    $billing_city = filter_input(INPUT_POST, 'billing_city', FILTER_SANITIZE_STRING);
    $billing_state = filter_input(INPUT_POST, 'billing_state', FILTER_SANITIZE_STRING);
    $billing_code = filter_input(INPUT_POST, 'billing_code', FILTER_SANITIZE_NUMBER_INT);
    $shipping_name = filter_input(INPUT_POST, 'shipping_name', FILTER_SANITIZE_STRING);
    $shipping_address = filter_input(INPUT_POST, 'shipping_address', FILTER_SANITIZE_STRING);
    $shipping_city = filter_input(INPUT_POST, 'shipping_city', FILTER_SANITIZE_STRING);
    $shipping_state = filter_input(INPUT_POST, 'shipping_state', FILTER_SANITIZE_STRING);
    $shipping_code = filter_input(INPUT_POST, 'shipping_code', FILTER_SANITIZE_NUMBER_INT);

    $user_id = $_SESSION['user_id'];

    if ($insert_stmt = $mysqli->prepare("INSERT INTO customer_checkout_info (user_id, billing_name, billing_address, billing_city, billing_state, billing_code, shipping_name, shipping_address, shipping_city, shipping_state, shipping_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
        $insert_stmt->bind_param('sssssssssss', $user_id, $billing_name, $billing_address, $billing_city, $billing_state, $billing_code, $shipping_name, $shipping_address, $shipping_city, $shipping_state, $shipping_code);
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            header('Location: ../error.php?err=Registration failure: INSERT');
            exit();
        }

        $order_id = $mysqli->insert_id;
        $_SESSION['order_id']= $order_id;

        $sql = mysqli_query($mysqli, "SELECT i.item_id, i.price, s.quantity, s.cart_item_id FROM inventory_info AS i, cart_info AS s  WHERE i.item_id=s.item_id AND s.user_id = $user_id");

        $rows = mysqli_num_rows($sql); // count the output amount
        if ($rows > 0) {
            while ($rows = mysqli_fetch_array($sql)) {

                $item_id = $rows["item_id"];
                $price = $rows["price"];
                $quantity = $rows["quantity"];
                $cart_item_id = $rows["cart_item_id"];
                $_SESSION['amount']=$_SESSION['amount']+$price;

                if ($insert_stmt = $mysqli->prepare("INSERT INTO order_processing_info (order_id, cart_item_id, item_id, price, quantity) VALUES (?, ?, ?, ?, ?)")) {
                    $insert_stmt->bind_param('sssss', $order_id, $cart_item_id, $item_id, $price, $quantity);
                    // Execute the prepared query.
                    if (!$insert_stmt->execute()) {
                        header('Location: ../error.php?err=Registration failure: INSERT');
                        exit();
                    }
                }



            }
        }

        /*
                if ($select_stmt = $mysqli->prepare("SELECT i.item_id, i.price, s.quantity, s.cart_item_id FROM inventory_info AS i, cart_info AS s  WHERE i.item_id=s.item_id AND s.user_id = ?")) {
                    $select_stmt->bind_param("s", $user_id);
                    $select_stmt->execute();
                    $select_stmt->bind_result($item_id, $price, $quantity, $cart_item_id);

                    while ($select_stmt->fetch()) {

                if ($insert_stmt = $mysqli->prepare("INSERT INTO order_processing_info (order_id, cart_item_id, item_id, price, quantity) VALUES (?, (SELECT s.cart_item_id, i.item_id, i.price, s.quantity FROM inventory_info AS i, cart_info AS s  WHERE i.item_id=s.item_id AND s.user_id = ?))")) {
                    $insert_stmt->bind_param('ss', $order_id, $user_id);
                    // Execute the prepared query.
                    if (!$insert_stmt->execute()) {
                        header('Location: ../error.php?err=Registration failure: INSERTI');
                        exit();
                    }
                }
            //}
            //$select_stmt->close();
        //}*/
        header('Location: ./confirm_order.php');
        exit();
    }


}

?>