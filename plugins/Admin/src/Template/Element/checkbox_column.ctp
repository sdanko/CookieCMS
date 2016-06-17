 <?php
    if(!isset($checked)){ $checked = false;}
    if ($checked):
?>
    <input disabled="disabled" checked type="checkbox">
 <?php
        else:
?>
     <input disabled="disabled" type="checkbox">
<?php endif; 
