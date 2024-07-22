<?php

function checkName($name)
{
    return trim($name) !== '';
}


echo $_POST['name'];
print_r($_POST);
if(!checkName($_POST['name'])){
    echo 'invalid name';
}


//header('Location: /register');