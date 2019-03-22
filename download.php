<?php
$title = "Download Logs";
include './templates/header.php';
?>

<h1 class='page-header'>Download Logs</h1>
<div class="col-lg-12">

  <div id="alert"></div>

  <table>
    <tr>
      <th>Choose Date : </th>
      <td>
          <input type="text" name="startdate" class="form-control" id="selectStartDate">
      </td>
      <td>
        to
      </td>
      <td>
        <input type="text" name="enddate" class="form-control" id="selectEndDate">
      </td>
      <td>
        <button class="btn btn-success" id="downloadBtn"><i class="fa fa-download fa-fw"></i> Download</button>
      </td>
    </tr>
  </table>
</div>

<br>

<?php include './templates/footer.php'; ?>
