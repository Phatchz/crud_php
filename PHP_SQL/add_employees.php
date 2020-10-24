<?php 
    require_once('connection.php');

    if (isset($_REQUEST['btn_insert'])) {
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
                    $insert_stmt = $db->prepare("INSERT INTO tbl_employee (firstname, lastname, nickname, gender, addresses, salary, title ,tell) VALUE (:fname, :lname, :nname, :gder, :adress, :slary, :ttle, :tel)");
                    $insert_stmt->bindParam(':fname', $firstname);
                    $insert_stmt->bindParam(':lname', $lastname);
                    $insert_stmt->bindParam(':nname', $nickname);
                    $insert_stmt->bindParam(':gder', $gender);
                    $insert_stmt->bindParam(':adress', $addresses);
                    $insert_stmt->bindParam(':slary', $salary);
                    $insert_stmt->bindParam(':ttle', $title);
                    $insert_stmt->bindParam(':tel', $tell);
                
                   if ($insert_stmt->execute()) {
                       $insertMsg = "Insert Seccessfully...";
                       header("refresh:2;employees.php");
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
    <link rel="stylesheet" href="css/cssbootstrap.css.min">
</head>

<body>

    <div class="container">
        <div class="display-3 text-center">Add Employee+</div>

        <?php
        if (isset($errormsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Worng<?php echo $errormsg ?></strong>
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
                        <input type="text" name="txt_firstname" class="form-control" placeholder="Plesae Enter Firstname...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row mb-3">
                    <label for="lastname" class="col-sm-3 control-lebel">Lastname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_lastname" class="form-control" placeholder="Plesae Enter Lastname...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row mb-3">
                    <label for="nickname" class="col-sm-3 control-lebel">Nickname</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_nickname" class="form-control" placeholder="Plesae Enter Nickname...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row mb-3">
                    <label for="gender" class="col-sm-3 control-lebel">Gender</label>
                    <div class="col-sm-9">
                        <select name="txt_gender" class="form-control">
                            <option value="selected">-- Please Select Gender --</option>
                            <option value="Man">Man</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-grop text-center">
                <div class="row mb-3">
                    <label for="addresses" class="col-sm-3 control-lebel">Address</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_addresses" class="form-control" placeholder="Plesae Enter Address...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row mb-3">
                    <label for="salary" class="col-sm-3 control-lebel">Salary</label>
                    <div class="col-sm-9">
                        <input type="number" name="num_salary" class="form-control" placeholder="Plesae Enter Salary...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="row mb-3">
                    <label for="title" class="col-sm-3 control-lebel">Subject</label>
                    <div class="col-sm-9">
                        <select name="txt_title" class="form-control">
                            <option value="select">-- Please Select Subject --</option>
                            <option value="Guitar">ครูสอนกีต้าร์</option>
                            <option value="Drumer">ครูสอนกลอง</option>
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
                <div class="row mb-3">
                    <label for="tell" class="col-sm-3 control-lebel">Tell</label>
                    <div class="col-sm-9">
                        <input type="tel" name="tel_tell" class="form-control" placeholder="Plesae Enter tell...">
                    </div>
                </div>
            </div>
            <div class="form-grop text-center">
                <div class="col-md-12 col-sm-9 mt-3">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
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