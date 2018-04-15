<?php
/**
 * Created by PhpStorm.
 * User: logan_000
 * Date: 4/15/2018
 * Time: 9:16 AM
 */
require_once('config.php');
?>

<html>
<head>
    <title>Breeze Demo</title>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>


</head>

<body>

<form action="process.php" method="post" enctype="multipart/form-data">
    <input type="file" name="csv" />
    <input type="submit" value="Upload" />
</form>

<hr />

<div id="results">
    <table id="people_table" class="display">
        <thead>
        <tr>
            <th>Person Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Group Id</th>
            <th>State</th>
        </tr>
        </thead>
        <tbody>

        <?php

        $dbh = new dbhelper();
        $params=null;
        $results = $dbh->pGetResults("select person_id, first_name, last_name, email_address, group_id, state, date_modified FROM people", $params);

        foreach($results as $row) {

            $person_id=$row["person_id"];
            $first_name=$row["first_name"];
            $last_name=$row["last_name"];
            $email=$row["email_address"];
            $group_id=$row["group_id"];
            $state=$row["state"];

            echo "<tr>
                      <td>$person_id</td>
                      <td>$first_name</td>
                      <td>$last_name</td>
                      <td>$email</td>
                      <td>$group_id</td>
                      <td>$state</td>
                  </tr>";
        }
        ?>

        </tbody>
    </table>
</div>

<script>
    $(document).ready( function () {
        $("#people_table").DataTable();
    });
</script>

</body>
</html>
