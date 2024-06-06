<?php /* infobox template  */ ?>

    <?php switch ($corner_left) { 
    case 'square': echo ' ';
    break; 
    case 'rounded': echo ''; 
    break;
    } ?>
    <?php switch ($corner_right) { 
    case 'square': echo ' ';
    break; 
    case 'rounded': echo ''; 
    break;
    } ?>

<div class="BoxesInfoBoxHeadingCenterBoxTitle"> <div class="bbhcbt1"><div class="bbhcbt2"><div class="bbhcbt3">
    <?php 
echo $boxLink . $boxHeading; ?></div></div></div></div>
<div class="pippino1" ><div class="pippino2" ><div class="pippino3" >
<div class="InfoBoxContenent2MABox">
<?php // echo $boxContent_attributes;
?>
<?php echo $boxContent; ?>
</div></div></div></div>
<div class="pippino4" ><div class="pippino5" ><div class="pippino6" > &nbsp;
</div></div></div>
