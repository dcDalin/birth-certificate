<body>
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Birth Certificate</a>
                </div>
                <ul class="nav navbar-nav">
                    <li <?php if($cur_page=='admin'){ ?>class="active" <?php } ?>>
                        <a href="admin.php">All Certificates</a>
                    </li>
                    <li <?php if($cur_page=='new-birth-certificate'){ ?>class="active" <?php } ?>>
                        <a href="new-birth-certificate.php">New Birth Certificate</a>
                    </li>
                    <li <?php if($cur_page=='logout'){ ?>class="active" <?php } ?>>
                        <a href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>