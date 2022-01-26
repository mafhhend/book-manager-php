<?php
session_start();
require("../config/mysql.php");
require("./Validation.php");

if (! isset($_SESSION["user"])) return header("Location: /");
if ($_SERVER["REQUEST_METHOD"] != "POST") return;

$productId=$_POST["id"];

// Remove File:
$stmt=$pdo->prepare("SELECT * from products WHERE id = :id");
$stmt->bindParam(":id",$productId);
$stmt->execute();
$product=$stmt->fetch();
unlink($product["path"]);

// Remove The Book from Database:
$sql="DELETE FROM products WHERE id = :id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":id",$productId);
$stmt->execute();
return header("Location: /");
