<?php
session_start();
require_once '../server/index.php';

function products($res, $conn)
{
    for($i=0; $i<count($res); $i++){
        $sql = 'select name from products where id = '. $res[$i]['productid'] .';';
        $result = $conn->query($sql);
        $rs = $result->fetch_all(1);
        echo '<div class="flex w-full justify-between mb-3">
                        <p>'.$rs[0]['name'].'</p>
                        <p>'.$res[$i]["COUNT(productid)"].'</p>
                    </div>';
    }
}

if($_SESSION['user']['time'] > time()):
    $sql = 'SELECT productid, COUNT(productid) FROM `orders`
WHERE userid='.$_SESSION['user']['user']['id'].'
GROUP BY (productid);';
    $result = $conn->query($sql);
    $res = $result->fetch_all(1);
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
            <div class="flex flex-col md:flex-row p-4 items-center md:items-start shadow-xl bg-white m-3 mt-0 rounded-lg w-full">
                <img class="w-16 md:w-40 rounded-[50%]" src=<?= $_SESSION['user']['user']['profile'] ? './public/uploads/profile/'.$_SESSION['user']['user']['profile']: 'profile.svg' ?> alt="profile">
                <div class="flex-col my-auto text-center md:text-start">
                    <div class="md:my-auto pb-2 text-2xl md:ps-5"><?= $_SESSION['user']['user']['name'] ?></div>
                    <div class="md:my-auto md:ps-5 text-gray-600"><?= $_SESSION['user']['user']['username'] ?></div>
                </div>
            </div>
            <div class="md:flex text-center md:text-left shadow-xl m-3 mt-0 rounded-lg bg-white w-full p-10 text-xs md:text-base">
                <div class="w-full">
                    <div class="flex w-full justify-between mb-3">
                        <p>Product names</p>
                        <p>Count</p>
                    </div>
                    <?= products($res, $conn) ?>
                </div>
            </div>
        </div>
        <div class="md:basis-1/2 flex flex-col items-center md:items-start p-10 bg-white rounded-lg m-3 mt-0 shadow-xl">
            <a class="account-link my-3" href="./edituser">Change Name</a>
            <a class="account-link my-3" href="./edituser">Change Username</a>
            <a class="account-link my-3" href="./edituser">Change Email</a>
            <a class="account-link my-3" href="./edituser">Change Password</a>
            <a class="account-link my-3" href="./edituser">Change Profile Photo</a>
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