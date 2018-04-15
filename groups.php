<?php
/**
 * Created by PhpStorm.
 * User: logan_000
 * Date: 4/15/2018
 * Time: 10:57 AM
 */
require_once('config.php');

$dbh = new dbhelper();
$params=null;
$group_results=$dbh->pGetResults("select group_id, group_name, date_modified FROM groups",$params);

echo "<label for='speed'>Select a group</label>
<select name='selected_group' id='selected_group'>
    <option value=''>All</option>";

foreach($group_results as $row) {

    $group_id=$row["group_id"];
    $group_name=$row["group_name"];

    echo "<option value='$group_id'>$group_name</option>";
}

echo "</select>";

?>