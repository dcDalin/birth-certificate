<?php

	// JSON content
	header('Content-type: application/json');

	require_once 'class.user.php';

	// Include instance of class user and assign it to $user_home
	$user_home = new USER();
	
	// Set response to an array
	$response = array();

	if ($_POST) {

		$firstName = trim($_POST['firstName']);
		$lastName = trim($_POST['lastName']);
		$email = trim($_POST['email']);
		$idNumber = trim($_POST['idNumber']);
		$phoneNumber = trim($_POST['phoneNumber']);
		$pass = trim($_POST['cpassword']);

		$userPass = md5($pass);
 
		$query = "INSERT INTO `tbl_mothers` (`firstName`, `lastName`, `email`, `idNumber`, `phoneNumber`, `userPass`) 
			VALUES (:firstName, :lastName, :email, :idNumber, :phoneNumber, :userPass)";
			
		$stmt = $user_home->runQuery( $query );
		$stmt->bindParam(':firstName', $firstName);
		$stmt->bindParam(':lastName', $lastName);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':idNumber', $idNumber);
		$stmt->bindParam(':phoneNumber', $phoneNumber);
		$stmt->bindParam(':userPass', $userPass);
		
		// check for successfull registration
        if ( $stmt->execute() ) {
			$response['status'] = 'success';
			$response['message'] = 'Registered sucessfully, you may login now';
        } else {
            $response['status'] = 'error'; // could not register
			$response['message'] = 'Could not register, try again later';
        }	
	}
	
	echo json_encode($response);