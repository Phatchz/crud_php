<?php 
    require_once('connection.php');

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM tbl_person WHERE id = :id");
        $select_stmt->bindParam(':id',$id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        
        //Delete and original record form db
        $delete_stmt = $db->prepare('DELETE FROM tbl_person WHERE id = :id');
        $delete_stmt->bindParam('id',$id);
        $delete_stmt->execute();
        
        header('Location:index.php');
    }

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


<div class="container">
<div class="display-3 text-center">Information</div>
<a href="add.php" class="btn btn-success mb-3">add+</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Nick Name</th>
                <th>Corse Name</th>
                <th>Date/Time</th>
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
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"]; ?></td>
                        <td><?php echo $row["nickname"]; ?></td>
                        <td><?php echo $row["corsename"]; ?></td>
                        <td><?php echo $row["starttime"]; ?></td>
                        <td><a href="edit.php?update_id=<?php echo $row["id"]; ?>"class="btn btn-warning">Edit</a></td>
                        <td><a href="?delete_id=<?php echo $row["id"]; ?>"class="btn btn-danger">Delete</a></td>
                    </tr>

            <?php } ?>
        </tbody>
    </table>
</div>

<!--JS-->
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="ja/bootstarp.bundle.js"></script>
</body>

</html>