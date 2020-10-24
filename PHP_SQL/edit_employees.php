<?php 
    require_once('connection.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST ['update_id'];
            $select_stm = $db->prepare("SELECT * FROM tbl_employee WHERE id = :id");
            $select_stm->bindParam(':id',$id);
            $select_stm->execute();
            $row = $select_stm->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        $firstname = $_REQUEST['txt_firstname'];
        $lastname = $_REQUEST['txt_lastname'];
        $nickname = $_REQUEST['txt_nickname'];
        $gender = $_REQUEST['txt_gender'];
        $addresses = $_REQUEST['txt_addresses'];
        $salary = $_REQUEST['num_salary'];
        $title = $_REQUEST['txt_title'];
        $tell = $_REQUEST['tel_tell'];

        if (empty($firstname)) {
            $errormsg = "โปรดกรอก ชื่อ";
        } else if (empty($lastname)) {
            $errormsg = "โปรดกรอก นามสกุล";
        } else if (empty($nickname)) {
            $errormsg = "โปรดกรอก ชื่อเล่น";
        } else if (empty($gender)) {
            $errormsg = "โปรดกรอก เพศ";
        } else if (empty($addresses)) {
            $errormsg = "โปรดกรอก ที่อยู่";
        } else if (empty($salary)) {
            $errormsg = "โปรดกรอก เงินเดือน";
        } else if (empty($title)) {
            $errormsg = "โปรดกรอก ตำแหน่ง";
        } else if (empty($tell)) {
            $errormsg = "โปรดกรอก เบอร์โทร";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE tbl_employee SET firstname = :fname_up, lastname = :lname_up, nickname = :nname_up, gender = :gder_up, addresses = :adress_up, salary = :slary_up, title = :ttle_up, tell = :tel_up WHERE id = :$id");
                    $update_stmt->bindParam(':fname_up', $firstname_up);
                    $update_stmt->bindParam(':lname_up', $lastname_up);
                    $update_stmt->bindParam(':nname_up', $nickname_up);
                    $update_stmt->bindParam(':gder_up', $gender_up);
                    $update_stmt->bindParam(':address_up', $addresses_up);
                    $update_stmt->bindParam(':slary_up', $salary_up);
                    $update_stmt->bindParam(':ttle_up', $title_up);
                    $update_stmt->bindParam(':tel_up', $tell_up);
                    $update_stmt->bindParam(':id', $id);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Record update successfully...";
                        header("refresh:2;employees.php");
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
    <link rel="stylesheet" href="css/cssbootstrap.css.min">
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
                    <label for="firstname" class="col-sm-3 control-lebel">ชื่อ</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_firstname" class="form-control" value="<?php echo $firstname; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-lebel">นามสกุล</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_lastname" class="form-control" value="<?php echo $lastname; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row pt-3">
                    <label for="nickname" class="col-sm-3 control-lebel">ชื่อเล่น</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_nickname" class="form-control" value="<?php echo $nickname; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row pt-3">
                    <label for="gender" class="col-sm-3 control-lebel">เพศ</label>
                    <div class="col-sm-9">
                        <select type="text" name="txt_gender" class="form-control" value="<?php echo $gender; ?>">
                            <option value="ไม่ระบุ">-- โปรดเลือกเพศ -- </option>
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row pt-3">
                    <label for="addresses" class="col-sm-3 control-lebel">ที่อยู่</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_addresses" class="form-control" value="<?php echo $addresses; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row pt-3">
                    <label for="salary" class="col-sm-3 control-lebel">เงินเดือน</label>
                    <div class="col-sm-9">
                        <input type="number" name="num_salary" class="form-control" value="<?php echo $salary; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row pt-3">
                    <label for="title" class="col-sm-3 control-lebel">วิชาที่สอน</label>
                    <div class="col-sm-9">
                        <select name="txt_title" class="form-control" value="<?php echo $title; ?>">
                            <option value="select">-- โปรดเลือกวิชาที่สอน --</option>
                            <option value="ครูสอนกีต้าร์">ครูสอนกีต้าร์</option>
                            <option value="ครูสอนกลอง">ครูสอนกลอง</option>
                            <option value="ครูสอนร้องเพลง">ครูสอนร้องเพลง</option>
                            <option value="ครูสอนเปียโน">ครูสอนเปียโน</option>
                            <option value="ครูสอนเบส">ครูสอนเบส</option>
                            <option value="ครูสอนอูคูเลเล่">ครูสอนอูคูเลเล่</option>
                            <option value="ครูสอนไวโอลีน">ครูสอนไวโอลีน</option>
                            <option value="ครูสอนรวมวง">ครูสอนรวมวง</option>
                            <option value="ครูสอนนมัสการ">ครูสอนนมัสการ</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row pt-3">
                    <label for="tell" class="col-sm-3 control-lebel">เบอร์โทร</label>
                    <div class="col-sm-9">
                        <input type="tel" name="tel_tell" class="form-control" value="<?php echo $tell; ?>">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="col-md-12 col-sm-9 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="employees.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>

        <!--JS-->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/poper.min.js"></script>
</body>

</html>