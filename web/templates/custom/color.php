

<br />
<?php
echo 'Current COLORE SFONDO : ' .  '<span class="ColorRed">#' . COLORE_SFONDO . ';</span> - #';
echo tep_draw_form('Template_Form', FILENAME_DEFAULT . '?tplDir=custom', 'post');
echo tep_draw_input_field('COLORE_SFONDO','ffffff');
?>
  <input type='submit' name='submit' />
</form>
<?php
if((isset($_POST["submit"])) and (($_POST["COLORE_SFONDO"])!= null )){ $username=(tep_sanitize_string ($_POST["COLORE_SFONDO"])); 
tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '$username' where configuration_key = 'COLORE_SFONDO'");
?>
<META http-equiv="refresh" content="0" />
<?php
}
?>
<br />
<?php
echo 'Current COLORE TESTO	: ' .  '<span class="ColorRed">#' . COLORE_TESTO . ';</span> - #';
echo tep_draw_form('Template_Form', FILENAME_DEFAULT . '?tplDir=custom', 'post');
echo tep_draw_input_field('COLORE_TESTO','000000');
?>
  <input type='submit' name='submit' />
</form>
<?php
if((isset($_POST["submit"])) and (($_POST["COLORE_TESTO"])!= null )){ $username=(tep_sanitize_string ($_POST["COLORE_TESTO"])); 
tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '$username' where configuration_key = 'COLORE_TESTO'");
?>
<META http-equiv="refresh" content="0" />
<?php
}
?>
<br />
<?php
echo 'Current COLORE BORDO : ' .  '<span class="ColorRed">#' . COLORE_BORDO . ';</span> - #';
echo tep_draw_form('Template_Form', FILENAME_DEFAULT . '?tplDir=custom', 'post');
echo tep_draw_input_field('COLORE_BORDO','b6b7cb');
?>
  <input type='submit' name='submit' />
</form>
<?php
if((isset($_POST["submit"])) and (($_POST["COLORE_BORDO"])!= null )){ $username=(tep_sanitize_string ($_POST["COLORE_BORDO"])); 
tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '$username' where configuration_key = 'COLORE_BORDO'");
?>
<META http-equiv="refresh" content="0" />
<?php
}
?>
<br />
<?php
echo 'Current COLORE RIPIENO : ' .  '<span class="ColorRed">#' . COLORE_RIPIENO . ';</span> - #';
echo tep_draw_form('Template_Form', FILENAME_DEFAULT . '?tplDir=custom', 'post');
echo tep_draw_input_field('COLORE_RIPIENO','f8f8f9');
?>
  <input type='submit' name='submit' />
</form>
<?php
if((isset($_POST["submit"])) and (($_POST["COLORE_RIPIENO"])!= null )){ $username=(tep_sanitize_string ($_POST["COLORE_RIPIENO"])); 
tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '$username' where configuration_key = 'COLORE_RIPIENO'");
?>
<META http-equiv="refresh" content="0" />
<?php
}
?>

<script type="text/javascript" type="text/javascript" src="templates/custom/funcs.js"></script>


<div style="border: 2px solid; border-color: #FF8000; background-color: #ffffff;">
<br />
<div style="float:left; background-color: rgb(51, 102, 255); border: 1px solid; height: 90px; width: 90px;" id="currentColor">CURRENT COLOR</div> 

<div style="border: 1px solid; float: left;">  
  <form name="codes" id="codes">
  	<span>R:</span><input name="r" value="0" maxlength="3" type="text" /> <br />
  	<span>G:</span><input name="g" value="0" maxlength="3" type="text" /> <br />
  	<span>B:</span><input name="b" value="0" maxlength="3" type="text" /> <br />
    <input value="Set RGB" onclick="ChangeColors(document.getElementById('codes').r.value,document.getElementById('codes').g.value,document.getElementById('codes').b.value);" type="button" /> <br /> <br />
    #<input name="hex" value="000000" maxlength="6" type="text" /> <br />
    <input value="Set HEX" onclick="SetHex(document.getElementById('codes').hex.value);" type="button" /> <br /> <br />
    <input value="Light" onclick="LightenScheme();" style="margin-bottom: 0px;" type="button" />
    <input value="Dark" onclick="DarkenScheme();" type="button" /> <br />	
  </form>  	 	
