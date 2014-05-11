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

$db =& $this->GetDb();
global $themeObject;
$result= array ();
$query= "SELECT * FROM ".NMS_LIST_TABLE;
$dbresult= $db->Execute($query);
if (!$dbresult || $dbresult->RecordCount() == 0)
  {
    $smarty->assign('message', $this->Lang('error_nolists'));
    $smarty->assign('error', 1);
    $smarty->assign('noform', 1);
    echo $this->ProcessTemplate('messages.tpl');
    return;
  }
$query= "SELECT * FROM ".NMS_MESSAGES_TABLE." ORDER BY entered desc";
$dbresult= $db->Execute($query);
$rowclass= 'row1';
$rowarray= array ();
$currow= "row1";
if ($dbresult && $dbresult->RecordCount() > 0)
  {
    while ($row= $dbresult->FetchRow())
      {
	$record= array ();
	$record['messageid']= $row['messageid'];

	$onerow= new StdClass();
	$onerow->id= $row['messageid'];
	$onerow->subject= 
	  $this->CreateLink($id,'compose_message',$returnid,
			    $row['subject'],$record);
	$onerow->entered= $row['entered'];
	$onerow->editlink= $this->CreateLink($id, 'compose_message', $returnid, 
		      $themeObject->DisplayImage('icons/system/edit.gif', $this->Lang('edit'), 
						 '', '', 'systemicon'), $record);
	$onerow->deletelink= $this->CreateLink($id, 'delete_message', $returnid, 
		      $themeObject->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),
						 '', '', 'systemicon'), $record, 
					       $this->Lang('confirmdelete'));
	$onerow->text_only = $row['text_only'];

	$onerow->rowclass= $rowclass;
	($rowclass == "row1" ? $rowclass= "row2" : $rowclass= "row1");
	$rowarray[]= $onerow;
      }
  }

$smarty->assign('idtext', $this->Lang('id'));
$smarty->assign('subjecttext', $this->Lang('subject'));
$smarty->assign('enteredtext', $this->Lang('entered'));
//     $smarty->assign('statustext',$this->Lang('status'));
$smarty->assign('itemsfound', $this->Lang('messagesfoundtext'));
$smarty->assign('itemcount', count($rowarray));
$smarty->assign('items', $rowarray);
$link= $this->CreateLink($id, 'compose_message', $returnid, $themeObject->DisplayImage('icons/system/newobject.gif', $this->Lang('title_mod_compose_message'), '', '', 'systemicon'), array ()) . ' ';
$link .= $this->CreateLink($id, 'compose_message', $returnid, $this->Lang('title_mod_compose_message'), array ());
$smarty->assign('createlink', $link);
echo $this->ProcessTemplate('messages.tpl');

#
# EOF
#
?>