<?php
//index.php
//include autoloader

require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();


require_once 'class.user.php';
$user_home = new USER();

if(isset($_GET['cert_id']) && !empty($_GET['cert_id']))
	{
		$id = $_GET['cert_id'];
		$stmt_edit = $user_home->runQuery('SELECT * FROM view_birth_certificates WHERE entryNo =:did');
		$stmt_edit->execute(array(':did'=>$id));
		$row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($row);
	}
	else
	{ 
		header("Location: admin.php");
  }

$the_date = date("d/m/Y");
$the_time = date("h:i a");
$output = "
	<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
".$the_date.", ".$the_time."
<h2>Birth Certificate</h2>
<table>
	<tr>
		<th>Name</th>
    <th>Parent</th>
    <th>Date Of Birth</th>
    <th>Sex</th>
	</tr>
";


	$output .= '
		<tr>
			<td>'.$row["entryNo"].'</td>
			<td>'.$row["childFirstName"].'</td>
      <td>'.$row["childOtherName"].'</td>
      <td>'.$row["fatherTribalName"].'</td>
		</tr>
	';


$output .= '</table>';

//echo $output;

$document->loadHtml($output);

//set page size and orientation

$document->setPaper('A4', 'landscape');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Webslesson", array("Attachment"=>0));
//1  = Download
//0 = Preview
?>