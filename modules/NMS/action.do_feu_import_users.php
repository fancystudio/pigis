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

/*
	LEFT TO DO:
		the Back to menu button needs to go to NMS not the admin home
*/


// action page to import users from FEU to NMS
if (!$this->CheckPermission('Manage NMS Users')) {
	$this->_DisplayErrorPage($id, $params, $returnid, $this->Lang('accessdenied'));
	return;
}
$feu =& $this->GetModuleInstance('FrontEndUsers');
if( !$feu ) {
  $this->_DisplayErrorPage($id, $params, $returnid, $this->Lang('import_feu_feunotinstalled'));
  return;
} 
if( version_compare($feu->GetVersion(),'1.6.2') <= 0 )
  {
    $this->_DisplayErrorPage($id,$params,$returnid, $this->Lang('import_feu_badversion'));
    return;
  }

if( isset($params['cancel']) ) {
  $this->RedirectToTab($id,'users');
  return;
}	

$db =& $this->GetDb();
$errorcount = 0;
$usersadded = 0;

// variables for output
$processedAddresses = array();
$inDatabase = array();
$onListAlready = array();
$addressSubscribed = array();

if( !isset($params['groupid']) || !isset($params['listid']) ) {
	$this->_DisplayErrorPage($id, $params, $returnid, 
							 $this->Lang('error_insufficientparams'));
	return;
}

$groupid = $params['groupid'];

// Get the list of FEU users from this group, and
// get their email addresses.
$users = $feu->GetUsersInGroup($params['groupid']);
$now = time();
$dbnow = trim($db->DbTimeStamp($now,"'"));

foreach( $users as $oneuser )
{
	// skip this user if he's expired
	$ts = $db->UnixTimeStamp($oneuser['expires']);
	if( $ts < $now ) {
		continue;
	}
	
	// get the users email address
	$emailaddy = $feu->GetEmail($oneuser['id']);

	// see if we already have this email address, and for this list
	$q = "SELECT * FROM ".NMS_USERS_TABLE." WHERE email = ?";
	$row = $db->GetRow($q,array($emailaddy));
	$nmsuid = '';
	if( $row ) {
	  $nmsuid = $row['userid'];

	  $q2 = "SELECT * FROM ".NMS_LISTUSER_TABLE."
                  WHERE userid = ? AND listid = ?";
	  $row2 = $db->GetRow($q2,array($nmsuid,$params['listid']));
	  if( $row2 ) {
	    // user is known and is already a member.  nothing to do.
	    continue;
	  }
	}

	if( $nmsuid == '' ) {
		// Add the user
		$q = 'INSERT INTO '.NMS_USERS_TABLE.'
               (uniqueid,email,username,disabled,confirmed,htmlemail,dateadded,dateconfirmed)
                VALUES (?,?,?,?,?,?,?,?)';
		$uniqueid = md5(uniqid(rand(),1));
		$username = (isset($params['copyusername'])&&$params['copyusername']==1)?$oneuser['username']:'';
		$p = array($uniqueid,$emailaddy,$username,0,1,0,$dbnow,$dbnow);
		$db->Execute($q,$p);

		$q = 'SELECT userid FROM '.NMS_USERS_TABLE.' WHERE uniqueid = ?';
		$row = $db->GetRow($q,array($uniqueid));
		$nmsuid = $row['userid'];
	}

	// Add the membership
	$q = 'INSERT INTO '.NMS_LISTUSER_TABLE.' VALUES (?,?,?,?)';
	$db->Execute($q,array($nmsuid,$params['listid'],1,$dbnow));
}

$this->RedirectToTab($id,'users');

?>