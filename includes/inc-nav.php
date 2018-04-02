<body>
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Birth Certificate</a>
                </div>
                <ul class="nav navbar-nav">
                    <li <?php if($cur_page=='index'){ ?>class="active" <?php } ?>>
                        <a href="index.php">Login</a>
                    </li>
                    <li <?php if($cur_page=='signup'){ ?>class="active" <?php } ?>>
                        <a href="signup.php">Sign Up</a>
                    </li>
                </ul>
            </div>
        </nav>