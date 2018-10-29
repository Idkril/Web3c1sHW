<?php

$filePath  = $_FILES['file']['tmp_name'];
$errorCode = $_FILES['file']['error'];

if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

    $errorMessages = [
        UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
        UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
        UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
        UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
        UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
    ];

    $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

    $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

    die($outputMessage);
}

$fi = finfo_open(FILEINFO_MIME_TYPE);

$mime = (string) finfo_file($fi, $filePath);

if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

$image = getimagesize($filePath);

$extension = image_type_to_extension($image[2]);

$format = str_replace('jpeg', 'jpg', $extension);

if (!move_uploaded_file($filePath, __DIR__ . '/img_userphoto/' . $_POST['user_upd_id'] . $format)) {
    die('При записи изображения на диск произошла ошибка.');
}
include('DB_conn.php');
$res=mysqli_query($conn,'UPDATE users SET Photo="'.$format.'" WHERE id='.$_POST['user_upd_id']);
?>﻿
