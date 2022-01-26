<?php
session_start();
require("../config/mysql.php");
require("./Validation.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") return;

unset($_SESSION["errors.book"]);

$errors = [];
$title = $_POST["title"];
$file = $_FILES["file"];

// Validation File
$exploded = explode('.', $file['name']); // saman.png
// item 0 => saman
// item 1 => png
if ($exploded[count($exploded) - 1] !== "pdf") {
    array_push($errors, "تنها پسوند قابل قبول pdf می باشد.");
    $_SESSION["errors.book"] = $errors;
    header("Location: /pages/addBook.php");
    die;
}

$vl = new Validation();
if ($vl->isEmpty($title)) array_push($errors, "لطفا عنوان کتاب را انتخاب نمایید.");

if (count($errors) === 0) {
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
        unset($_SESSION["errors.book"]);
    }

    header("Location: /");
    die;
} else {
    $_SESSION["errors.book"] = $errors;
    header("Location: /");
    die;
}
