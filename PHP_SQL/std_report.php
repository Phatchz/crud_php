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
    <title>DATABASE</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cssbootstrap.css.min">
</head>

<body>
    <?php include 'header.php' ?>


    <div class="container">
        <div class="display-4 text-center mb-3 mt-5" style="background-color: #87CEFA;">Student Information Report</div>
        
        <table class="table ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Nick Name</th>
                    <th>Corse Name</th>
                    <th>Date Time</th>
                    <th>Price</th>
              
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
                    <td><?php echo $row["daytime"]; ?></td>
                    <td><?php echo $row["studentprice"]; ?></td>
                   
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