<div class="table-responsive">	
	<table class="table table-bordered table-condensed table-hover table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>#ID</th>
                <th>Child Name</th>
				<th>Father</th>
				<th>Date Of Birth</th>
				<th>Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
			require_once 'class.user.php';
			$user_home = new USER();
            $query = "SELECT * FROM view_birth_certificates WHERE motherId = :loggedIn";
            $stmt = $user_home->runQuery( $query );
            $stmt->bindParam(':loggedIn', $_SESSION['userSession']);
			$stmt->execute();
			
			if($stmt->rowCount() > 0) {
				
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				?>
				<tr>
					<td><?php echo $entryNo; ?></td>
					<td><?php echo $childFirstName; ?> <?php echo $childOtherName; ?> <?php echo $fatherTribalName; ?></td>
					<td><?php echo $fatherFirstName; ?> <?php echo $fatherOtherName; ?> <?php echo $theFatherTribalName; ?></td>
					<td><?php echo $childDateOfBirth; ?></td>
					<td> 
						<a class="btn btn-sm btn-success" href="PDF-birth-certificate.php?cert_id=<?php echo $entryNo; ?>" target="_blank" >View Certificate</a>
					</td>
		        </tr>
				<?php
				}	
				
			} else {
				
				?>
		        <tr>
		        <td colspan="5">No Certificates Found</td>
		        </tr>
		        <?php
				
			}
			?>
             
        </tbody>
    </table>
    
</div>