<?php
$title = "View Logs";
include './templates/header.php';
?>

<h1 class='page-header'>View Logs</h1>
<div class="col-lg-12">
	<form action='view.php' method="post" id="viewLog">
		<table>
			<tr>
				<th>Choose Date : </th><td><div class="col-xs-15"><input type="text" name="date" class="form-control" id="selectDate"></div></td>
			</tr>
		</table>
	</form>
</div>

<br>

<div class="col-lg-12">
<div class="box-body table-responsive " id="responsivetablediv">
	<div id="showLog"></div>
</div>
</div>

<?php include './templates/footer.php'; ?>
