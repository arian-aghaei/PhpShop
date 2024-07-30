<?php
global $conn;
session_start();
require_once 'server/index.php';

if($_SESSION['user']['time'] > time()) {
    $index = -1;
    for($i=0; $i<count($_SESSION['posts']); $i++){
        if($_SESSION['posts'][$i]['id'] === $_POST['id']){
            $index = $i;
            break;
        }
    }
    $sql = 'insert into orders (userid, productid, cost) values (' . $_SESSION['user']['user']['id'] . ' , ' . $_POST['id'] . ' , ' . $_SESSION['posts'][$index]['price'] . ');';
    $result = $conn->query($sql);
    $sql = 'UPDATE products set count = count-1 where id=' . $_POST['id'] . ' and count > 0 ;';
    $result = $conn->query($sql);
    header('Location: ./order');
}
else
    header('Location: ./login');
