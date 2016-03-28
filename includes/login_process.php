<?php

include_once 'functions.php';

secure_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['email'], $_POST['p'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['p']; // The hashed password.

    if (login($email, $password, $mysqli) == true) {
        // Login success
        if ($stmt = $mysqli->prepare("SELECT role FROM user_info WHERE email = ? LIMIT 1")) {
            $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
            $stmt->execute();                // Execute the prepared query.
            $stmt->store_result();

            // get variables from result.
            $stmt->bind_result($role);
            $stmt->fetch();
            if($role=='customer'){
                header("Location: ../item_list.php");
            } else {
                header("Location: ../admin_list.php");
            }
            exit();
        }
    } else {
        // Login failed 
        header('Location: ../index.php?error=1');
        exit();
    }
} else {
    // The correct POST variables were not sent to this page. 
    header('Location: ../error.php?err=Could not process login');
    exit();
}