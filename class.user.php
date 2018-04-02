<?php

require_once 'dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	public function GetRows($sql) {
		try {
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $results;
		}catch(Exception $e) {
			die ( $e->getMessage() );
		}
	}
	public function Insert($sql) {
		try {
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$stmt->closeCursor();
			return $this->conn->lastInsertId();
		}catch(Exception $e) {
			return $e->getMessage();
		}
	}
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "";                 
		$mail->Host       = "mail.zivent.co.ke";      
		$mail->Port       = 25;             
		$mail->AddAddress($userEmail);
		$mail->Username="autoresponder@zivent.co.ke";  
		$mail->Password="Autoresponder401h8*";            
		$mail->SetFrom('autoresponder@zivent.co.ke','Wedding Gowns');
		$mail->AddReplyTo("dc_dalin@zivent.co.ke","Wedding Gowns");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	
}