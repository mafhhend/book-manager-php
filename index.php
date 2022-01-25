<?php
require("./app/Index.php");
?>
<?php include("./components/header.php") ?>
<a href="/pages/addBook.php" class="block simple-link">افزودن کتاب</a>
<span>کتاب های موجود:</span>
<div class="flex flex-wrap justify-center items-center m-5">
    <?php foreach($products as $product): ?>
    <div class="w-52 mr-3 mt-3 bg-slate-800 p-3 rounded text-white">
        <h3><?= $product["title"] ?></h3>
        <a href="<?= $product['path'] ?>" class="text-blue-500">لینک</a>
    </div>
    <?php endforeach; ?>
</div>
<?php include("./components/footer.php") ?>