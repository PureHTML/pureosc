#!/bin/bash
CLIPBOARD_DESTINATION='clipboard'
if [[ ! $1 ]];then  
  echo "Enter SVG filename, output stored in clipboard/primary [configurable]"
  exit
fi

SVGDATA=`cat $1 |base64|tr -d '\n'`
echo -n "background:url(\"data:image/gif;base64,${SVGDATA}\")" |xclip -selection $CLIPBOARD_DESTINATION
