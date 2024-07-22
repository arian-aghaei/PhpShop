<?php

function nameCheck($name)
{
    return trim($name) !== '';
}


var_dump(nameCheck('   '));
var_dump(nameCheck(null));


//header('Location: /register');