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
if (!$this->CheckPermission('Manage NMS Lists'))
  {
    $this->_DisplayErrorPage($id, $params, $returnid, 
			     $this->Lang('accessdenied'));
    return;
  }

if( isset($params['cancel']) )
  {
    $this->RedirectToTab($id, 'lists');
  }

$name = '';
if( isset( $params['name'] ) )
  {
    $name = $params['name'];
  }
if( $name == '' )
  {
    $params['error'] = 1;
    $params['message'] = $this->Lang('error_invalidlistname');
    $this->Redirect($id, $params['orig_action'], $returnid, $params );
  }
if( !isset( $params['listid'] ) && isset($saveold) && $saveold == true )
  {
    $params['error'] = 1;
    $params['message'] = $this->Lang('error_invalidparams');
    $this->Redirect($id, $params['orig_action'], $returnid, $params );
  }
$description = '';
if( isset( $params['description'] ) )
  {
    $description = $params['description'];
  }
if( $description == '' )
  {
    $description = $name;
  }
$public = 0;
if( isset( $params['public'] ) )
  {
    $public = $params['public'];
  }

$db = &$this->GetDb();
$record = array(); # Initialize an array to hold the record data to insert			
     
# Set the values for the fields in the record
$record["name"] = $name;
$record["description"] = $description;
$record['public'] = $public;

$event = 'OnNewList';
if (isset($saveold) && $saveold == true)
  {
    $event = 'OnEditList';

    $record["listid"] = $params['listid'];
    $query = "UPDATE ".NMS_LIST_TABLE." SET name = ?, description = ?, public = ? WHERE listid = ?";
    $dbresult = $db->Execute($query, $record); //Force admin access on

  }
 else
   {
     // todo, have to check if this name is already used or not
     $record["active"] = 1;
     $record["dateadded"] = trim($db->DBTimeStamp(time()),"'");
     $query = "INSERT INTO ".NMS_LIST_TABLE." (name, description, public, active, dateadded) VALUES (?,?,?,?,?)";
     $dbresult = $db->Execute($query, $record); //Force admin access on

   }		
if( !$dbresult )
  {
    $this->_DisplayErrorPage( $id, $params, $returnid,
			      $this->Lang('error_insertinglist'));
    echo $db->ErrorMsg();
    return;
  }

// send an event
$parms = array();
$parms['name'] = $name;
$parms['description'] = $description;
$parms['public'] = $public;
if( isset( $params['listid'] ) )
  {
    $parms['listid'] = $params['listid'];
  }
$this->SendEvent($event,$parms);
    
$this->RedirectToTab($id,'lists');

#
# EOF
#
?>