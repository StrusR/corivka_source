<?php
session_start();
$my_ip = $_SESSION['ip'];
session_write_close();
$allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // Допустимые типы файлов
$max_filesize = 524288*2; // Максимальный размер файла в байтах (в данном случае он равен 0.5 Мб).
$upload_path = './avatar/'; // Папка, куда будут загружаться файлы .
$filename = $my_ip.".jpg"; // В переменную $filename заносим имя файла (включая расширение).
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // В переменную $ext заносим расширение загруженного файла.

if(!in_array($ext,$allowed_filetypes)) // Сверяем полученное расширение со списком допутимых расширений. 
die('Данный тип файла не поддерживается.');

if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize) // Проверим размер загруженного файла.
die('Фаил слишком большой.');

if(!is_writable($upload_path)) // Проверяем, доступна ли на запись папка.
die('Невозможно загрузить фаил в папку. Установите права доступа - 777.');

// Загружаем фаил в указанную папку.
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . $filename)) {
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    $mysqli -> query("UPDATE `users` SET `avatar` = '".$my_ip.".jpg' WHERE `users`.`ip` = '".$my_ip."'");
    header("Location: https://corivka.com.ua/personal/user.php?ip=".$my_ip);
} else {
    header("Location: https://corivka.com.ua/personal/user.php?ip=".$my_ip);
}

?>