<?php

require_once 'server/index.php';

function checkUser($user, $conn)
{
    $sql = "SELECT username from users where username = '$user'";
    $result = $conn->query($sql);
    return $result->num_rows;
}

function checkPass($user, $pass, $conn)
{
    $sql = "SELECT username, password from users where username = '$user' and password = '$pass'";
    $result = $conn->query($sql);
    return $result->num_rows;
}

function getUser($user, $conn)
{
    $sql = "SELECT * from users where username = '$user'";
    $result = $conn->query($sql);
    return $result->fetch_all(1);
}

$invalidInputs = [];

if(!checkUser($_POST['username'], $conn)){
    $invalidInputs['username'] = false;
    setcookie('errors', json_encode($invalidInputs), time() + 3);
    header('Location: ./login');
}
else if(!checkPass($_POST['username'], md5($_POST['password']), $conn)){
    $invalidInputs['password'] = false;
    setcookie('errors', json_encode($invalidInputs), time() + 3);
    header('Location: ./login');
}
else{
    session_start();
    $_SESSION['user'] = [
        'user'=>getUser($_POST['username'], $conn)[0],
        'time' => time()+ 3600
    ];
    header('Location: .');
}