<?php

require_once 'server/index.php';

function checkName($name)
{
    return trim($name) !== '';
}

function checkEmail($email)
{
    return  filter_var($email,FILTER_VALIDATE_EMAIL);
}

/**
 * @param $username
 * @param $conn
 * @return bool|mysqli_result
 */
function checkUsername($username,$conn)
{
    $sql = "SELECT username from users where username = '$username'";
    $result = $conn->query($sql);
    return !$result->num_rows;
}

function checkPassword($password)
{
    $password = trim($password);
    if(strlen($password) < 8){
        return false;
    }
    else if(!preg_match("/[0-9]+/",$password)){
        return false;
    }
    elseif(!preg_match("/[A-Z]+/",$password)) {
        return false;
    }
    elseif(!preg_match("/[a-z]+/",$password)) {
        return false;
    }
    return true;
}

$invalidInputs = [];

if(!checkName($_POST['name']))
    $invalidInputs['name'] = false;

if(!checkEmail($_POST['email']))
    $invalidInputs['email'] = false;

if(!checkUsername($_POST['username'], $conn))
    $invalidInputs['username'] = false;

if(!checkPassword($_POST['password']))
    $invalidInputs['password'] = false;

if (count($invalidInputs)===0){
    $sql = "INSERT into users(name, username, email, password) 
VALUES('{$_POST['name']}', '{$_POST['username']}', '{$_POST['email']}', '{$_POST['password']}')";
    if(!$conn->query($sql))
        die('failed to create data');
    setcookie('registered' , 1, time()+3);
    header('Location: ./register');
}else{
    setcookie('errors', json_encode($invalidInputs), time() + 3);
    header('location: ./register');
}


//header('Location: /register');