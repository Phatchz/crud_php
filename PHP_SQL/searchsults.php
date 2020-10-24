<?php

    session_start();

    require 'connection.php';
    
    if(isset($_SESSION['username'], $_SESSION['password'])) {

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result - Student Infomation System</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cssbootstrap.css.min">
</head>

<body>

    <?php include 'header.php'; ?>

    <section>

        <?php
        if(isset($_GET['search'])) {
            $s = ($_GET['search']);

            $query = "SELECT id,firstname,lastname,nickname,corsename,daytime,studentprice, CONCAT(firstname, ' ', lastname) as fullname
            FROM tbl_user WHERE CONCAT(firstname, ' ', lastname = '$s' OR firstname = '$s' OR lastname ='$s')";
        }

    ?>

        <div class="container">
            <strong class="title">Search Results for "<?php echo $s; ?>".</strong>

            <?php 
        
                if($result = mysqli_query($con, $query)) {
                    if(mysqli_num_rows($result) == 0){
                        echo "<p>No results matches to your query.</p>";
                        echo "</div>";
                    } else {
                        echo "</div>";
                        echo "<ul class='profile-results'>";
                    
                        while($row = mysqli_fetch_assoc($result)) {      
            ?>

            <li>
                <div class="result-box-left">
                    <div class="info"><strong>Student No:</strong><span><?php echo $row['id']; ?></span></div>
                    <div class="info"><strong>Student Name:</strong><span><?php echo $row['firstname']. " " .$row['lastname']; ?></span></div>
                    <div class="info"><strong>Nick Name:</strong><span><?php echo $row['lastname']; ?></span></div>
                    <div class="info"><strong>Course Name:</strong><span><?php echo $row['nickname']; ?></span></div>
                    <div class="info"><strong>Date Time:</strong><span><?php echo $row['corsename']; ?></span></div>
                    <div class="info"><strong>Price:</strong><span><?php echo $row['daytime']; ?></span></div>
                </div>
            </li>

            <?php 
                
                     } echo "</ul>";

                    }

                 } else {
                     die("Error with the query");
                 }
                
                ?>

        </div>

        <div class="container">
            <a href="profile.php">Go Back to My Profile</a>
        </div>
    </section>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/poper.min.js"></script>
</body>

</html>


<?php

                 ///} else {
               ///   header("location: index.php");
                //exit;
                 //}

                mysqli_close($con);

?>