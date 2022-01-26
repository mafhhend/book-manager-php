<?php include("../app/EditBook.php") ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/components/header.php") ?>

<?php if (isset($_SESSION["errors.book"])) :  ?>
    <div class="w-full bg-red-900 text-white p-3 text-bold font-bold">
        <?php foreach (($_SESSION["errors.book"]) as $error) :  ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif ?>

<form action="../app/UpdateBook.php?id=<?= $product['id'] ?>" method="post" class="m-5" novalidate enctype="multipart/form-data">
    <h1 class="text-2xl font-bold">ویرایش کتاب</h1>

    <div class="flex justify-center flex-wrap">

        <div class="m-1">
            <label for="title" class="block">نام کتاب</label>
            <input name="title" value="<?= $product['title'] ?>" type="text" id="title" class="simple-input">
        </div>


        <div class="m-1">
            <label for="file" class="block">فایل کتاب</label>
            <input name="file" type="file" id="file" class="simple-input">
            <a href="<?= $product['path'] ?>" class="text-blue-400">لینک فایل</a>

        </div>

    </div>

    <div>
        <button class="btn-submit">تایید</button>
    </div>

</form>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/components/footer.php") ?>