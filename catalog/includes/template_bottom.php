<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */
?>

</table>

<table width=96%>
<tr>
  <td id=f><center>
  <?php require 'includes/footer.php'; ?>
</center>
</table>

<script src="bootstrap.min.js"></script>

<?php
if (\defined('ACCOUNT_DOB') && ACCOUNT_DOB === 'true' && \in_array($PHP_SELF, ['create_account.php', 'account_edit.php'], true)) {
    ?>
<!-- TODO:disable -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.1/dist/css/datepicker-bs4.min.css">
  <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.1/dist/js/datepicker.min.js"></script>

  <script>
    const inputDob = document.querySelector('input[name="dob"]');
    if (inputDob) {
      const datepicker = new Datepicker(inputDob, {
        buttonClass: 'btn',
        format: '<?php echo JQUERY_DATEPICKER_FORMAT; ?>'
      });
    }
  </script>

  <?php
    if (\defined('JQUERY_DATEPICKER_I18N_CODE') && !empty(JQUERY_DATEPICKER_I18N_CODE)) {
        ?>

    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.1/dist/js/locales/<?php echo JQUERY_DATEPICKER_I18N_CODE; ?>.js"></script>
    <script>
      if (typeof datepicker !== 'undefined') {
        datepicker.setOptions({
          language: '<?php echo JQUERY_DATEPICKER_I18N_CODE; ?>'
        });
      }
    </script>
<!--TODO:disable END-->
    <?php
    }
}

?>

<?php echo $oscTemplate->getBlocks('footer_scripts'); ?>

</body>
</html>
