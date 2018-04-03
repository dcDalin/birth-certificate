<body>
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Birth Certificate</a>
                </div>
                <ul class="nav navbar-nav">
                    <li <?php if($cur_page=='home'){ ?>class="active" <?php } ?>>
                        <a href="home.php">Home</a>
                    </li>
                    <li <?php if($cur_page=='logout'){ ?>class="active" <?php } ?>>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>