<?php

include_once 'functions.php';

$error_msg = "";


if (isset($_POST['item_name'], $_POST['item_description'], $_POST['price'], $_POST['category'])) {
    // Sanitize and validate the data passed in
    $item_name = filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING);
    $item_description = filter_input(INPUT_POST, 'item_description', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

    if ($insert_stmt = $mysqli->prepare("INSERT INTO inventory_info (item_name, item_description, price, category) VALUES (?, ?, ?, ?)")) {
        $insert_stmt->bind_param('ssss', $item_name, $item_description, $price, $category);
        // Execute the prepared query.
        if (! $insert_stmt->execute()) {
            header('Location: ../error.php?err=Registration failure: INSERT');
            exit();
        }
        header('Location: ./admin_list.php');
        exit();
    }
}

?>