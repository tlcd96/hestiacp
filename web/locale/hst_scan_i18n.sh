#!/bin/bash
if [ ! -e /usr/bin/xgettext ]; then
	echo " **********************************************************"
	echo " * Unable to find xgettext please install gettext package *"
	echo " **********************************************************"
	exit 3
fi

delete=0

echo "[ * ] Remove old hestiacp.pot and generate new one"
rm hestiacp.pot
echo "" > hestiacp.pot
find ../.. \( -name '*.php' -o -name '*.html' -o -name '*.sh' \) | xgettext --output=hestiacp.pot --language=PHP --join-existing -f -
OLDIFS=$IFS
IFS=$'\n'
# Scan the description string for list updates page
for string in $(awk -F'DESCR=' '/data=".+ DESCR=[^"]/ {print $2}' $HESTIA/bin/v-list-sys-hestia-updates | cut -d\' -f2); do
	if [ -z "$(grep "\"$string\"" hestiacp.pot)" ]; then
		echo -e "\n#: ../../bin/v-list-sys-hestia-updates:"$(grep -n "$string" $HESTIA/bin/v-list-sys-hestia-updates | cut -d: -f1)"\nmsgid \"$string\"\nmsgstr \"\"" >> hestiacp.pot
	fi
done
# Scan the description string for list server page
for string in $(awk -F'SYSTEM=' '/data=".+ SYSTEM=[^"]/ {print $2}' $HESTIA/bin/v-list-sys-services | cut -d\' -f2); do
	if [ -z "$(grep "\"$string\"" hestiacp.pot)" ]; then
		echo -e "\n#: ../../bin/v-list-sys-services:"$(grep -n "$string" $HESTIA/bin/v-list-sys-services | cut -d: -f1)"\nmsgid \"$string\"\nmsgstr \"\"" >> hestiacp.pot
	fi
done
IFS=$OLDIFS

echo "[ * ] Scan language folders"
languages=$(ls -d $HESTIA/web/locale/*/ | awk -F'/' '{print $(NF-1)}')
echo "[ * ] Update hestiacp.pot with new files"
for lang in $languages; do
	if [ -e "$HESTIA/web/locale/$lang/LC_MESSAGES/hestiacp.po" ]; then
		echo "[ * ] Update $lang "
		mv $HESTIA/web/locale/$lang/LC_MESSAGES/hestiacp.po $HESTIA/web/locale/$lang/LC_MESSAGES/hestiacp.po.bak
		msgmerge --verbose "$HESTIA/web/locale/$lang/LC_MESSAGES/hestiacp.po.bak" "$HESTIA/web/locale/hestiacp.pot" > $HESTIA/web/locale/$lang/LC_MESSAGES/hestiacp.po
		rm $HESTIA/web/locale/$lang/LC_MESSAGES/hestiacp.po.bak
	fi
done
echo "[ ! ] Update complete"
