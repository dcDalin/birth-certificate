<?php
	session_start();
	require_once 'class.user.php';
	$user_home = new USER();

	if(isset($_POST['btn-login']))
	{
		//$user_name = $_POST['user_name'];
		$user_email = trim($_POST['user_email']);
		$user_password = trim($_POST['password']);
		
		$password = md5($user_password);
		
		try
		{	
		
			$stmt = $user_home->runQuery("SELECT * FROM tbl_mothers WHERE email=:email");
			$stmt->execute(array(":email"=>$user_email));
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($userRow['userPass']==$password){
				
				echo "ok"; // log in
				
				$_SESSION['userSession'] = $userRow['motherId'];
						return true;
			}
			else{
				
				echo "Email and or Password is incorrect."; // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>