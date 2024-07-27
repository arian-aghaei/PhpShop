<?php
session_start();
if($_SESSION['user']['time'] > time()):
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $_SESSION['user']['user']['name'] ?></title>
    <link rel="stylesheet" href="/public/css/output.css">
</head>
<body style="background-image: linear-gradient(to bottom right, #d3d3ff, #fdd4d4);background-attachment:fixed; height:100%;">
<div class="container mx-auto">
    <div class="md:flex  mt-10 ">
        <div class="md:basis-1/2 flex flex-col items-center mx-3 md:items-start">
            <div class="flex flex-col md:flex-row p-4 items-center md:items-start shadow-lg bg-white m-3 mt-0 rounded-lg w-full">
                <img class="w-16 md:w-40 rounded-[50%]" src=<?= $_SESSION['user']['profile'] ?? "./profile.svg" ?> alt="profile">
                <a class="account-link md:my-auto md:ps-5"
                   href="">Change Profile Photo</a>
            </div>
            <div class="md:flex text-center md:text-left shadow-lg m-3 mt-0 rounded-lg bg-white w-full p-10 text-xs md:text-base">
                This place could be a text box for showing your description or changing it but not this time LOL!
            </div>
        </div>
        <div class="md:basis-1/2 flex flex-col items-center md:items-start p-10 bg-white rounded-lg m-3 mt-0 shadow-lg">
            <a class="account-link my-3" href="">Change Name</a>
            <a class="account-link my-3" href="">Change Username</a>
            <a class="account-link my-3" href="">Change Email</a>
            <a class="account-link my-3" href="">Change Password</a>
            <form action="../logout.php" method="post">
                <button class="account-link my-3">Log Out</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
else:
    header('Location: ./login');
endif;
?>