<?php
    session_start();
    require_once 'class.user.php';

    $user_home = new USER();

    if($user_home->is_logged_in()==""){
        $user_home->redirect('index.php');
    }

    if(isset($_GET['cert_id']) && !empty($_GET['cert_id']))
    {
        $id = $_GET['cert_id'];
        $stmt_edit = $user_home->runQuery('SELECT * FROM tbl_births WHERE entryNo =:did');
        $stmt_edit->execute(array(':did'=>$id));
        $row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        extract($row);
    }
    else
    { 
        header("Location: admin.php");
    }

?>
<?php
    $cur_page = 'new-birth-certificate';
    include 'includes/inc-header.php';
    include 'includes/inc-admin-nav.php';
?>
        <div class="large-page">
            <div class="form">
                <h2>Edit Birth Certificate</h2>
                <br>
                <form class="login-form" method="post" role="form" id="birth-cert-form" autocomplete="off">
                    <!-- json response will be here -->
                        <div id="errorDiv"></div>
                    <!-- json response will be here -->
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mother ID</label>
                                <input type="hidden" name="entryNo" value="<?php echo $row["entryNo"]; ?>" />
                                <input type="text" name="motherId" id="motherId" value="<?php echo $row["motherId"]; ?>">
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Child First Name</label>
                                <input type="text" name="childFirstName" id="childFirstName" value="<?php echo $row["childFirstName"]; ?>">
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Child Other Name</label>
                                <input type="text" name="childOtherName" id="childOtherName" value="<?php echo $row["childOtherName"]; ?>">
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Fathers Tribal Name</label>
                                <input type="text" name="fatherTribalName" id="fatherTribalName" value="<?php echo $row["fatherTribalName"]; ?>">
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Child Date Of Birth</label>
                                <input type="date" name="childDateOfBirth" id="childDateOfBirth" value="<?php echo $row["childDateOfBirth"]; ?>">
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sex</label>
                                <select name="sex" id="sex">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Place of Birth</label>
                                <input type="text" name="placeOfBirth" id="placeOfBirth" value="<?php echo $row["placeOfBirth"]; ?>" >
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                       
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Town of Birth</label>
                                <input type="text" name="townOfBirth" id="townOfBirth" value="<?php echo $row["townOfBirth"]; ?>">
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>County of Birth</label>
                                <select name="countyOfBirth" id="countyOfBirth">
                                    <?php 
                                        $results = $user_home -> GetRows("SELECT * FROM tbl_counties");
                                        foreach ($results as $the_row){
                                            ?>
                                                <option value="<?php echo $the_row['countyName']; ?>" ><?php echo $the_row['countyName']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Father First Name</label>
                                <input type="text" name="fatherFirstName" id="fatherFirstName" value="<?php echo $row["fatherFirstName"]; ?>">
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Father Other Name</label>
                                <input type="text" name="fatherOtherName" id="fatherOtherName" value="<?php echo $row["fatherOtherName"]; ?>">
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Father Tribal Name</label>
                                <input type="text" name="theFatherTribalName" id="theFatherTribalName" value="<?php echo $row["fatherTribalName"]; ?>" readonly>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" id="btn-birth-cert">
                                    EDIT DETAILS
                                </button>
                            </div>
                        </div>
                        <p class="message">
                            <a href="#">.</a><br>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-1.12.4-jquery.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <!-- Start Fetch company name from tbl_companies table -->
    <script>
        $(document).ready(function(){
            $('#fatherTribalName').change(function() {
                $('#theFatherTribalName').val($(this).val());
            });
        });
    </script>
    <!-- End Fetch company name from tbl_companies table -->
    <script src="assets/js/edit-birth-certificate.js"></script>
</body>

</html>