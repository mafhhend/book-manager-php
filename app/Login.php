<?php
session_start();
require("../config/mysql.php");
require("./Validation.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") return;

unset($_SESSION["errors.login"]);


$email = $_POST["email"];
$password = $_POST["password"];

$vl = new Validation();
$errors = [];

if ($vl->isEmpty($email)) array_push($errors, "لطفا ایمیل خود را وارد نمایید.");
if ($vl->isEmpty($password)) array_push($errors, "لطفا پسورد خود را وارد نمایید.");

if (count($errors) === 0) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user) {
        $_SESSION["user"] = [
            "name" => $user["nameFamily"],
            "email" => $email,
            "id" => $user['id']
        ];
        unset($_SESSION["errors.login"]);
        header("Location: /");
        die;
    } else {
        // $_SESSION["error.login"] = "ایمیل یا رمز عبور اشتباه است.";
        array_push($errors, "ایمیل یا رمز عبور اشتباه است.");
        header("Location: /pages/login.php");
        $_SESSION["errors.login"] = $errors;
        die;
    }
} else {
    // We Have Errors
    $_SESSION["errors.login"] = $errors;

    header("Location: /pages/login.php");
    die;
}
