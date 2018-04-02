<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['delete']) {
		
		require_once 'class.user.php';

    	$user_home = new USER();
		
		$pid = intval($_POST['delete']);
		$query = "DELETE FROM tbl_births WHERE entryNo=:pid";
		$stmt = $user_home->runQuery( $query );
		$stmt->execute(array(':pid'=>$pid));
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Birth Certificate Deleted Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete certificate ...';
		}
		echo json_encode($response);
	}