<?php
global $conn;
session_start();
require_once '../server/index.php';

if($_SESSION['user']['time'] > time()):
    $sql = 'insert into orders (userid, productid, cost) values ('. $_SESSION['user']['user']['id'] .', '.$_POST['id'].', '.$_SESSION['posts'][$_POST['id']-1]['price'].');';
    $result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
</head>
<body>
    <div>Product Added to your Account Successfully!</div>

</body>
</html>

<?php
else:
    header('Location: ./login');
endif;
?>