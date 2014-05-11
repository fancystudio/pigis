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
if (!$this->CheckPermission('Manage NMS Jobs'))
  {
    $this->_DisplayErrorPage($id, $params, $returnid, 
			     $this->Lang('accessdenied'));
    return;
  }

$db = $this->GetDb();
$this->SetCurrentTab('jobs');

//
// provide a form that allows the user to select one or more lists
// and one message, and create a job.
//

// get the messages
$messages = array();
{
  $q = "SELECT * FROM ".NMS_MESSAGES_TABLE.' ORDER BY modified DESC';
  $tmp = $db->GetArray($q);
  if( !is_array($tmp) || count($tmp) == 0 )
    {
      $this->SetError($this->Lang('error_nomessages'));
      $this->RedirectToTab($id);
      return;
    }

  foreach( $tmp as $row )
    {
      $messages[$row['subject'].' : '.$row['entered']] = $row['messageid'];
    }
}

// get the lists
$q = 'SELECT A.*,count(B.userid) as num 
        FROM '.NMS_LIST_TABLE.' A 
        LEFT JOIN '.NMS_LISTUSER_TABLE.' B 
        ON A.listid = B.listid 
       GROUP BY B.listid';
$dbresult = $db->Execute( $q );
if( !$dbresult || $dbresult->RecordCount() == 0 )
  {
    $this->SetError($this->Lang('error_nolists'));
    $this->RedirectToTab($id);
    return;
  }

$lists = array();
while( $row = $dbresult->FetchRow() )
  {
    $lists[$row['name']."(".$row['num'].")"] = $row['listid'];
  }

// if we are given a jobid, load the job parts
if( isset( $params['jobid'] ) && $params['jobid'] != '' )
  {
    $q = "SELECT * FROM ".NMS_JOB_PARTS_TABLE." WHERE jobid = ?";
    $dbresult2 = $db->Execute( $q, array( $params['jobid'] ) );
    while( $row2 = $dbresult2->FetchRow() )
      {
	$params['messagelist'] = $row2['messageid'];
	if( !isset( $params['listlist'] ) )
	  {
	    $params['listlist'] = array();
	  }
	$params['listlist'][] = $row2['listid'];
      }
  }

// create the lists list
if( isset( $params['message'] ) )
  {
    $smarty->assign('message',$params['message']);
  }
if( isset( $params['error'] ) )
  {
    $smarty->assign('error',$params['error']);
  }

$sel_msglist = array();
if( isset( $params['messagelist'] ) )
  {
    $sel_msglist = $params['messagelist'];
    if( !is_array( $sel_msglist ) )
      {
	$sel_msglist = array( $params['messagelist'] );
      }
  }
$sel_listlist = array();
if( isset( $params['listlist'] ) )
  {
    if( is_array( $params['listlist'] ) )
      {
	$sel_listlist = $params['listlist'];
      }
    else
      {
	$sel_listlist[] = $params['listlist'];
      }
  }
$jobname = $this->Lang('jobname').': '.strftime("%D %T");
if( isset( $params['jobname'] ) )
  {
    $jobname = $params['jobname'];
  }
 else if( isset( $params['title'] ) )
   {
     $jobname = $params['title'];
   }
 
// now we have both lists, we can build a form
// the form consists of two listboxes
if( isset( $params['jobid'] ) && $params['jobid'] != '' )
  {
    $smarty->assign('hidden',
			  $this->CreateInputHidden($id,'jobid',$params['jobid'] ));
  }
$smarty->assign('title',$this->Lang('createjob'));
$smarty->assign('prompt_name',$this->Lang('name'));
$smarty->assign('jobname',$this->CreateInputText($id,'jobname',$jobname,
						       50,255));
$smarty->assign('prompt_messages',$this->Lang('messages'));
$smarty->assign('messagelist',
		      $this->CreateInputSelectList($id,'messagelist',$messages,
						   $sel_msglist,10,'',false));
$smarty->assign('prompt_lists',$this->Lang('lists'));
$smarty->assign('infotxt',
		      $this->Lang('createjobmsg'));
$smarty->assign('listlist',
		      $this->CreateInputSelectList($id,'listlist[]',$lists,
						   $sel_listlist,10));
$smarty->assign('submit',
		      $this->CreateInputSubmit($id,'submit',$this->Lang('submit')));
$smarty->assign('cancel',
		      $this->CreateInputSubmit($id,'cancel',$this->Lang('cancel')));
$smarty->assign('startform',
		      $this->CreateFormStart($id,'do_create_edit_job',$returnid));
$smarty->assign('endform',$this->CreateFormEnd());

echo $this->ProcessTemplate('createjob.tpl');
?>
