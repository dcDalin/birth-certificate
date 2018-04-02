<?php
    session_start();
    require_once 'class.user.php';

    $user_home = new USER();

    if($user_home->is_logged_in()!=""){
        $user_home->redirect('home.php');
    }
?>
<?php
    $cur_page = 'index';
    include 'includes/inc-header.php';
    include 'includes/inc-nav.php';
?>
        <div class="login-page">
            <div class="form">
                <h2>Login</h2>
                <br>
                <form class="login-form" method="post" id="login-form">
                    <div id="error">
			        <!-- error will be shown here ! -->
			        </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="user_email" id="user_email">
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password">
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Admin ?</label>
                            <input type="checkbox" name="vehicle" value="Bike" style="width: 30px; height: 23px; position: absolute; left: 33%;">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" name="btn-login" id="btn-login">
                                LOGIN
                            </button>
                        </div>
                    </div>
                    <p class="message">
                        <a href="#">Forgot Password?</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-1.12.4-jquery.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/login.js"></script>
</body>

</html>