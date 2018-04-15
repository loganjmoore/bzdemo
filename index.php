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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>


</head>

<body>

<form action="process.php" method="post" enctype="multipart/form-data">
    <input type="file" name="csv" />
    <input type="submit" value="Upload" />
</form>

<hr />

<?php require_once('groups.php'); ?>

<div id="results">
    <?php require_once('results.php'); ?>
</div>

<script>
    $(document).ready( function () {
        $("#people_table").DataTable();
        $("#selected_group").selectmenu()
            .on('selectmenuchange', function() {

                var group_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: 'results.php?group_id='+group_id,
                    success: function (data) {
                        $('#results').html(data);
                        $("#people_table").DataTable();
                    },
                    dataType: 'html'
                });

            });
    });
</script>

</body>
</html>
