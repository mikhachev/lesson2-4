<?php
session_start();
if (array_key_exists('student', $_POST)):
    $name = $_SESSION['user']['username'];
    $text1 = 'Испытуемый ' . $name   .' ответил на 100% вопросов!';
    $text2 = 'В связи с чем достиг квалификации  Senior Tester ';
    $image = imagecreatetruecolor(566, 800);
    $textColor = imagecolorallocate($image, 111, 45, 44);
    $img = __DIR__.'/src/certificate.png';
    if (!file_exists($img)) {
        echo 'Файл с картинкой не найден!';
        exit;
    }
    $inBox = imagecreatefrompng($img);
    imagecopy($image, $inBox, 0, 0, 0, 0, 566, 800);
    $fontFile = __DIR__ . '/src/times.ttf';
    if (!file_exists($fontFile)) {
        echo 'Файл с картинкой не найден!';
        exit;
    }
    imagettftext($image, 14, 0, 90, 400, $textColor, $fontFile, $text1);
    imagettftext($image, 14, 0, 85, 450, $textColor, $fontFile, $text2);

    header('Content-Type: image/png');
    imagepng($image);
    imagedestroy($image);
endif;
