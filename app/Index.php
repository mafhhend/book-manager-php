<?php
require("config/mysql.php");
require("app/Validation.php");
$stmt=$pdo->prepare("SELECT * FROM products");
$stmt->execute();
$products=$stmt->fetchAll();