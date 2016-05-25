<?php 
$title = "View Logs";
include './templates/header.php';
?>

<div class="noprint">
<h1 class='page-header'>View Logs</h1>
<form action='view.php' method="post" id="viewLog">
<b>Choose Date : </b><input type="date" name="date">
</div>
<br>
<div class="box-body table-responsive " id="responsivetablediv">
	<div id="showLog"></div>
</div>


<?php include './templates/footer.php'; ?>
