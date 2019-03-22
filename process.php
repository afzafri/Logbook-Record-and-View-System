<?php

include 'config.php';

//pdo connect
try
{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "Connection Error : " . $e->getMessage();
}

//add log

if(isset($_POST['option']))
{
	$option = (isset($_POST['option'])) ? $_POST['option'] : "";

	if($option == "add")
	{

	  $act = (isset($_POST['act']) ? $_POST['act'] : null);
	  $date = (isset($_POST['date']) ? $_POST['date'] : null);
	  $time = (isset($_POST['time']) ? $_POST['time'] : null);

	  if(isset($_POST['act']) && isset($_POST['date']) && isset($_POST['time']))
	  {
			$date = DateTime::createFromFormat('d/m/Y', $_POST['date']);

			try
			{

				$stmt = $conn->prepare("INSERT INTO LOGBOOK (ACT,DATE,TIME) VALUES(?,?,?) ");
				$stmt->execute(array($act,$date->format('Y-m-d'),$time));

			}
			catch(PDOException $e)
			{
				echo "Connection Error : " . $e->getMessage();
			}
	  }

	}

	//view log
	if($option == "view")
	{
		$startdate = ($_POST['startdate'] != "") ? (DateTime::createFromFormat('d/m/Y', $_POST['startdate']))->format('Y-m-d') : "";
		$enddate = ($_POST['enddate'] != "") ? DateTime::createFromFormat('d/m/Y', $_POST['enddate'])->format('Y-m-d') : "";

		$datetext = ($_POST['enddate'] != "") ? $_POST['startdate'] . " to " . $_POST['enddate'] : $_POST['startdate'];

	  echo "
	  <div class='noprint'>
	  <h3 id='logTitle'>Practical Training Logbook Entry - ".$datetext."</h3></div>
	  <div id='logtable'>
	  <table width='100%' class='table table-bordered table-hover' id='logbookData'>
		<thead>
	  <tr>
		<th width='2'>&nbsp;</th>
	  <th>Date & Time</th>
	  <th>Exact Nature Of Work Done</th>
	  <th>Supervisor Remark
	  </th>
	  </tr>
		</thead>
		<tbody>

	  ";
	  try
		{

			if($_POST['enddate'] != "") {
				$stmt = $conn->prepare("SELECT ID,ACT,DATE,DATE_FORMAT(TIME,'%h:%i %p') AS NEWTIME FROM LOGBOOK WHERE DATE BETWEEN ? AND ?");
				$stmt->execute(array($startdate, $enddate));
			} else {
				$stmt = $conn->prepare("SELECT ID,ACT,DATE,DATE_FORMAT(TIME,'%h:%i %p') AS NEWTIME FROM LOGBOOK WHERE DATE = ?");
				$stmt->execute(array($startdate));
			}


			while($result=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$id = $result['ID'];
				$dates = $result['DATE'];
				$act = $result['ACT'];
				$time = $result['NEWTIME'];

				echo "

				<tr>
				<td text-align='center'>
					<button class='btn btn-sm btn-danger' id='delBtn' delID='$id' title='Delete log'>&times;</button>
				</td>
				<td>".date('d/m/Y',strtotime($dates))." <br>- $time</td>
				<td><li>$act</li></td>
				<td></td>
				</tr>

				";

			}

		}
		catch(PDOException $e)
		{
			echo "Connection Error : " . $e->getMessage();
		}

		echo "</tbody</table>
		</div>
		<br><br>
		";

	}

	//Delete log
	if($option == "delete")
	{
		$delID = (isset($_POST['id']) ? $_POST['id'] : null);

	  try
		{
			$stmt = $conn->prepare("DELETE FROM LOGBOOK WHERE ID = ?");
			$stmt->execute(array($delID));
		}
		catch(PDOException $e)
		{
			echo "Connection Error : " . $e->getMessage();
		}
	}

	if($option == "generateJSON")
	{

		$startdate = ($_POST['startdate'] != "") ? (DateTime::createFromFormat('d/m/Y', $_POST['startdate']))->format('Y-m-d') : "";
		$enddate = ($_POST['enddate'] != "") ? DateTime::createFromFormat('d/m/Y', $_POST['enddate'])->format('Y-m-d') : "";

		try
		{

			$stmt = $conn->prepare("
															SELECT ID,ACT,DATE,DATE_FORMAT(TIME,'%h:%i %p') AS NEWTIME
															FROM LOGBOOK
															WHERE DATE BETWEEN ? AND ?
															");

			$stmt->execute(array($startdate, $enddate));

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$sorted = array();
			foreach ($result as $element) {
			    $sorted[$element['DATE']][] = $element;
			}

			echo json_encode($sorted);

		}
		catch(PDOException $e)
		{
			echo "Connection Error : " . $e->getMessage();
		}
	}
}

if(isset($_GET['generate']))
{
	$startdate = (isset($_GET['startdate'])) ? (DateTime::createFromFormat('d/m/Y', $_GET['startdate']))->format('Y-m-d') : "";
	$enddate = (isset($_GET['enddate'])) ? DateTime::createFromFormat('d/m/Y', $_GET['enddate'])->format('Y-m-d') : "";

	$datetext = "Internship Log Book (" . $_GET['startdate'] . " to " . $_GET['enddate'] .")";

	header("Content-Type: application/vnd.ms-word");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=".$datetext.".doc");
	try
	{

		$stmt = $conn->prepare("
														SELECT ID,ACT,DATE,DATE_FORMAT(TIME,'%h:%i %p') AS NEWTIME
														FROM LOGBOOK
														WHERE DATE BETWEEN ? AND ?
														");

		$stmt->execute(array($startdate, $enddate));

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$sorted = array();
		foreach ($result as $element) {
				$sorted[$element['DATE']][] = $element;
		}

		$tablehead = "<table width='100%' border='1' style='border-collapse: collapse'>
		<tr style='background-color: #99bbff; text-align:center;'>
		<th width='100px'>Date & Time</th>
		<th>Exact Nature Of Work Done</th>
		<th width='150px'>Supervisor Remark
		</th>
		</tr>
		</thead>";

		$tablefooter = 	"</table>";

		foreach ($sorted as $date => $logs) {

			$tablebody = "";

			foreach ($logs as $key => $log) {
				$id = $log['ID'];
				$dates = $log['DATE'];
				$act = $log['ACT'];
				$time = $log['NEWTIME'];

				$tablebody .= "
				<tr>
				<td>".date('d/m/Y',strtotime($dates))." <br>- $time</td>
				<td>".strip_tags($act)."</td>
				<td></td>
				</tr>
				";
			}

			echo $tablehead . $tablebody . $tablefooter;
			echo "<br><br><br><br><br><br><br><br>";

		}

	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
}


$conn = null;

?>
