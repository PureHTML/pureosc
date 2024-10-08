H=`cat ../catalog/includes/local/configure.php|egrep  "define\('DB_SERVER'"|sed  "s:\\define('DB_SERVER', '::"|sed "s/');//"|sed 's/^.//'`
D=`cat ../catalog/includes/local/configure.php|egrep  "define\('DB_DATABASE'"|sed "s/define('DB_DATABASE', '//"|sed "s/');//"|sed 's/^.//'`
U=`cat ../catalog/includes/local/configure.php|egrep  "define\('DB_SERVER_USERNAME'"|sed "s/define('DB_SERVER_USERNAME', '//"|sed "s/');//"|sed 's/^.//'`
P=`cat ../catalog/includes/local/configure.php|egrep  "define\('DB_SERVER_PASSWORD'"|sed "s/define('DB_SERVER_PASSWORD', '//"|sed "s/');//"|sed 's/^.//'`
#if [ $P ];then P="-p${P}";fi
#exit
#echo -e "h:$H\nd:$D\nu:$U\np:$P"
#echo root:
#echo -e "h:$H\nd:$D\nRU:$RU\nRP:$RP"

#Warning: DBUSERSHIFT  wc D include "_" and "+1" is NEXT position !!!
DBUSERSHIFT=$((`echo ${D}|wc -m`+1))
