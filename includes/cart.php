<?php


include_once 'functions.php';


$error_msg = "";
if (isset($_POST['quantity']) && (isset($_POST['item_id']))) {
    // Sanitize and validate the data passed in
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);

    $item_id = $_SESSION["item_id"];
    $user_id = $_SESSION["user_id"];

    if ($insert_stmt = $mysqli->prepare("INSERT into cart_info (user_id, item_id, quantity) VALUES (?, ?, ?);")) {
        $insert_stmt->bind_param('sss', $user_id, $item_id, $quantity);
        // Execute the prepared query.
        if (! $insert_stmt->execute()) {
            header('Location: ../error.php?err=Registration failure: INSERTI');
            exit();
        }
    }
    header('Location: ./cart.php?item_id ='.$_POST['item_id']);
    exit();
}


?>