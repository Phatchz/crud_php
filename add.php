<?php 
    require_once('connection.php');

    if (isset($_REQUEST['btn_insert'])) {
        $firstname = $_REQUEST['txt_firstname'];
        $lastname = $_REQUEST['txt_lastname'];
        $nickname = $_REQUEST['txt_nickname'];
        $corsename = $_REQUEST['txt_corsename'];
        $starttime = $_REQUEST['txt_starttime'];

        if (empty($firstname)) {
            $errormsg = "Please enter Firstname";
        } else if (empty($lastname)) {
            $errormsg = "Please enter Lastname";
        } else if (empty($nickname)) {
            $errormsg = "Please enter Nickname";
        } else if (empty($corsename)) {
            $errormsg = "Please enter Corsename";
        } else if (empty($starttime)) {
            $errormsg = "Please enter DateTime";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $db->prepare("INSERT INTO tbl_person(firstname, lastname, corsename,starttime) VALUE (:fname, :lname, :cname, :stime)");
                    $insert_stmt->bindParam(':fname', $firstname);
                    $insert_stmt->bindParam(':lname', $lastname);
                    $insert_stmt->bindParam(':nname', $nickname);
                    $insert_stmt->bindParam(':cname', $corsename);
                    $insert_stmt->bindParam(':stime', $starttime);

                   if ($insert_stmt->execute()) {
                       $insertMsg = "Insert Seccessfully...";
                       header("refresh:2;index.php");
                    }
                }
            } catch (PDOException $e) {
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
    <div class="display-3 text-center">Add+</div>

    <?php
        if (isset($errormsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Worng <?php echo $errormsg ?></strong>
        </div>
    <?php } ?>

    <?php
        if (isset($insertMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $insertMsg ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizental mt-5">

            <div class="form-grop text-center">
                <div class="row mb-3">
                    <label for="firstname" class="col-sm-3 control-lebel">Firstname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_firstname" class="form-control" placeholder="Enter Firstname...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row mb-3">
                    <label for="lastname" class="col-sm-3 control-lebel">Lastname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_lastname" class="form-control" placeholder="Enter Lastname...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row mb-3">
                    <label for="nickname" class="col-sm-3 control-lebel">Nickname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_nickname" class="form-control" placeholder="Enter Nickname...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row">
                    <label for="corsename" class="col-sm-3 control-lebel">Corsename</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_corsename" class="form-control" placeholder="Enter Corsename...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row">
                    <label for="starttime" class="col-sm-3 control-lebel">Date/Time</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_starttime" class="form-control" placeholder="Enter Time...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="col-md-12 col-sm-9 mt-3">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
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