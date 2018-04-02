<?php
    session_start();
    require_once 'class.user.php';

    $user_home = new USER();

    if($user_home->is_logged_in()==""){
        $user_home->redirect('index.php');
    }
?>
<?php
    $cur_page = 'admin';
    include 'includes/inc-header.php';
    include 'includes/inc-admin-nav.php';
?>
        <div class="large-page">
            <div class="form">
                <h2>Birth Certificates</h2>
                <br>
                
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-1.12.4-jquery.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/login.js"></script>
</body>

</html>