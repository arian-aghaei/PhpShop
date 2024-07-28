<?php

session_start();
require_once 'server/index.php';

function checkName($name)
{
    return trim($name) !== '';
}

function checkEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param $username
 * @param $conn
 * @return bool|mysqli_result
 */
function checkUsername($username, $conn)
{
    if (trim($username) == '')
        return false;
    $sql = "SELECT username from users where username = '$username'";
    $result = $conn->query($sql);
    return !$result->num_rows;
}

function checkPassword($password)
{
    $password = trim($password);
    if (strlen($password) < 8) {
        return false;
    } else if (!preg_match("/[0-9]+/", $password)) {
        return false;
    } elseif (!preg_match("/[A-Z]+/", $password)) {
        return false;
    } elseif (!preg_match("/[a-z]+/", $password)) {
        return false;
    }
    return true;
}

$invalidInputs = [];

if($_FILES['profile']['name']){
    $fileName = uniqid();
    $allowed = array('gif', 'png', 'jpg');
    $file = $_FILES['profile']['name'];
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    if (in_array($ext, $allowed)){
        move_uploaded_file($_FILES['profile']['tmp_name'], './public/uploads/profile/' . $fileName);
        $query='update users set profile="'.$fileName.'" where  username="'.$_SESSION['user']['user']['username'].'";';
        $conn->query($query);
        $_SESSION['user']['user']['profile'] = $fileName;
    }
    else
        $invalidInputs['profile'] = false;
}

if(!checkName($_POST['name']))
    $invalidInputs['name'] = false;

if(!checkEmail($_POST['email']) && $_POST['email'])
    $invalidInputs['email'] = false;

if(!checkUsername($_POST['username'], $conn) && $_POST['username']!==$_SESSION['user']['user']['username'])
    $invalidInputs['username'] = false;

if(!checkPassword($_POST['password']) && $_POST['password'])
    $invalidInputs['password'] = false;


if(count($invalidInputs)===0){
    if($_POST['password']!=="") {
        $sq = 'update users set password="' . md5($_POST['password']) . '" where username="' . $_SESSION['user']['user']['username'] . '";';
        $res = $conn->query($sq);
        $_SESSION['user']['user']['password'] = md5($_POST['password']);
    }


    $sql = 'update users set name="'.$_POST['name'].'", username="'.$_POST['username'].'", email="'.$_POST['email'].'" where username="'.$_SESSION['user']['user']['username'].'";';

    $res = $conn->query($sql);
    $_SESSION['user']['user']['name'] = $_POST['name'];
    $_SESSION['user']['user']['username'] = $_POST['username'];
    $_SESSION['user']['user']['email'] = $_POST['email'];
    header('Location: ./account');
}else{
    setcookie('errors', json_encode($invalidInputs), time() + 3);
    header('location: ./edituser');
}
