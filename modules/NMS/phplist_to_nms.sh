#!/bin/sh
_tmp=/tmp/tmp.$$

cat "$1" | tr -s "\t" , | tail +2 2>/dev/null | grep -v 'No Lists' | cut -d, -f2,6 > $_tmp

while read line; do
  email=`echo $line | cut -d, -f1`
  list=`echo $line | cut -d, -f2`

  echo $email,'',$list,1
done < $_tmp

rm -f $_tmp

