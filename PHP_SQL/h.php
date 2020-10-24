<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
</head>
<body>
  
  <h2>
    <?php
      require_once("connection.php");
      session_start();

      if (!isset($_SESSION['user_login'])) {
        header("location: index.php");
      }

      $id = $_SESSION['user_login'];

      $select_stmt = $db->prepare("SELECT * FROM tbl_user WHERE id = :uid");
      $select_stmt->execute(array(':uid' => $id));
      $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

      if (isset($_SESSION['user_login'])) {
    ?>
    welcome, <?php echo $row['username']; } ?>
  </h2>
        <br>
      <a href="logout.php">Log out</a>
</body>
</html>