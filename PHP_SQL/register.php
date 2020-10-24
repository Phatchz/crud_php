<?php

require_once('connection.php');

if (isset($_REQUEST['btn_register'])) {
    $username = strip_tags($_REQUEST['txt_username']);
    $email = strip_tags($_REQUEST['txt_email']);
    $password = strip_tags($_REQUEST['txt_password']);

    if (empty($username)) {
        $errorMsg[] = "Please enter username";
    } else if (empty($email)) {
        $errorMsg[] = "Please enter email";
    } else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $errorMsg[] = "Please enter a valid email address";
    } else if (empty($password)) {
        $errorMsg[] = "Please enter password";
    } else if (strlen($password) < 4) {
        $errorMsg[] = "Password must be atleast 4 characters";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT username, email FROM tbl_user WHERE username = :uname OR email = :uemail");
            $select_stmt->execute(array(':uname' => $username, ':uemail' => $email));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['username'] == $username) {
                $errorMsg[] = "Sorry username already exists";
            } else if ($row['email'] == $email) {
                $errorMsg[] = "Sorry email already exists";
            } else if (!isset($errorMsg)) {
                $new_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_stmt = $db->prepare("INSERT INTO tbl_user (username, email, password) VALUE (:uname, :uemail, :upassword)");
                if ($insert_stmt->execute(array(
                    ':uname' => $username,
                    ':uemail' => $email,
                    ':upassword' => $new_password
                ))) {
                    $registerMsg = "Register successfully... Please acount link";
                }
            }
        } catch(PDOException $e){
            $e->getMessage();
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cssbootstrap.css.min">
</head>

<body>

    <div class="container text-center">
        <h1 class="mt-5">Register Page</h1>
        <form action="" class="form-horizontal mt-3" method="post">
            <?php
                 if (isset($errorMsg)) {
                foreach($errorMsg as $error) {
            ?>
                <div class="alert alert-danger">
                    <strong><?php echo $error; ?></strong>
                </div>
            <?php
                    }
                }
            ?>

            <?php
                 if (isset($registerMsg)) {
            ?>
                <div class="alert alert-success">
                    <strong><?php echo $registerMsg; ?></strong>
                </div>
            <?php
                }
            ?>
            <div class="form-group">
                <div class="row">
                    <label for="username" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_username" class="form-control"
                            placeholder="Enter Your Username...">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_email" class="form-control" placeholder="Enter Your Email...">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="txt_password" class="form-control"
                            placeholder="Enter Your Password...">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="submit" name="btn_register" class="btn btn-primary" value="Register">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <p>You have a account login here <a href="index.php">Login</a></p>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/poper.min.js"></script>
</body>

</html>