</div>

<div style="padding: 10px; width: 90px; float:left;">
    <div id="0" style="background-color: rgb(51, 102, 255);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="0RGB">51.102.255</div>
    <div id="0HEX">#3366FF</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="1" style="background-color: rgb(102, 51, 255);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="1RGB">102.51.255</div>
    <div id="1HEX">#6633FF</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="2" style="background-color: rgb(204, 51, 255);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="2RGB">204.51.255</div>
    <div id="2HEX">#CC33FF</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="3" style="background-color: rgb(255, 51, 204);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="3RGB">255.51.204</div>
    <div id="3HEX">#FF33CC</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="4" style="background-color: rgb(255, 51, 102);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="4RGB">255.51.102</div>
    <div id="4HEX">#FF3366</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="5" style="background-color: rgb(255, 102, 51);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="5RGB">255.102.51</div>
    <div id="5HEX">#FF6633</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="6" style="background-color: rgb(255, 204, 51);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="6RGB">255.204.51</div>
    <div id="6HEX">#FFCC33</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="7" style="background-color: rgb(204, 255, 51);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="7RGB">204.255.51</div>
    <div id="7HEX">#CCFF33</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="8" style="background-color: rgb(102, 255, 51);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="8RGB">102.255.51</div>
    <div id="8HEX">#66FF33</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="9" style="background-color: rgb(51, 255, 102);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="9RGB">51.255.102</div>
    <div id="9HEX">#33FF66</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="10" style="background-color: rgb(51, 255, 204);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="10RGB">51.255.204</div>
    <div id="10HEX">#33FFCC</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="11" style="background-color: rgb(51, 204, 255);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="11RGB">51.204.255</div>
    <div id="11HEX">#33CCFF</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="m1" style="background-color: rgb(0, 61, 245);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="m1RGB">0.61.245</div>
    <div id="m1HEX">#003DF5</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="m2" style="background-color: rgb(0, 46, 184);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="m2RGB">0.46.184</div>
    <div id="m2HEX">#002EB8</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="m3" style="background-color: rgb(245, 184, 0);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="m3RGB">245.184.0</div>
    <div id="m3HEX">#F5B800</div>
</div>
<div style="padding: 10px; width: 90px; float:left;">
    <div id="m4" style="background-color: rgb(184, 138, 0);border: 1px solid; height: 40px; width: 40px; cursor: pointer;"  onclick="SetHex(this.style.backgroundColor);">&nbsp;</div>
    <div id="m4RGB">184.138.0</div>
    <div id="m4HEX">#B88A00</div>
