<?php
session_start();
require("../config/mysql.php");
require("./Validation.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") return;

unset($_SESSION["errors.book"]);

$title = $_POST["title"];
$file = $_FILES["file"];
$path = "../public/uploads/";
// Make this Dir if doesn't exist.
if (!is_dir($path)) mkdir($path);
// if
$fullName = $file["name"];


$fullPath = $path . $fullName;

$stmt = $pdo->prepare("INSERT INTO products (title, user_id, path) VALUES (:title, :user_id, :path);");

$stmt->bindParam(":title", $title);
$stmt->bindParam(":user_id", $_SESSION["user"]["id"]);
$stmt->bindParam(":path", $fullPath);

if (move_uploaded_file($file["tmp_name"], $path . $fullName)) {
    $stmt->execute();
    $_SESSION["success.book"] = "کتاب مورد نظر با موفقیت افزوده شد.";
}

header("Location: /");

die;
