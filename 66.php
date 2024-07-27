<?php
var_dump($_FILES['img']);
echo '<br><img src="'. $_FILES['img']['full_path'] .'" />'
?>