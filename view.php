<?php 
$title = "View Logs";
include './templates/header.php';
?>

<div class="noprint">
<h1 class='page-header'>View Logs</h1>
<form action='view.php' method="post" id="viewLog">
<b>Choose Date : </b><input type="date" name="date">
</div>

<div id="showLog"></div>


<?php include './templates/footer.php'; ?>