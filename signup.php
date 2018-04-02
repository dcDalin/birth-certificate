<?php
    session_start();
    require_once 'class.user.php';

    $user_home = new USER();

    if($user_home->is_logged_in()!=""){
        $user_home->redirect('home.php');
    }
?>
<?php
    $cur_page = 'signup';
    include 'includes/inc-header.php';
    include 'includes/inc-nav.php';
?>
        <div class="signup-page">
            <div class="form">
                <h2>Create Account (Mother)</h2>
                <br>
                <form class="login-form" method="post" role="form" id="signup-form" autocomplete="off">
                    <!-- json response will be here -->
                        <div id="errorDiv"></div>
                    <!-- json response will be here -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstName" id="firstName">
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lastName" id="lastName">
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" id="email">
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ID Number</label>
                            <input type="number" name="idNumber" id="idNumber">
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" name="phoneNumber" id="phoneNumber">
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password">
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="cpassword" id="cpassword">
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" id="btn-signup">
                                CREATE ACCOUNT
                            </button>
                        </div>
                    </div>
                    <p class="message">
                        <a href="#">.</a><br>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-1.12.4-jquery.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/signup.js"></script>
</body>

</html>