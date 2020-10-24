<nav class="navbar navbar-expand-lg-light bg-light">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggler " data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="index.php">Blessing Music School</a>
        </div>

        <!-- Collect the nav link, forms, and other content for togleing -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <?php

                ///if(isset($_SESSION['username'], $_SESSION['password'])) {
               /// } else {
                ///    echo "<span class='welcome'>Not logged in.</span>";
               ///     }
        

            ?>

        </div>

        <form class="form-inline" action="searchsults.php" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Search student name" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" id="search-btn" type="submit">Search</button>

            <div class="input-group ml-3">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="welcome.php">Student Infomaiton</a>
                    <a class="dropdown-item" href="employees.php">Employees</a>
                    <a class="dropdown-item" href="bill.php">Receipt</a>
                    <a class="dropdown-item" href="std_report.php">Student Report</a>
                    <a class="dropdown-item" href="emp_report.php">Employee Report</a>
                    
                    
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Log Out</a>
               
            </div>


        </form>



    </div>
</nav>