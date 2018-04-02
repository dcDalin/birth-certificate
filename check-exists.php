<?php

	require_once 'class.user.php';

	$user_home = new USER();

	if ( isset($_REQUEST['email']) && !empty($_REQUEST['email']) ) {
		
		$email = trim($_REQUEST['email']);
		$email = strip_tags($email);
		
		$query = "SELECT email FROM tbl_mothers WHERE email=:email";
		$stmt = $user_home->runQuery( $query );
		$stmt->execute(array(':email'=>$email));
		
		if ($stmt->rowCount() == 1) {
			echo 'false'; // email already taken
		} else {
			echo 'true'; 
		}
    }
    
    if ( isset($_REQUEST['idNumber']) && !empty($_REQUEST['idNumber']) ) {
		
		$idNumber = trim($_REQUEST['idNumber']);
		$idNumber = strip_tags($idNumber);
		
		$query = "SELECT idNumber FROM tbl_mothers WHERE idNumber=:idNumber";
		$stmt = $user_home->runQuery( $query );
		$stmt->execute(array(':idNumber'=>$idNumber));
		
		if ($stmt->rowCount() == 1) {
			echo 'false'; // idNumber already taken
		} else {
			echo 'true'; 
		}
    }
    
    if ( isset($_REQUEST['phoneNumber']) && !empty($_REQUEST['phoneNumber']) ) {
		
		$phoneNumber = trim($_REQUEST['phoneNumber']);
		$phoneNumber = strip_tags($phoneNumber);
		
		$query = "SELECT phoneNumber FROM tbl_mothers WHERE phoneNumber=:phoneNumber";
		$stmt = $user_home->runQuery( $query );
		$stmt->execute(array(':phoneNumber'=>$phoneNumber));
		
		if ($stmt->rowCount() == 1) {
			echo 'false'; // phoneNumber already taken
		} else {
			echo 'true'; 
		}
	}
	
	if ( isset($_REQUEST['motherId']) && !empty($_REQUEST['motherId']) ) {
		
		$motherId = trim($_REQUEST['motherId']);
		$motherId = strip_tags($motherId);
		
		$query = "SELECT idNumber FROM tbl_mothers WHERE idNumber=:motherId";
		$stmt = $user_home->runQuery( $query );
		$stmt->execute(array(':motherId'=>$motherId));
		
		if ($stmt->rowCount() == 1) {
			echo 'true'; 
		} else {
			echo 'false'; 
		}
    }