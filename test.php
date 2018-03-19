
<!DOCTYPE>
<html lang="ru">
<head>
    <title>Прохождение теста</title>
    <meta charset="utf-8">
</head>
<body>


<?php

require_once "functions.php";
$student=$_SESSION['user']['username'];
if (!isAuthorizedUser()) {
echo "Вы не авторизованы.";
echo '<p><a href="index.php"> Авторизоваться </a><p>';
    http_response_code(403);
    die;
    }?>

<h1 ><?php echo $student ?>, решите тест</h1>
<?php $testing = null;
$testid = null;
if (file_exists($_GET['testname'])==false) {
        header("HTTP/1.1 404 Not Found");
        echo "<p style='color:red;'>Тест не найден!</p>";
        exit(1);
    }
    $var = empty($_POST);
    if ($var == true) {
        echo "Продолжайте решать тест";
    }
    $list=glob("tests/*.json");
    $testname = $_GET['testname'];
    $jsontest = file_get_contents('tests/'.$testname);
    $testarray = json_decode($jsontest, true);
    $_SESSION['test'] = $testarray;
    $testing = true;
?>


  <form method="POST" >
    <?php foreach ($testarray as  $value) { ?>
        <fieldset>
            <legend><?= $label = $value['question'] ?></legend>
            <?php foreach ($value['answers'] as $item => $atom) { ?>
                <input type="radio" name="<?php echo $atom['name']?>" value="<?php echo $atom['value']?>" >
                <?= $atom['answer'] ?><br>
            <?php } ?>
        </fieldset>
    <?php }?>
    <input type="submit" name='student' value="Проверить">
  </form>
<?php
if  ($var <> true){
    $ball = 0;
    if ($_POST['q1'] == 2){$ball++;}
    if ($_POST['q2'] == 2){$ball++;}
    if($ball == 2 ) {?>
        <b><p>Все ответы правильные, тест пройден</p>
            <p>Для получения сертификата нажмите кнопку согласия с лицензинным договором</p></b>
        <form action="certificate.php" method="post">

            <input type="submit" name="student" value="Ок">
        </form>
    <?php }
    elseif($ball == 1 ) {
        echo 'Один из ответов неверный, поднажмите, тест не пройден';
    } else { echo 'Все ответы неверны, тест не пройден';}

}?>
</body>
</html>

