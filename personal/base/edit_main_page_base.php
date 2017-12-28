<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $menuTypeHead = array();
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    
    $data_server = $mysqli -> query("SELECT * FROM `Main`");
    $i = 0;
    while (($all = $data_server->fetch_assoc()) != false) {
        if ($all['type'] == "paragraph") {
            if(!empty($_POST['paragraphUa'.$all['id']]) && !empty($_POST['paragraphEn'.$all['id']]) && !empty($_POST['paragraphPl'.$all['id']])) {
                $mysqli -> query("UPDATE `Main` SET `paragraphUa` = '".$_POST['paragraphUa'.$all['id']]."' WHERE `Main`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `Main` SET `paragraphEn` = '".$_POST['paragraphEn'.$all['id']]."' WHERE `Main`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `Main` SET `paragraphPl` = '".$_POST['paragraphPl'.$all['id']]."' WHERE `Main`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `Main` SET `sequence` = '".$_POST['sequence'.$all['id']]."' WHERE `Main`.`id` = '".$all['id']."'");
            } else {
                $mysqli -> query("DELETE FROM `Main` WHERE `Main`.`id` = '".$all['id']."'");
            }
            
        } else {
            if(!empty($_POST['alt'.$all['id']])) {
                $mysqli -> query("UPDATE `Main` SET `alt` = '".$_POST['alt'.$all['id']]."' WHERE `Main`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `Main` SET `width` = '".$_POST['width'.$all['id']]."' WHERE `Main`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `Main` SET `imageFloat` = '".$_POST['imageFloat'.$all['id']]."' WHERE `Main`.`id` = '".$all['id']."'");                
                $mysqli -> query("UPDATE `Main` SET `sequence` = '".$_POST['sequence'.$all['id']]."' WHERE `Main`.`id` = '".$all['id']."'");
            } else {
                if (unlink($_SERVER['DOCUMENT_ROOT'].'/personal/base/main/'.$all['image'])) {
                    $mysqli -> query("DELETE FROM `Main` WHERE `Main`.`id` = '".$all['id']."'");
                }
            }
            
        }
        $i++;
    }
    if($_POST['newParagraphUa'] && $_POST['newParagraphEn'] && $_POST['newParagraphPl'] && $_POST['newParagraphSequence']) {
        $mysqli -> query("INSERT INTO `Main` (`paragraphUa`, `paragraphEn`, `paragraphPl`, `type`, `sequence`) VALUES ('".$_POST['newParagraphUa']."', '".$_POST['newParagraphEn']."', '".$_POST['newParagraphPl']."', 'paragraph', '".$_POST['newParagraphSequence']."')");
    }
    if($_POST['newAlt']) {
        $allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // Допустимые типы файлов
        $max_filesize = 524288*2; // Максимальный размер файла в байтах (в данном случае он равен 1 Мб).
        $upload_path = './main/'; // Папка, куда будут загружаться файлы .
        $filename = time().".jpg"; // В переменную $filename заносим имя файла (включая расширение).
        $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // В переменную $ext заносим расширение загруженного файла.
        
        if(!in_array($ext,$allowed_filetypes)) // Сверяем полученное расширение со списком допутимых расширений. 
        die('Данный тип файла не поддерживается.');
        
        if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize) // Проверим размер загруженного файла.
        die('Фаил слишком большой.');
        
        if(!is_writable($upload_path)) // Проверяем, доступна ли на запись папка.
        die('Невозможно загрузить фаил в папку. Установите права доступа - 777.');
        
        // Загружаем фаил в указанную папку.
        if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path.$filename)) {
            $mysqli -> query("INSERT INTO `Main` (`image`, `alt`, `width`, `imageFloat`, `type`, `sequence`) VALUES ('".$filename."', '".$_POST['newAlt']."', '".$_POST['newWidth']."', '".$_POST['newImageFloat']."', 'image', '".$_POST['newImageSequence']."')");
        }
    }

    header("Location: https://corivka.com.ua/personal/edit_main_page.php");
}
?>