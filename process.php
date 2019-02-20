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
if((isset($_POST['option'])) == "add")
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
if((isset($_POST['option'])) == "view")
{
	$startdate = DateTime::createFromFormat('d/m/Y', $_POST['startdate'])->format('Y-m-d');
	$enddate = ($_POST['enddate'] != "") ? DateTime::createFromFormat('d/m/Y', $_POST['enddate'])->format('Y-m-d') : "";

	$datetext = ($_POST['enddate'] != "") ? $_POST['startdate'] . " to " . $_POST['enddate'] : $_POST['startdate'];

  echo "
  <div class='noprint'>
  <h3 id='logTitle'>Practical Training Log Book Entry - ".$datetext."</h3></div>
  <div id='logtable'>
  <table width='100%' class='table table-bordered table-hover' id='logbookData'>
	<thead>
  <tr>
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
			$stmt = $conn->prepare("SELECT ACT,DATE,DATE_FORMAT(TIME,'%h:%i %p') AS NEWTIME FROM LOGBOOK WHERE DATE BETWEEN ? AND ?");
			$stmt->execute(array($startdate, $enddate));
		} else {
			$stmt = $conn->prepare("SELECT ACT,DATE,DATE_FORMAT(TIME,'%h:%i %p') AS NEWTIME FROM LOGBOOK WHERE DATE = ?");
			$stmt->execute(array($startdate));
		}


		while($result=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			$dates = $result['DATE'];
			$act = $result['ACT'];
			$time = $result['NEWTIME'];

			echo "

			<tr>
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


$conn = null;

?>
