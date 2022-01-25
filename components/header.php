<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐧</title>
    <link rel="stylesheet" href="../public/app.css">
</head>

<body>

    <nav id="navbar" class="flex justify-between items-center">
        <ul>
            <li><a class="brand-title" href="/">کتاب فروشی پنگوئن ها</a></li>
        </ul>
        <?php if (!isset($_SESSION["user"])) : ?>
            <ul class="flex">
                <li>
                    <a href="/pages/login.php" class="simple-link">ورود</a>
                    /
                    <a href="/pages/register.php" class="simple-link">ثبت نام</a>
                </li>
            </ul>
        <?php else : ?>
            <ul class="flex relative">
                <li>خوش آمدید</li>
                ,
                <li class="text-blue-700"><?= $_SESSION["user"]['name'] ?></li>

                <li><a href="/pages/logout.php" title="خروج" id="logout" class="absolute">خروج</a></li>
            </ul>

        <?php endif; ?>
    </nav>

    <?php if (isset($_SESSION["exception"])) :  ?>
        <div class="bg-black"><?= $_SESSION["exception"] ?></div>
    <?php endif ?>