<?php
require("../config/mysql.php");


$productId = $_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->bindParam(":id", $productId);
$stmt->execute();
$product = $stmt->fetch();
