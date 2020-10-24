<?php 

    require_once('connection.php');

    session_start();

    if(isset($_SESSION['user_login'])) {
        header("location: welcome.php");
    }

        if(isset($_REQUEST['btn_login'])) {
            $username = strip_tags($_REQUEST['txt_username_email']);
            $email = strip_tags($_REQUEST['txt_username_email']);
            $password = strip_tags($_REQUEST['txt_password']);
        

        if(empty($username)){
            $errorMsg[] = "Please enter username or email";
        } else if (empty($email)) {
            $errorMsg[] = "Please enter username or email";
        } else if (empty($password)) {
            $errorMsg[] = "Please enrer password";
        } else {
            try {
                $select_stmt = $db->prepare("SELECT * FROM tbl_user WHERE username = :uname OR email = :uemail");
                $select_stmt->execute(array(':uname' => $username, ':uemail' => $email));
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

                if($select_stmt->rowCount() > 0) {
                    if($username == $row['username'] OR $email == $row['email']){
                        if (password_verify($password, $row['password'])) {
                            $_SESSION['user_login'] = $row['id'];
                            $loginMsg = "Successfully Login...";
                            header("refresh:2;welcome.php");
                        } else {
                            $errorMsg[] = "Wrong password!";
                        }
                    } else {
                        $errorMsg[] = "Wrong username or email";
                    }
                } else {
                    $errorMsg[] = "Wrong username or email";
                }

            }catch(PDOException $e) {
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
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cssbootstrap.css.min">
</head>

<body>

    <div class="container text-center">
        <h1 class="mt-5">Login Page</h1>
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
                 if (isset($loginMsg)) {
            ?>
            <div class="alert alert-success">
                <strong><?php echo $loginMsg; ?></strong>
            </div>
            <?php
                }
            ?>
            <div class="form-group">
                <div class="row">
                    <label for="username" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_username_email" class="form-control"
                            placeholder="Enter Your Username...">
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
                        <input type="submit" name="btn_login" class="btn btn-success" value="Login">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- <p>You don't have a account register here <a href="register.php">Register</a></p> -->
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