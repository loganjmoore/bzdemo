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
    require_once('config.php');
    $group_id=$_GET["group_id"];

    $dbh = new dbhelper();

    if(!empty($group_id)) {
        $params = null;
        $params[1] = $group_id;
        $results = $dbh->pGetResults("select person_id, first_name, last_name, email_address, group_id, state, date_modified FROM people WHERE group_id = ?", $params);
    }else{
        $params = null;
        $results = $dbh->pGetResults("select person_id, first_name, last_name, email_address, group_id, state, date_modified FROM people", $params);
    }

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