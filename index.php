<?php 
$title = "Record Logs";
include './templates/header.php';
?>

<h1 class='page-header'>Record Log Book</h1>
<form action='index.php' method="post" id="addForm">
<div id="inputtable">
<table>
<tr>
<th>Activity : </th><td><div id="errAct"></div><textarea name="act" rows="5" cols="60" id='actbox'></textarea></td>
<tr>
</tr>
<th>Date : </th><td><div id="errDate"></div><input type="date" name="date" id='datebox'></td>
<tr>
</tr>
<th>Time : </th><td><div id="errTime"></div><input type="time" name="time" id='timebox'></td>
</tr>

</table>
</div>
<br><br>
<input type="button" id="addBut" class="myButton" name="submit" value="Submit">
</form>

<br>
<div id="status"></div>

<?php include './templates/footer.php'; ?>