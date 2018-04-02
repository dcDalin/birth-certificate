<?php
    $cur_page = 'index';
    include 'includes/inc-header.php';
    include 'includes/inc-nav.php';
?>
        <div class="login-page">
            <div class="form">
                <h2>Login</h2>
                <br>
                <form class="login-form">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text">
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text">
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
                            <button>LOGIN</button>
                        </div>
                    </div>
                    <p class="message">
                        <a href="#">Forgot Password?</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>