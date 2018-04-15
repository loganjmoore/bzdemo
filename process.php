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

$dbh = new dbhelper();

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

        switch($header_key)
        {
            case "person_id":

                foreach($records as $record){

                    $params=null;
                    $params[1]=$record["person_id"];
                    $person_exists=$dbh->pGetScalar("SELECT count(1) FROM people WHERE person_id = ?",$params,0);

                    $params=null;
                    $params[1]=$record["person_id"];
                    $params[2]=$record["first_name"];
                    $params[3]=$record["last_name"];
                    $params[4]=$record["email_address"];
                    $params[5]=$record["group_id"];
                    $params[6]=$record["state"];
                    $params[7]=time();

                    if($person_exists===0) {
                        $dbh->pq("INSERT INTO people (person_id,first_name,last_name,email_address,group_id,state,date_modified) VALUES(?,?,?,?,?,?,?)", $params);
                    }else{
                        $params[8]=$record["person_id"];
                        $dbh->pq("UPDATE people SET person_id = ?, first_name = ?, last_name = ?, email_address = ?, group_id = ?, state = ?, date_modified = ? WHERE person_id = ?", $params);
                    }

                }
                unlink($fileInfo->getPath());
                header("Location: index.php");
                exit;
                break;

            case "group_id":

                foreach($records as $record){

                    $params=null;
                    $params[1]=$record["group_id"];
                    $group_exists=$dbh->pGetScalar("SELECT count(1) FROM groups WHERE group_id = ?", $params,0);

                    $params=null;
                    $params[1]=$record["group_id"];
                    $params[2]=$record["group_name"];
                    $params[3]=time();

                    if($group_exists===0) {
                        $dbh->pq("INSERT INTO groups (group_id,group_name,date_modified) VALUES(?,?,?);", $params);
                    }else{
                        $params[4]=$record["group_id"];
                        $dbh->pq("UPDATE groups SET group_id = ?, group_name = ?, date_modified = ? WHERE group_id = ?", $params);
                    }
                }
                unlink($fileInfo->getPath());
                header("Location: index.php");
                exit;
                break;

            default:
                header("Location:index.php");
                exit;
                break;
        }

    }
} catch (UploadException $exception) {
    exit($e->getMessage());
}
?>