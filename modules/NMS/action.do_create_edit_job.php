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
if (!$this->CheckPermission('Manage NMS Jobs')) return;

$this->SetCurrentTab('jobs');

if( isset($params['cancel']) )
  {
    $this->RedirectToTab($id);
  }
if( !isset($params['messagelist']) )
  {
    $this->SetError($this->Lang('error_nomessagesselected'));
    $this->Redirect($id,'create_edit_job',$returnid,$params);
    return;
  }
if( !isset($params['listlist']) )
  {
    $this->SetError($this->Lang('error_nolistsselected'));
    $this->Redirect($id,'create_edit_job',$returnid,$params);
    return;
  }
if( !isset( $params['jobname'] ) || $params['jobname'] == '' )
  {
    $this->SetError($this->Lang('error_nojobname'));
    $this->Redirect($id,'create_edit_job',$returnid,$params);
    return;
  }
$jobid='';
if( isset( $params['jobid'] ) && $params['jobid'] != '' )
  {
    // we're editing an existing record
    $jobid = $params['jobid'];
  } 
$jobname = trim($params['jobname']);

$message = $params['messagelist'];
$lists = array();
if( is_array( $params['listlist'] ) )
  {
    $lists = $params['listlist'];
  }
 else
   {
     $lists[] = $params['listlist'];
   }

if( $jobid != '' )
  {
# editing an existing job
# we can only edit unstarted jobs
# so we can safely delete this job in its entirety, and re-add it
    $params['noredirect'] = 0;
    include(dirname(__FILE__).'/action.delete_job.php');
  }

# adding a new job (or replace an existing one, will always result in a new id
    
// make sure that the job name doesn't already exist
$db = $this->GetDb();
$q = "SELECT * FROM ".NMS_JOBS_TABLE." WHERE title = ?";
$dbresult = $db->Execute( $q, array( $jobname ) );
if( $dbresult && $dbresult->RecordCount() )
  {
    $this->SetError($this->Lang('error_jobnameexists'));
    $this->Redirect($id,'create_edit_job',$returnid,$params);
    return;
  }
	
// now we're ready to create the job
$q = "INSERT INTO ".NMS_JOBS_TABLE." (title,created,status) VALUES (?,?,?)";
$dbresult = $db->Execute( $q, array( $jobname, 
				     trim($db->DbTimeStamp(time()),"'"),0) );
if( !$dbresult )
  {
    $this->SetError($this->Lang('error_dberror'));
    $this->Redirect($id,'create_edit_job',$returnid,$params);
    return;
  }

// get the jobid
$q = "SELECT jobid FROM ".NMS_JOBS_TABLE."
       WHERE title = ?";
$dbresult = $db->Execute( $q, array( $jobname ) );
$row = $dbresult->FetchRow();
$jobid = $row['jobid'];
	
// and add the job parts
foreach( $lists as $listid )
{
  $q = "INSERT INTO ".NMS_JOB_PARTS_TABLE."
             VALUES (?,?,?,?)";
  $dbresult = $db->Execute( $q, array( $jobid, $listid, $message, 0 ) );
}

// Send an event
$parms = array();
$parms['jobid'] = $jobid;
$parms['jobname'] = $jobname;
$parms['lists'] = $lists;
$this->SendEvent('OnCreateJob',$parms);
    
// all done
if( !isset($params['noredirect']) )
  {
    $this->RedirectToTab($id);
  }

#
# EOF
#
?>