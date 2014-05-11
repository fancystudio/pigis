<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Newsletter Made Simple (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to provide a flexible
#  mailing list solution.
# 
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin 
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE
if( !isset($gCms) ) exit;
if (!$this->CheckPermission('Manage NMS Users')) {
  $this->_DisplayErrorPage($id, $params, $returnid, $this->Lang('accessdenied'));
  return;
 }

if( !isset($params['input_lists']) || !is_array($params['input_lists']) || 
    (count($params['input_lists']) == 0) )
  {
    $params['message'] = $this->Lang('error_nolistsselected');
    $params['error'] = 1;
    $this->Redirect($id, 'import_users', $returnid, $params);
    return;
  }

set_time_limit(9999);
$db =& $this->GetDb();
  
if (!isset($_FILES[$id . 'input_filename']) || !isset($_FILES) || !is_array($_FILES[$id . 'input_filename']) || !$_FILES[$id . 'input_filename']['name']) {
  $params['message'] = $this->Lang('error_nofilesuploaded');
  $params['error'] = 1;
  $this->Redirect($id, 'import_users', $returnid, $params);
  return;
 }
  
// normalize the file variable
$file = $_FILES[$id . 'input_filename'];
if (!isset($file['type']))
  $file['type'] = '';
if (!isset($file['size']))
  $file['size'] = '';
if (!isset($file['tmp_name']))
  $file['tmp_name'] = '';
//$file['name'] = preg_replace('/[^a-zA-Z0-9\.\$\%\'\`\-\@\{\}\~\!\//\(\)\&\_\^]/', '', str_replace(array(' ', '%20'), array('_', '_'), $file['name']));
  
// we can now open the file, and read it's contents
$alllines = file($file['tmp_name']);
if (count($alllines) == 0) {
  $params['message'] = $this->Lang('error_emptyfile');
  $params['error'] = 1;
  $this->Redirect($id, 'import_users', $returnid, $params);
  return;
 }
  
// now process the lines
$errors = array();
$errorcount = 0;
$linenum = 0;
$usersadded = 0;
$membershipsadded = 0;
$username = '';
foreach ($alllines as $line) {
  $linenum++;
      
  // strip off comments
  $p = strrpos($line, '//');
  if ($p) {
    $line = trim(substr($line, 0, $p));
  }

  $p = strrpos($line, '#');
  if( $p ) {
    $line = trim(substr($line, 0, $p));
  }
      
  // strip off extra whitespace
  $line = trim($line);
      
  // skip empty lines
  if ($line == '') {
    continue;
  }
      
  $fields = explode(',', $line);
  if (count($fields) < 1 || count($fields) > 2) {
    $errors[] = $this->Lang('importerror_nofields', $linenum);
    $errorcount++;
    continue;
  }
      
  // woohoo, we have at least 1 column
  // but possibly 2
      
  // check the email address to make sure it's valid (should have an @ sign in it)
  // todo
  $email = trim($fields[0]);
  if( count($fields) == 2 )
    {
      $username = trim($fields[1]);
    }

  // Lets see if this is a record update rather than a new user.
  // Use the uniqueid and or email to find the record
  $now = $db->DbTimeStamp(time());
  $query = "SELECT userid FROM ".NMS_USERS_TABLE." WHERE email = ?";
  $userid = $db->GetOne($query,array($email));
  if( !$userid ) {
    // New user, add the user
    $uniqueid = md5(uniqid(rand(),1));
    $query = "INSERT INTO ".NMS_USERS_TABLE." (email, username, uniqueid, disabled, confirmed, htmlemail, dateadded) VALUES (?,?,?,?,?,?,$now)";
    $dbresult = $db->Execute($query, 
			     array($email, $username, $uniqueid, 0, 1, 1));
    if (!$dbresult) {
      $errors[] = $this->Lang('importerror_cantcreateuser', $linenum, $email);
      $errorcount++;
      continue;
    }
    $userid = $db->Insert_ID();
    $usersadded++;
  }

  // a little error check
  if ($userid == '') {
    $errors[] = $this->Lang('importerror_cantgetuserid', $linenum, $email);
    $errorcount++;
    continue;
  }

  // and add him to the list(s)
  $query = 'INSERT INTO '.NMS_LISTUSER_TABLE." (userid,listid,active,entered)
         VALUES (?,?,1,$now)";
  foreach( $params['input_lists'] as $listid )
    {
      $dbr = $db->Execute($query, array($userid,$listid));
      if( $dbr )
	{
	  $membershipsadded++;
	}
    }
      
  // and go around again
}
  
// all done
if ($errorcount > 0) {
  $smarty->assign('errorcountmsg', $this->Lang('error_importerrorcount'));
  $smarty->assign('linesmsg', $this->Lang('lines'));
  $smarty->assign('usersaddedmsg', $this->Lang('users_added'));
  $smarty->assign('membershipsmsg', $this->Lang('memberships'));
      
  $smarty->assign('errors', $errors);
  $smarty->assign('errorcount', $errorcount);
  $smarty->assign('lines', $linenum);
  $smarty->assign('usersadded', $usersadded);
  $smarty->assign('memberships', $membershipsadded);
  echo $this->ProcessTemplate('import_errors.tpl');
  return;
 } else {
  $params['lines'] = $linenum;
  $params['usersadded'] = $usersadded;
  $params['membershipsadded'] = $membershipsadded;
  $this->Redirect($id, 'import_users', $returnid, $params);
 }
?>