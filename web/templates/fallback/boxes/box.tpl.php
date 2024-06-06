<?php /* infobox template  */ ?>

    <?php switch ($corner_left) { 
    case 'square': echo ' ';
    break; 
    case 'rounded': echo '<div class="fedora-corner-tl">&nbsp;</div>'; 
    break;
    } ?>
    <?php switch ($corner_right) { 
    case 'square': echo ' ';
    break; 
    case 'rounded': echo '<div class="fedora-corner-tr">&nbsp;</div>'; 
    break;
    } ?>

<div class="BoxesInfoBoxHeadingCenterBoxTitle"> 
    <?php switch ($corner_left) { 
    case 'square': echo '&nbsp;&nbsp;&nbsp;';
    break; 
    }
echo $boxLink . $boxHeading; ?></div>

<div class="InfoBoxContenent2MABox">
<?php // echo $boxContent_attributes;
?>
<?php echo $boxContent; ?>
</div>
<br />