#!/bin/sh -x

# Enter the value here of your root url
sitename='http://svr.techcom.dyndns.org/cms_test/svn';

# Enter the value here of the location to keep temporary files
# you should not have to modify this line, but if you do encounter errors
# you may want to point this setting at your CMS Made simple tmp/cache location
file_dir=/tmp

# Enter the username and password of a CMS user that has both
# 'Manage NMS Messages' and 'Manage NMS Users' permission.
username=username
password=password

#
# Do not modify anything below this line
#
_tmpdir=$file_dir/`basename $0`.$$
mkdir $_tmpdir >/dev/null 2>/dev/null
if [ !-d $_tmpdir ]; then
   echo "FATAL: Could not create temporary directory
   exit 1
fi

postdata='username={$username}&password={$password}&loginsubmit=Submit'
cookies=_cookies.tmp
_owd=`pwd`
cd $_tmpdir

# do the login
wget --save-cookies ${cookies} --keep-session-cookies --post-data=$postdata ${sitename}/admin/login.php

# Perform the action(s)
wget --load-cookies ${cookies} ${sitename}/admin/moduleinterface.php\?mact=NMS,m1_,process_queue,0
wget --load-cookies ${cookies} ${sitename}/admin/moduleinterface.php\?mact=NMS,m1_,manage_bounces,0


# Cleanup
cd $_owd
rm -rf $_tmpdir 2>/dev/null

