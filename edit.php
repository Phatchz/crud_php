<?php 
    require_once('connection.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST ['update_id'];
            $select_stm = $db->prepare("SELECT * FROM tbl_person WHERE id = :id");
            $select_stm->bindParam(':id',$id);
            $select_stm->execute();
            $row = $select_stm->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        $firstname_up = $_REQUEST['txt_firstname'];
        $lastname_up = $_REQUEST['txt_lastname'];
        $nickname_up = $_REQUEST['txt_nickname'];
        $corsename_up = $_REQUEST['txt_corsename'];
        $starttime_up = $_REQUEST['txt_starttime'];

        if (empty($firstname_up)) {
            $errorMsg = "Please Enter Firstname";
        }else if (empty($lastname_up)) {
            $errorMsg = "Please Enter Lastname";
        }else if (empty($nickname_up)) {
            $errorMsg = "Please Enter Nickname";
        }else if (empty($corsename_up)) {
            $errorMsg = "Please Enter CorseName";
        }else if (empty($starttime_up)) {
            $errorMsg = "Please Enter DateTime";
        }else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE tbl_person SET firstname = :fname_up, lastname = :lname_up, corsename_up = :cname, starttime = :stime_up WHERE id = :id");
                    $update_stmt->bindParam(':fname_up', $firstname_up);
                    $update_stmt->bindParam(':lname_up', $lastname_up);
                    $update_stmt->bindParam(':nname_up', $nickname_up);
                    $update_stmt->bindParam(':cname_up', $corsename_up);
                    $update_stmt->bindParam(':stime_up', $starttime_up);
                    $update_stmt->bindParam(':id', $id);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Record update successfully...";
                        header("refresh:2;index.php");
                    }
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
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
    <div class="display-3 text-center">Edit Page</div>

    <?php
        if (isset($errormsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Worng <?php echo $errormsg ?></strong>
        </div>
    <?php } ?>


    <?php
        if (isset($updateMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $updateMsg ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizental mt-5">

            <div class="form-grop text-center">
                <div class="row mb-3">
                    <label for="firstname" class="col-sm-3 control-lebel">Firstname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_firstname" class="form-control" value="<?php echo $firstname; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-lebel">Lastname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_lastname" class="form-control" value="<?php echo $lastname; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row pt-3">
                    <label for="nickname" class="col-sm-3 control-lebel">Nickname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_nickname" class="form-control" value="<?php echo $nickname; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row pt-3">
                    <label for="corsename" class="col-sm-3 control-lebel">Corsename</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_corsename" class="form-control" value="<?php echo $corsename; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row pt-3">
                    <label for="starttime" class="col-sm-3 control-lebel">Date/Time</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_starttime" class="form-control" value="<?php echo $starttime; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="col-md-12 col-sm-9 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>

    </form>

<!--JS-->
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="ja/bootstarp.bundle.js"></script>
</body>
</html>