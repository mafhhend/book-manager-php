<?php
session_start();
require("../config/mysql.php");
require("./Validation.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") return;
$errors = [];
unset($_SESSION["errors.book"]);

$productId = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->bindParam(":id", $productId);
$stmt->execute();
$product = $stmt->fetch();


$title = $_POST["title"];
$file = $_FILES["file"];

if (isset($file) && $file["error"] == 0) {
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

    $stmt = $pdo->prepare("UPDATE products SET title = :title, user_id = :user_id, path = :path WHERE id = $productId");

    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":user_id", $_SESSION["user"]["id"]);
    $stmt->bindParam(":path", $fullPath);

    if (isset($file) && $file['error'] === 0 && move_uploaded_file($file["tmp_name"], $path . $fullName)) {
        unlink($product["path"]);
        unset($_SESSION["errors.book"]);
    }
    $stmt->execute();

    header("Location: /");
    die;
} else {
    $_SESSION["errors.book"] = $errors;
    var_dump("ELSE");
    die;
}
