<?php
    require 'db.php';

    $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT, ['cost' => 12]);

    $database->insert("tb_users",[
        "user_name" => $_POST["user"],
        "password"=> $pass
    ]);
    header("location: register.php");
?>