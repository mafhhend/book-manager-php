<?php
require("./app/Index.php");
?>
<?php include("./components/header.php") ?>
<?php if (isset($_SESSION["user"])) : ?>
    <a href="/pages/addBook.php" class="block simple-link">افزودن کتاب</a>
<?php endif ?>

<span>کتاب های موجود:</span>
<div class="flex flex-wrap justify-center items-center m-5">
    <?php foreach ($products as $product) : ?>
        <div class="w-52 mr-3 mt-3 bg-slate-800 p-3 rounded text-white  relative">
            <h3><?= $product["title"] ?></h3>
            <a href="<?= $product['path'] ?>" class="text-blue-500">لینک</a>
            <?php if (isset($_SESSION["user"])) : ?>
                <form action="./app/DeleteBook.php" method="post">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <button class="text-rose-600 absolute text-lg top-[-5px] left-[5px] hover:text-rose-800">&times;</butt>
                </form>
            <a href="./pages/EditBook.php?id=<?=$product['id'] ?>" class="text-gray-400 text-xs absolute bottom-[-40px] left-0">ویرایش</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<?php include("./components/footer.php") ?>