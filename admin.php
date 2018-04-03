<?php
    session_start();
    require_once 'class.user.php';

    $user_home = new USER();

    if($user_home->is_logged_in()==""){
        $user_home->redirect('index.php');
    }
    $stmt = $user_home->runQuery("SELECT * FROM tbl_admin WHERE adminId=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['userSession']));
    $the_row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php
    $cur_page = 'admin';
    include 'includes/inc-header.php';
    include 'includes/inc-admin-nav.php';
?>
        <div class="logged-user">
        <h2>Logged in as: <?php echo $the_row['firstName'];?> <?php echo $the_row['lastName'];?></h2>
        </div>
        <div class="large-page">
            <div class="form">
                <h2>All Birth Certificates</h2>
                <br>
                <div id="load-products"></div> <!-- Certificates Will Load Here -->
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
        
        function SwalDelete(productId){ 
            swal({
                title: 'Are you sure?',
                text: "Certificate will be deleted permanently!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                
                preConfirm: function() {
                return new Promise(function(resolve) {
                    
                    $.ajax({
                        url: 'delete.php',
                        type: 'POST',
                        data: 'delete='+productId,
                        dataType: 'json'
                    })
                    .done(function(response){
                        swal('Deleted!', response.message, response.status);
                        readProducts();
                    })
                    .fail(function(){
                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                    });
                });
                },
                allowOutsideClick: false			  
            });	
            
        }
        
        function readProducts(){
            $('#load-products').load('read.php');	
        }
        
    </script>
</body>

</html>