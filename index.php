<?php 
    require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPSQL</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.css.min">
</head>
<body>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Edit Name</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                $select_stmt = $db->prepare("SELECT * FROM tbl_person");
                $select_stmt->execute();

                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {

            ?>

                    <tr>
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"];?></td>
                        <td><a href="edit.php?update_id=<?php echo $row["id"];?>"class="btn btn-warning">Edit</a></td>
                        <td><a href="?delete_id=<?php echo $row["id"];?>"class="btn btn-danger">Delete</a></td>
                    </tr>

            <?php } ?>
        </tbody>
    </table>




<!--JS-->
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="ja/bootstarp.bundle.js"></script>
</body>

</html>