<?php
    session_start();
    require_once 'class.user.php';

    $user_home = new USER();

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
        
        function SwalDelete(productId){ 
            swal({
                title: 'Are you sure?',
                text: "It will be deleted permanently!",
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