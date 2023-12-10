<?php

require_once "../classes/users.php";

if ($_POST) {

    if (isset($_POST["register"])) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];

        //validate empty fields
        if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirmpassword)) {

            echo "All fields are required";
            exit;
        }

        //validate password length
        if (strlen($password) < 8) {
            echo "Password must be at least eight characters";
            exit;
        }

        if ($password !== $confirmpassword) {
            echo "Passwords do not match";
            exit;
        }
    }
    //harsh password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //echo $password;
    //exit();

    $userone = new User();
    $response = $userone->registerUser($first_name, $last_name, $email, $password);
    echo $response;
} else {
    header("location: ../register.php");
}
