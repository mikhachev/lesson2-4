<?php
$uploaddir = 'tests/';
if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploaddir .
    $_FILES['userfile']['name'])) {
    print "Файл загружен.";
} else {
    print "Ошибка";
}
?>