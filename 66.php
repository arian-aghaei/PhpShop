<?php
require_once 'server/index.php';

var_dump($_FILES);
die();

$fileName = uniqid();

move_uploaded_file($_FILES['reza']['tmp_name'], './public/uploads/profile/' . $fileName);

echo '<br><img src="./public/uploads/profile/' . $fileName.'" />';


$query="update users set profile='$fileName' where  id=1";

if(1)
    $query.='and user="reza"';

$conn->query($query);
$conn->execute_query();