<?php
  if (!isset($_GET['delete'])) {
    include('includes/javascript/form_check.js.php');
  } else {
?>
<script><!--
function RemoveFormatString(TargetElement, FormatString) {
  if (TargetElement.value == FormatString) {
    TargetElement.value = "";
  }

  TargetElement.select();
}
//--></script>
<?php
  }
?>