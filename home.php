<?php
    session_start();
    require_once 'class.user.php';

    $user_home = new USER();

    if($user_home->is_logged_in()==""){
        $user_home->redirect('index.php');
    }

    $stmt = $user_home->runQuery("SELECT * FROM tbl_mothers WHERE idNumber=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['userSession']));
    $the_row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php
    $cur_page = 'home';
    include 'includes/inc-header.php';
    include 'includes/inc-mother-nav.php';
?>
        <div class="logged-user">
        <h2>Logged in as: <?php echo $the_row['firstName'];?> <?php echo $the_row['lastName'];?></h2>
        </div>
        <div class="large-page">
        
            <div class="form">
                <h2>My Certificates</h2>
                <br>
                <div id="load-products"></div> <!-- products will be load here -->
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-1.12.4-jquery.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script>
        $(document).ready(function(){
            
            readProducts(); /* it will load products when document loads */
            
            $(document).on('click', '#delete_product', function(e){
                
                var productId = $(this).data('id');
                SwalDelete(productId);
                e.preventDefault();
            });
            
        });
        
        function readProducts(){
            $('#load-products').load('read-cert.php');	
        }
    </script>
</body>

</html>