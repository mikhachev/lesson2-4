<?php
require_once "functions.php";

if (!isAuthorizedUser()) {
    echo "Вы не авторизованы.";
    echo '<p><a href="index.php"> Авторизоваться </a><p>';
    http_response_code(403);
    die;
}
else {
    echo '<p>Привет, '. htmlspecialchars($_SESSION['user']['username']).'. <a href="logout.php"> Выйти </a><p>';
}
$list = glob('tests/*.json');

if (isset($_POST['testdel'])) {
    foreach ($list as $i => $value) {
        if ($value == 'tests/' . $_POST['testdel'] . '.json') {
            unset ($list[$i]);
            sort($list);
            echo "Тест ".$_POST['testdel']." удален.";
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
/*$dir ='tests/';
$list=glob("tests/*.json");
$z=count(glob("tests/*.json"));
$x=0;
echo "Загруженные тесты: ". "<br/><br/>";
do {
    echo $list[$x], "- Тест № ", $x+1, <a href="test.php?testname=<?= $name ?>">Выбрать тест</a>"</br>";

}   while ($x++<=$z);


*/?><!--
<h2>Введите номер теста для его прохождения</h2>
<!--<form action="test.php?testNumber=1" method="get">
    <label>
        <input type="text" name="testNumber">
    </label>
    <input type="submit" value="Пройти тест" >
</form>-->

<?php
foreach (glob("tests/*.json") as $i => $filename) {
    $name = basename($filename);?>
    <label ><a href="test.php?testname=<?= $name ?>">Выбрать тест</a> <?= ++$i, "</br>" ?> </label>

<?php }?>
</body>
</html>



