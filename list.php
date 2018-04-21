<?php
require_once "functions.php";

rights();
$list = glob('tests/*.json');

if (isset($_POST['delete_test'])) {
    foreach ($list as $i => $value) {
        if ($value == 'tests/' . $_POST['delete_test'] . '.json') {
            unset ($list[$i]);
            sort($list);
            echo "Тест ".$_POST['delete_test']." удален.";
        }
    }
}

?>
<!DOCTYPE>
<html lang="ru">
<head>
    <title>Тестирование</title>
    <meta charset="utf-8">
</head>
<body>
<h1>Список тестов </h1><br>


<?php
foreach (glob("tests/*.json") as $i => $filename) {
    $name = basename($filename);?>
    <label ><a href="test.php?testname=<?= $name ?>">Выбрать тест</a> <?=" ++$i, </br>" ?> </label>
<?php }?>
<?php if (isAuthorizedAdmin()): ?>
    <a href="admin.php">К форме загрузки тестов</a>
    <p>Удаление теста:</p>
    <form method="POST">
        <input type="text" name="delete_test" placeholder="Имя удаляемого теста">
        <input type="submit" value="Удалить">
    </form>
<?php endif; ?>
</body>
</html>



