<?php 
$title = "Record Logs";
include './templates/header.php';
?>
<div class="row">
<h1 class='page-header'>Record Log Book</h1>
	<div class="col-lg-12">
		
			<form action='index.php' method="post" id="addForm">
			<div id="inputtable">
			<table>
			<tr>
			<th>Activity : </th><td><div id="errAct"></div><textarea class="form-control" name="act" rows="5" cols="60" id='actbox'></textarea><div id="charNum">250 characters left</div></td>
			</tr>
			<tr>
			<th>Date : </th><td><div id="errDate"></div><div class="col-xs-5"><input class="form-control" type="date" name="date" id='datebox'></div></td>
			</tr>
			<tr>
			<th>Time : </th><td><div id="errTime"></div><div class="col-xs-4"><input class="form-control" type="time" name="time" id='timebox'></div></td>
			</tr>
			</table>
			</div>
			<br><br>
			<input type="button" id="addBut" class="btn btn-primary" name="submit" value="Submit">
			</form>
			
			<br>
			<div id="status"></div>
			
	</div>
</div>

<?php include './templates/footer.php'; ?>