</div>
<div class="Table_templateClear"> <br /> </div> 
<div style="background-color:#000000; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,0,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#000033; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,0,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#000066; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,0,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#000099; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,0,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#0000cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,0,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#0000ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,0,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#003300; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,51,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#003333; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,51,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#003366; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,51,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#003399; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,51,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#0033cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,51,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#0033ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,51,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#006600; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,102,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#006633; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,102,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#006666; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,102,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#006699; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,102,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#0066cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,102,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#0066ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,102,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#009900; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,153,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#009933; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,153,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#009966; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,153,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#009999; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,153,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#0099cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,153,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#0099ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,153,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00cc00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,204,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00cc33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,204,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00cc66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,204,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00cc99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,204,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00cccc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,204,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00ccff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,204,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00ff00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,255,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00ff33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,255,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00ff66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,255,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00ff99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,255,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00ffcc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,255,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#00ffff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(0,255,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#330000; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,0,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#330033; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,0,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#330066; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,0,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#330099; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,0,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#3300cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,0,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#3300ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,0,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#333300; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,51,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#333333; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,51,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#333366; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,51,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#333399; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,51,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#3333cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,51,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#3333ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,51,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#336600; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,102,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#336633; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,102,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#336666; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,102,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#336699; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,102,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#3366cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,102,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#3366ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,102,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#339900; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,153,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#339933; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,153,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#339966; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,153,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#339999; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,153,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#3399cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,153,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#3399ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,153,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33cc00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,204,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33cc33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,204,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33cc66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,204,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33cc99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,204,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33cccc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,204,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33ccff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,204,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33ff00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,255,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33ff33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,255,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33ff66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,255,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33ff99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,255,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33ffcc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,255,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#33ffff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(51,255,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#660000; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,0,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#660033; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,0,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#660066; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,0,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#660099; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,0,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#6600cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,0,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#6600ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,0,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#663300; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,51,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#663333; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,51,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#663366; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,51,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#663399; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,51,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#6633cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,51,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#6633ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,51,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#666600; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,102,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#666633; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,102,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#666666; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,102,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#666699; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,102,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#6666cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,102,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#6666ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,102,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#669900; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,153,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#669933; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,153,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#669966; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,153,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#669999; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,153,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#6699cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,153,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#6699ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,153,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66cc00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,204,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66cc33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,204,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66cc66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,204,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66cc99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,204,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66cccc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,204,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66ccff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,204,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66ff00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,255,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66ff33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,255,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66ff66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,255,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66ff99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,255,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66ffcc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,255,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#66ffff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(102,255,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#990000; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,0,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#990033; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,0,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#990066; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,0,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#990099; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,0,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#9900cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,0,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#9900ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,0,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#993300; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,51,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#993333; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,51,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#993366; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,51,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#993399; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,51,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#9933cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,51,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#9933ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,51,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#996600; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,102,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#996633; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,102,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#996666; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,102,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#996699; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,102,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#9966cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,102,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#9966ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,102,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#999900; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,153,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#999933; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,153,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#999966; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,153,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#999999; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,153,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#9999cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,153,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#9999ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,153,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99cc00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,204,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99cc33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,204,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99cc66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,204,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99cc99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,204,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99cccc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,204,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99ccff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,204,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99ff00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,255,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99ff33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,255,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99ff66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,255,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99ff99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,255,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99ffcc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,255,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#99ffff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(153,255,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc0000; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,0,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc0033; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,0,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc0066; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,0,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc0099; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,0,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc00cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,0,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc00ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,0,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc3300; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,51,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc3333; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,51,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc3366; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,51,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc3399; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,51,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc33cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,51,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc33ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,51,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc6600; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,102,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc6633; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,102,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc6666; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,102,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc6699; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,102,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc66cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,102,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc66ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,102,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc9900; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,153,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc9933; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,153,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc9966; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,153,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc9999; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,153,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc99cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,153,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cc99ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,153,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cccc00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,204,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cccc33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,204,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cccc66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,204,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cccc99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,204,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#cccccc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,204,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ccccff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,204,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ccff00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,255,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ccff33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,255,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ccff66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,255,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ccff99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,255,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ccffcc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,255,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ccffff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(204,255,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff0000; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,0,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff0033; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,0,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff0066; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,0,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff0099; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,0,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff00cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,0,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff00ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,0,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff3300; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,51,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff3333; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,51,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff3366; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,51,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff3399; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,51,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff33cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,51,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff33ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,51,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff6600; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,102,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff6633; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,102,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff6666; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,102,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff6699; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,102,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff66cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,102,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff66ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,102,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff9900; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,153,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff9933; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,153,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff9966; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,153,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff9999; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,153,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff99cc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,153,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ff99ff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,153,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffcc00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,204,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffcc33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,204,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffcc66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,204,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffcc99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,204,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffcccc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,204,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffccff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,204,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffff00; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,255,0); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffff33; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,255,51); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffff66; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,255,102); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffff99; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,255,153); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffffcc; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,255,204); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="background-color:#ffffff; border: 1px solid; height:11px; width:11px; float:left;"><a href="#" onclick="ChangeColors(255,255,255); return false;"><img src="templates/custom/clear.png" border="0" alt="campione" height="11" width="11" /></a></div>
<div style="clear:both;">&nbsp;</div>
</div>
<br />