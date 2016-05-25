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
	try
	{
		
		$stmt = $conn->prepare("INSERT INTO LOGBOOK (ACT,DATE,TIME) VALUES(?,?,?) ");
		$stmt->execute(array($act,$date,$time));
		
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
  $date = $_POST['date'];
  
  echo "
  <div class='noprint'>
  <h3>Practical Training Log Book Entry - ".date('d/m/Y',strtotime($date))."</h3></div>
  <div id='logtable'>
  <table width='100%'>
  <tr>
  <th>Date & Time</th>
  <th>Exact Nature Of Work Done</th>
  <th>Supervisor Remark
  </th>
  </tr>
  
  ";
  try
	{
		
		$stmt = $conn->prepare("SELECT ACT,DATE,DATE_FORMAT(TIME,'%h:%i %p') AS NEWTIME FROM LOGBOOK WHERE DATE=?");
		$stmt->execute(array($date));
		
		while($result=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			$dates = $result['DATE'];
			$act = $result['ACT'];
			$time = $result['NEWTIME'];
			
			echo "
			
			<tr>
			<td>".date('d/m/Y',strtotime($dates))." <br>- $time</td>
			<td><li>$act</td>
			<td></td>
			</tr>
			
			";
			
		}
		
	}
	catch(PDOException $e)
	{
		echo "Connection Error : " . $e->getMessage();
	}
	
	echo "</table>
	</div>
	<br><br>
	";
	
	//generate field for Supervisor signature every Friday
	if((date('D',strtotime($date))) == "Fri")
	{
		echo "
		<div id='logtable'>
		<div class='signature'>
		Supervisor's Signature : <br><br>
		_________________________<br>
		(YOUR SUPERVISOR'S NAME)
		</div>
		</div>
		";
	}
	
	echo"
	<br><br><br>
	<div class='noprint'>
	<input type='button' class='myButton' onClick='window.print()' value='Print'/>
	</div>
	
	";
	
}


$conn = null;

?>