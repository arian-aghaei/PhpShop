<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/output.css">
</head>
<body class="" style="background-image: linear-gradient(to right, #ffb6b6, #a9a9ff);">
<div class="container mx-auto justify-center flex mt-[8rem]">
    <form method="post" class="w-1/4 border border-gray-500 bg-white p-5 rounded-lg" action="./checkReg.php">
        <?=
        ($_COOKIE['registered'] != 1) ? '<div class="pt-5"></div>'
            : '<div class="pb-3">
            Created Successfully.
        </div>';

        ?>
        <div class="mb-3">
            <label for="name">Name: </label>
            <input class="form-control" type="text" name="name" id="name" placeholder="name">
        </div>
        <div class="mb-3">
            <label for="email">E-Mail: </label>
            <input class="form-control" type="email" name="email" id="email" placeholder="email">
        </div>
        <div class="mb-3">
            <label for="username">Username: </label>
            <input class="form-control" type="text" id="username" name="username" placeholder="username">
        </div> <!-- !ring-red-600 -->
        <div class="mb-5">
            <label for="password">Password: </label>
            <input class="form-control" type="password" name="password" id="password" placeholder="password">
        </div>
        <div class="flex">
            <button class="rounded-lg px-3 py-1 text-white bg-blue-700 hover:bg-blue-800" type="submit">Register
            </button>
            <div class="ml-auto text-sm my-auto">
                <span class="">or you can</span>
                <a class="rounded-lg px-1 py-1 text-blue-400 hover:text-blue-500" href="/login">Login</a>
            </div>
        </div>
    </form>
</div>

<?php
if ($_COOKIE['errors']):
    ?>
    <script>
        const errors = <?=$_COOKIE['errors']?>;
        Object.keys(errors).forEach(item => {
            document.getElementsByName(item)[0].classList.add('!ring-red-500');
        });
    </script>

<?php
endif;
?>
</body>
</html>