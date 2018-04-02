<?php

	// JSON content
	header('Content-type: application/json');
    session_start();
	require_once 'class.user.php';

	// Include instance of class user and assign it to $user_home
	$user_home = new USER();
	
	// Set response to an array
	$response = array();

	if ($_POST) {

        $entryNo = $_POST['entryNo'];
		$motherId = trim($_POST['motherId']);
		$childFirstName = trim($_POST['childFirstName']);
		$childOtherName = trim($_POST['childOtherName']);
		$fatherTribalName = trim($_POST['fatherTribalName']);
		$childDateOfBirth = trim($_POST['childDateOfBirth']);
        $sex = trim($_POST['sex']);
        $placeOfBirth = trim($_POST['placeOfBirth']);
        $townOfBirth = trim($_POST['townOfBirth']);
        $countyOfBirth = trim($_POST['countyOfBirth']);
        $fatherFirstName = trim($_POST['fatherFirstName']);
        $fatherOtherName = trim($_POST['fatherOtherName']);
        $theFatherTribalName = trim($_POST['theFatherTribalName']);


        $sql = "
            UPDATE `tbl_births` SET 
                motherId = :motherId,
                childFirstName = :childFirstName,
                childOtherName = :childOtherName,
                fatherTribalName = :fatherTribalName,
                childDateOfBirth = :childDateOfBirth,
                sex = :sex,
                placeOfBirth = :placeOfBirth,
                townOfBirth = :townOfBirth,
                countyOfBirth = :countyOfBirth,
                fatherFirstName = :fatherFirstName,
                fatherOtherName = :fatherOtherName,
                theFatherTribalName = :theFatherTribalName,
                nameOfRegOfficer = :nameOfRegOfficer
            WHERE entryNo = :entryNo              
        ";

        $stmt=$user_home->runQuery( $sql );

        $stmt->bindParam(':entryNo',$entryNo);
		$stmt->bindParam(':childFirstName', $childFirstName);
		$stmt->bindParam(':childOtherName', $childOtherName);
        $stmt->bindParam(':fatherTribalName', $fatherTribalName);
        $stmt->bindParam(':childDateOfBirth', $childDateOfBirth);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':placeOfBirth', $placeOfBirth);
        $stmt->bindParam(':townOfBirth', $townOfBirth);
        $stmt->bindParam(':countyOfBirth', $countyOfBirth);
        $stmt->bindParam(':fatherFirstName', $fatherFirstName);
        $stmt->bindParam(':fatherOtherName', $fatherOtherName);
        $stmt->bindParam(':theFatherTribalName', $theFatherTribalName);
        $stmt->bindParam(':motherId', $motherId);
        $stmt->bindParam(':nameOfRegOfficer', $_SESSION['userSession']);

		// check for successfull registration
        if ( $stmt->execute() ) {
			$response['status'] = 'success';
			$response['message'] = 'Details edited successfully';
        } else {
            $response['status'] = 'error'; // could not register
			$response['message'] = 'Could not edit, try again later';
        }	
	}
	
	echo json_encode($response);