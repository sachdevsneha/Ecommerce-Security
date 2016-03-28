<?php

include_once 'functions.php';
secure_session_start();

$error_msg = "";


if (isset($_POST['card_name'], $_POST['card_number'], $_POST['expiration_date'], $_POST['cvv_number'])) {
    // Sanitize and validate the data passed in
    $card_name = filter_input(INPUT_POST, 'card_name', FILTER_SANITIZE_STRING);
    $card_number = filter_input(INPUT_POST, 'card_number', FILTER_SANITIZE_NUMBER_INT);
    $expiration_date = filter_input(INPUT_POST, 'expiration_date', FILTER_SANITIZE_STRING);
    $cvv_number = filter_input(INPUT_POST, 'cvv_number', FILTER_SANITIZE_NUMBER_INT);
    $amount = $_SESSION['amount'];
    $order_id = $_SESSION['order_id'];
    /*insert info to database*/
    if ($insert_stmt = $mysqli->prepare("INSERT INTO order_info (order_id, card_name, card_number, expiration_date, cvv_number, amount) VALUES (?, ?, ?, ?, ?, ?);")) {
        $insert_stmt->bind_param('ssssss', $order_id, $card_name, $card_number, $expiration_date, $cvv_number, $amount);
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            header('Location: ../error.php?err=Registration failure: INSERT');
            echo "error insert to order_info <br>";
            exit();
        }
        $update_stmt = mysqli_query($mysqli, "UPDATE order_processing_info SET status='confirmed' WHERE order_id=$order_id");
        $_SESSION['amount']=0;

        $sql = mysqli_query($mysqli, "SELECT cart_item_id from order_processing_info where order_id=$order_id and status='confirmed'");
        $rows = mysqli_num_rows($sql); // count the output amount
        if ($rows > 0) {
            while ($rows = mysqli_fetch_array($sql)) {
                $cart_item_id = $rows['cart_item_id'];
                $delete_stmt = mysqli_query($mysqli, "DELETE from cart_info where cart_item_id=$cart_item_id");
            }
        }
        header('Location: ./item_list.php');

    }
}

?>