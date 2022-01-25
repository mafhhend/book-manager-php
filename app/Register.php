<?php
session_start();
require("../config/mysql.php");
require("./Validation.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") return;

unset($_SESSION["errors.register"]);
// unset($_SESSION["exception"]);

$vl = new Validation();
$errors = [];

// Get all data FROM REQUES
$nameFamily = $_POST["name-family"];
$email = $_POST["email"];
$password = $_POST["password"];
$passwordConfirmation = $_POST["password-confirmation"];

// Validate The Data
if ($vl->isEmpty($nameFamily)) array_push($errors, "لطفا نام و نام خانوادگی را وارد نمایید.");
if ($vl->isEmpty($email)) array_push($errors, "لطفا ایمیل را وارد نمایید.");
if ($vl->isEmpty($password)) array_push($errors, "لطفا پسورد را وارد نمایید.");
if ($vl->isEmpty($passwordConfirmation)) array_push($errors, "لطفا تکرار پسورد را وارد نمایید.");

if (count($errors) === 0) {
    /* Is the email exists in Database?? */
    $stmt = $pdo->prepare("SELECT * from users WHERE email=:email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch();


    if ($user && count($user) !== 0) {
        array_push($errors, "این ایمیل قبلا به ثبت رسیده است.");
        $_SESSION["errors.register"] = $errors;
        header("Location: /pages/register.php");
        die;
    }

    $sql = "INSERT INTO users (nameFamily, password, email)
    
    VALUES (:nameFamily, :password, :email);";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nameFamily", $nameFamily);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch();
    $_SESSION["user"] = [
        "name" => $nameFamily,
        "email" => $email,
        "id" => $pdo->lastInsertId()
    ];
    unset($_SESSION["errors.login"]);
    header("Location: /");
    die;
} else {
    $_SESSION["errors.register"] = $errors;
    header("Location: /pages/register.php");
}
