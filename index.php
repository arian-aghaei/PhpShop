<?php
session_start();
require_once 'server/index.php';

function profileSection(): string
{
    if (isset($_SESSION['user']) && $_SESSION['user']['time'] > time())
        return '<div class="ml-auto my-auto flex gap-3">
            <form class="my-auto" action="logout.php" method="post">
                <button class="hover:underline hover:text-blue-800" >log out</button>
            </form>
            <a class="my-auto hover:underline hover:text-blue-800" href="account">' . $_SESSION['user']['user']['name'] . '</a>
            <img class="w-8 md:w-10 rounded-[50%]" src="' . ($_SESSION['user']['user']['profile'] ? './public/uploads/profile/' . $_SESSION['user']['user']['profile'] : 'profile.svg') . '" alt="">
        </div>';
    else
        return '<div class="ml-auto my-auto gap-3 flex">
            <a class="rounded-lg px-3 py-1 text-white bg-blue-700 hover:bg-blue-800" href="login" >Login</a>
            <a class="rounded-lg px-3 py-1 text-white bg-blue-700 hover:bg-blue-800" href="register">Sign Up</a>
        </div>';
}

function allPosts($conn)
{
    $sql = "SELECT * from products where count>0";
    $result = $conn->query($sql);
    return $result->fetch_all(1);
}

function posts()
{
    global $conn;
    $products = allPosts($conn);
    $_SESSION['posts'] = $products;
    for($id = 1; $id <= count($products); $id++){
        $img = $products[$id-1]['picture'] ?? 'image.jpeg';
        echo '<div class="bg-white rounded-lg">
            <img class="mx-auto my-5" src="'. $img .'" alt="image">
            <form method="post" class="flex-row flex mb-5 mx-8" action="buying.php">
                <span class="my-auto">'. $products[$id-1]['name'] .'</span>
                <input type="hidden" name="id" value="'. $products[$id-1]['id'] .'" >
                <button class="ml-auto justify-end rounded-lg px-3 py-1 text-white bg-black hover:text-gray-400"
                        type="submit">buy
                </button>
            </form>
        </div>';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="/public/css/output.css">
</head>
<body class="bg-gray-100">
<header class="bg-white flex gap-2 px-4 md:px-10 py-5 sticky top-0">
    <img class="w-8 md:w-12" src="icon.png" alt="">
    <ul class="hidden md:flex md:gap-3 ms-10 my-auto">
        <li><a class="hover:text-blue-800 hover:underline" href="">home page</a></li>
        <li><a class="hover:text-blue-800 hover:underline" href="">shop</a></li>
        <li><a class="hover:text-blue-800 hover:underline" href="">about us</a></li>
    </ul>
    <span class="visible md:hidden font-bold my-auto">phpShop</span>
    <?= profileSection() ?>
</header>
<div class="container mx-auto my-6">
    <div class="grid grid-cols-4 gap-6">
        <?= posts() ?>
    </div>
</div>
</body>
</html>