<?php include("../components/header.php") ?>


<?php if (isset($_SESSION["errors.login"])) :  ?>
    <div class="w-full bg-red-900 text-white p-3 text-bold font-bold">
        <?php foreach(($_SESSION["errors.login"]) as $error) :  ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif ?>


<form action="/app/Login.php" method="post" class="m-5" novalidate>
    <h1 class="text-2xl font-bold">ورود</h1>

    <div class="flex justify-center flex-wrap">


        <div class="m-1">
            <label for="email" class="block">ایمیل</label>
            <input name="email" type="email" id="email" class="simple-input">
        </div>

        <div class="m-1">
            <label for="password" class="block">پسورد</label>
            <input name="password" type="password" id="password" class="simple-input">
        </div>

    </div>

    <div>
        <button class="btn-submit">تایید</button>
    </div>

</form>

<?php include("../components/footer.php") ?>