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

$db= & $this->GetDb();
global $config;
global $themeObject;
$query= "SELECT * FROM ".NMS_LIST_TABLE;
$dbresult= $db->Execute($query);
if (!$dbresult || $dbresult->RecordCount() == 0)
  {
    $smarty->assign('message', $this->Lang('error_nolists'));
    $smarty->assign('error', 1);
    $smarty->assign('noform', 1);
    echo $this->ProcessTemplate('users.tpl');
    return;
  }
$query= "SELECT * FROM ".NMS_MESSAGES_TABLE;
$dbresult= $db->Execute($query);
if (!$dbresult || $dbresult->RecordCount() == 0)
  {
    $smarty->assign('message', $this->Lang('error_nomessages'));
    $smarty->assign('error', 1);
    $smarty->assign('noform', 1);
    echo $this->ProcessTemplate('users.tpl');
    return;
  }
if (isset ($params['error']))
  {
    $smarty->assign('error', $params['error']);
  }
if (isset ($params['message']))
  {
    $smarty->assign('message', $params['message']);
  }
$q= "SELECT * FROM ".NMS_TEMP_TABLE." LIMIT 1";
$badjobid= '';
$dbresult= $db->Execute($q);
if ($dbresult && $dbresult->RecordCount())
  {
    // temporary table exists, we have an error condition
    $badrow= $dbresult->FetchRow();
    $badjobid= $badrow['jobid'];
  }
if ($badjobid != '')
  {
    $q= "UPDATE " .NMS_JOBS_TABLE." SET status = ? 
		              WHERE jobid = ?";
    $db->Execute($q, array (
			    -1,
			    $badjobid
			    ));
  }

//
// 1. Display the current job queue
// (all entries in message_list grouped by job id I guess
// and allow him to edit jobs
//
//$q= "SELECT * FROM ".NMS_JOBS_TABLE." ORDER BY created ASC,started,status";
$q= "SELECT * FROM ".NMS_JOBS_TABLE." ORDER BY created DESC";
$dbresult= $db->Execute($q);
$rowarray= array ();
$rowclass= 'row1';
while ($row= $dbresult->FetchRow())
  {
    $emails= "N/A";
    if ($row['status'] != 3)
      {
	$q2= "SELECT DISTINCT jobid,email,username,messageid 
                         FROM ".NMS_LISTUSER_TABLE." A LEFT JOIN ".
	                        NMS_JOB_PARTS_TABLE." B on A.listid = B.listid 
                    LEFT JOIN ".NMS_USERS_TABLE." C on A.userid = C.userid 
		        WHERE C.disabled = 0 AND C.confirmed = 1 AND jobid = ? 
                     ORDER BY messageid";
	$dbresult2= $db->Execute($q2, array (
					     $row['jobid']
					     ));
	if ($dbresult2 && $dbresult2->RecordCount())
	  {
	    $emails= $dbresult2->RecordCount();
	  }
      }
    $onerow= new StdClass();
    $onerow->rowclass= $rowclass;
    $onerow->id= $row['jobid'];
    $onerow->name= $row['title'];
    $onerow->emails= $emails;
    $onerow->created= $row['created'];
    $onerow->started= $row['started'];
    $onerow->finished= $row['finished'];
    $onerow->status= $this->_statusToText($row['status']);
    // we can only edit the job if the status is 0
    if ($row['status'] == 0)
      {
	$onerow->editlink= $this->CreateLink($id, 'create_edit_job', $returnid, $themeObject->DisplayImage('icons/system/edit.gif', $this->Lang('edit'), '', '', 'systemicon'), $row);
      }

# we can only delete a job if the status is not in progress
    if ($row['status'] != 1)
      {
	$onerow->deletelink= $this->CreateLink($id, 'delete_job', $returnid, $themeObject->DisplayImage('icons/system/delete.gif', $this->Lang('delete'), '', '', 'systemicon'), $row, $this->Lang('confirmdeletejob'));
      }
    switch ($row['status'])
      {
      case -1 :
	$onerow->actionlink= $this->CreateLink($id, 'reset_job', $returnid, $this->Lang('reset'), array (
													     'jobid' => $row['jobid']
													     ));
	break;
      case 0 :
	$onerow->actionlink= $this->CreateLink($id, 'pause_job', $returnid, $this->Lang('suspend'), array (
													       'jobid' => $row['jobid']
													       ));
	break;
      case 2 :
	$onerow->actionlink= $this->CreateLink($id, 'resume_job', $returnid, $this->Lang('resume'), array (
													       'jobid' => $row['jobid']
													       ));
	break;
      }
    ($rowclass == "row1" ? $rowclass= "row2" : $rowclass= "row1");
    $rowarray[]= $onerow;
  }

$smarty->assign('title_warning',$this->Lang('warning'));
$smarty->assign('jobs_warning',$this->Lang('jobs_warning'));
$smarty->assign('idtext', $this->Lang('id'));
$smarty->assign('emailstext', $this->Lang('nummessages'));
$smarty->assign('nametext', $this->Lang('name'));
$smarty->assign('createdtext', $this->Lang('created'));
$smarty->assign('startedtext', $this->Lang('started'));
$smarty->assign('finishedtext', $this->Lang('finished'));
$smarty->assign('actiontext', $this->Lang('action'));
$smarty->assign('statustext', $this->Lang('status'));
$smarty->assign('itemsfound', $this->Lang('jobsfoundtext'));
$smarty->assign('itemcount', count($rowarray));
$smarty->assign('items', $rowarray);
$smarty->assign('createlink', 
		$this->CreateImageLink($id,'create_edit_job',$returnid,
				       $this->Lang('title_mod_compose_job'),
				       'lightning_add.png',
				       array(), '', '', false));
// 		$this->CreateLink($id, 'create_edit_job', $returnid, 
// 				  $themeObject->DisplayImage('icons/system/newobject.gif', $this->Lang('title_mod_compose_job'), '', '', 'systemicon')).
// 		$this->CreateLink($id, 'create_edit_job', $returnid,
// 				  $this->Lang('title_mod_compose_job')));

// check if the temporary table exists
// if it does, allow it to be deleted
{
  // mysql only?
  $q = "SHOW TABLES LIKE ?";
  $dbresult = $db->Execute( $q, array(NMS_TEMP_TABLE) );
  if( $dbresult && $dbresult->RecordCount() > 0 ) {
    $smarty->assign('cleantemplink', $this->CreateLink($id,'cleantemptable', $returnid, $this->Lang('cleantemptable')));
  }
}

if (count($rowarray))
  {
    // popup the processing in a new window
    $smarty->assign('processlink', 
		    $this->CreateImageLink($id,'process_queue',$returnid,
					   $this->Lang('processjobs'),
					   'lightning_go.png',
					   array('disable_buffer'=>1,
						 'disable_theme'=>1),
					   '',
					   $this->Lang('confirmsend'),
					   false, false,
					   " target=\"_blank\""));
    $smarty->assign('deletecompletedlink', 
		    $this->CreateImageLink($id,'delete_completed',$returnid,
					   $this->Lang('deletecompleted'),
					   'lightning_delete.png',
					   array(), '', '', false));
  }
echo $this->ProcessTemplate('jobs.tpl');

#
# EOF
#
?>