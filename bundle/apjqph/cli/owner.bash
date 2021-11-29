#!/bin/bash

HOME=`pwd`
FOLDER=`pwd | grep -o [^/]* | sed -e '$!{h;d;}' -e x`

cd ../..

chmod 770 $FOLDER

#echo $FOLDER
#exit

#echo -e 'Mode for executable files.'
#find $FOLDER -type f \( -path "$FOLDER/cli/*" -and -not -path '*/\.ht*' -and \( -name "*.php" -or -name "*.sh" -or -name "*.bash" \) \) -exec chmod 770 {} \;

echo -e 'Mode for folders.'
#find $FOLDER -type d -exec chmod 770 {} \; 2>/dev/null
find $FOLDER -type d \( -not -path "$FOLDER/cli" -and -not -path '*/\.ht*' \) -exec chmod 770 {} \;

echo -e 'Mode for files.'
find $FOLDER -type f \( -not -path "$FOLDER/cli/*" -and -not -path '*/\.ht*' \) -exec chmod 660 {} \;

echo
cd $HOME
