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
use League\Csv\Reader;
use League\Csv\Statement;

//Process the file data
$uploader = new Uploader('./files');
$uploader->setRandName(true);

try {
    $fileInfo = $uploader->process($_FILES['csv']);

    if ($fileInfo->hasError()) {
        echo $fileInfo->getErrorMsg();
        exit;
    } else {

        $csv = Reader::createFromPath($fileInfo->getPath(), 'r');
        $csv->setHeaderOffset(0);

        $stmt = new Statement();
        $records = $stmt->process($csv);

        $header = $records->getHeader();
        $header_key = trim($header[0]);

        echo "<b>Header Key is:</b> $header_key <br />";

        foreach($records as $record)
        {
            echo json_encode($record)."<hr />";
        }

    }
} catch (UploadException $exception) {
    exit($e->getMessage());
}
?>