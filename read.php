<div class="table-responsive">	
	<table class="table table-bordered table-condensed table-hover table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>#ID</th>
                <th>Child Name</th>
				<th>Father</th>
				<th>Mother</th>
				<th>Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
			require_once 'class.user.php';
			$user_home = new USER();
            $query = "SELECT * FROM view_birth_certificates";
            $stmt = $user_home->runQuery( $query );
			$stmt->execute();
			
			if($stmt->rowCount() > 0) {
				
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				?>
				<tr>
					<td><?php echo $entryNo; ?></td>
					<td><?php echo $childFirstName; ?> <?php echo $childOtherName; ?> <?php echo $fatherTribalName; ?></td>
					<td><?php echo $fatherFirstName; ?> <?php echo $fatherOtherName; ?> <?php echo $theFatherTribalName; ?></td>
					<td><?php echo $motherFirstName; ?> <?php echo $motherLastName; ?></td>
					<td> 
						<a class="btn btn-sm btn-success" href="PDF-birth-certificate.php?cert_id=<?php echo $entryNo; ?>" target="_blank" >View Certificate</a>
						<a class="btn btn-sm btn-info" href="edit-birth-certificate.php?cert_id=<?php echo $entryNo; ?>" >Edit </a>
						<a class="btn btn-sm btn-danger" id="delete_product" data-id="<?php echo $entryNo; ?>" href="javascript:void(0)">Delete</a>
					</td>
		        </tr>
				<?php
				}	
				
			} else {
				
				?>
		        <tr>
		        <td colspan="3">No Products Found</td>
		        </tr>
		        <?php
				
			}
			?>
             
        </tbody>
    </table>
    
</div>