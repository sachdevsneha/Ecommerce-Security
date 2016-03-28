<?php

include_once 'db-connect.php';
include_once 'functions.php';
secure_session_start();

$error_msg = "";
if (isset($_POST['rating'], $_POST['review'])) {
    // Sanitize and validate the data passed in
    $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);
    $review = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_STRING);

    $item_id = $_SESSION["item_id"];
    $user_id = $_SESSION["user_id"];

    if ($insert_stmt = $mysqli->prepare("INSERT INTO item_review (item_id, user_id, rating, review) VALUES (?, ?, ?, ?)")) {
        $insert_stmt->bind_param('ssss', $item_id, $user_id, $rating, $review);
        // Execute the prepared query.
        if (!$insert_stmt->execute()) {
            header('Location: ../error.php?err=Insert failure: INSERT');
            exit();
        }
        header('Location: ./item_list.php');
        exit();
    }

}

?>