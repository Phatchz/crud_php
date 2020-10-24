<?php 
    require_once('connection.php');

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM tbl_employee WHERE id = :id");
        $select_stmt->bindParam(':id',$id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        
        //Delete and original record form db
        $delete_stmt = $db->prepare('DELETE FROM tbl_employee WHERE id = :id');
        $delete_stmt->bindParam('id',$id);
        $delete_stmt->execute();
        
        header('Location:employees.php');
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATABASE</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cssbootstrap.css.min">
</head>

<body>
    <?php include 'header.php' ?>

    <div class="container"><h2 class="display-4 text-center mt-5" style="background-color: #E6E6FA">Employee Infomation</h2></div>
    <div class="container">
        <div class="display-3 text-center">  </div>
        <a href="add_employees.php" class="btn btn-success mb-3">add+</a>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Nick name</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Subject</th>
                    <th>tell</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $select_stmt = $db->prepare("SELECT * FROM tbl_employee");
                $select_stmt->execute();

                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {

            ?>

                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["firstname"]; ?></td>
                    <td><?php echo $row["lastname"]; ?></td>
                    <td><?php echo $row["nickname"]; ?></td>
                    <td><?php echo $row["gender"]; ?></td>
                    <td><?php echo $row["addresses"]; ?></td>
                    <td><?php echo $row["salary"]; ?></td>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["tell"]; ?></td>
                    <td><a href="edit_employees.php?update_id=<?php echo $row["id"]; ?>" class="btn btn-warning">Edit</a></td>
                    <td><a href="?delete_id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>

    <!--JS-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/poper.min.js"></script>
</body>

</html>