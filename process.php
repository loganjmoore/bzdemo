<?php
/**
 * Created by PhpStorm.
 * User: logan_000
 * Date: 4/15/2018
 * Time: 9:19 AM
 */
require_once('config.php');

use Slince\Upload\Uploader;
use Slince\Upload\Exception\UploadException;
use Slince\Upload\FileInfo;

//Process the file data
$uploader = new Uploader('./files');
$uploader->setRandName(true);

try {
    $fileInfo = $uploader->process($_FILES['csv']);

    if ($fileInfo->hasError()) {
        echo $fileInfo->getErrorMsg();
        exit;
    } else {
        $filePath=$fileInfo->getPath();
        echo "Uploaded file is here: <a href='$filePath'>$filePath</a>";
    }
} catch (UploadException $exception) {
    exit($e->getMessage());
}
?>