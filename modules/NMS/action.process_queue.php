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

// ABANDON HOPE ALL YEE WHO ENTER HERE
// this code is in serious need of a rewrite

if (!$this->CheckPermission('Manage NMS Jobs'))
  {
    $this->_DisplayErrorPage($id, $params, $returnid, 
			     $this->Lang('accessdenied'));
    return;
  }

   // Page header... note that all styles, etc. are inline
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
          <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <title>'.$this->GetFriendlyName().' '.$this->Lang('processing_job').'</title>
            <style type="text/css">
            body {
               background-color: #395D73;
             font: 0.8em/1 Geneva, Verdana, Arial, sans-serif;
            }
            #wrap {
             background-color: #FFF;
             border-right: 1px solid #CCC;
             border-bottom: 1px solid #333;
             border-left: 1px solid #333;
             padding: 2em;
             margin: 5em;
             position: relative;
             text-align: left;
             width: 760px !important;
             width /**/: 752px;
            }
            div.error {
                color: #F00;
                font-size: 1.2em;
                font-weight: bold;
            }
            div.header {
                color:#000;
                font-size: 1.2em;
                font-weight: bold;
            }
            div.progress {
                color: 666;
            }
            .close {
                text-decoration: underline;
                color: #00F;
            }
            </style>
            </head>
          <body>
          <div id="wrap">
          <div class="header">'.$this->GetFriendlyName().' '.$this->Lang('msg_jobprocessing').'</div><br/>
          <div class="progress" align="center">';

$config = cmsms()->GetConfig();
$start_time = time();
$db = $this->GetDb();
$first = isset($params['start_record'])?false:true;
if( ($first == false) && 
    (!isset($params['thejob']) || $params['thejob'] == '' ||
     !isset($params['start_time']) || $params['start_time'] == '') )
  {
    $this->_DisplayErrorPage($id, $params, $returnid, 
			     $this->Lang('error_insufficientparams'));
    return;
  }

$num_emails = 0;
if( isset( $params['num_emails'] ) )
  {
    $num_emails = $params['num_emails'];
  }
if( isset( $params['start_time'] ) && $params['start_time'] != '' )
  {
    $start_time = $params['start_time'];
  }
if( isset( $params['alldone'] ) )
  {
    // we're all done, spit out some nice information
    // and clean up.
    if( isset( $params['error'] ) )
      {
	echo '<div class="error">'.$params['error'].'</div>';
      }
    echo "<p><strong>".$this->Lang('queuefinished')."</strong></p>";
    $totaltime = time() - $start_time;
    echo "<p>".$this->Lang('totaltime')." ".$totaltime." <strong>".$this->Lang('seconds')."</strong></p>";
    echo "<p>".$this->Lang('totalmails')." <strong>".$num_emails."</strong></p>";
    echo "<p>".$this->Lang('okclosewindow')."</p></div></body></html>";
    @ob_flush(); flush();
    return;
  }

// keep window open message
echo "<p><strong>".$this->Lang('keepwindowopen')."</strong></p>";

// just in case, set the time_limit of this page to unlimited
// though ideally we should set this to some formula like
// message_per_batch * sleep_per_message + some forgiveness
// NOTE: some servers may not let this happen
set_time_limit(9999);

if( $first )
  {
    //
    // we're initializing a job
    //

    // get the first job that has a status of 0
    $q = "SELECT * FROM ".NMS_JOBS_TABLE." WHERE status = ? LIMIT 1";
    $jobrow = $db->GetRow( $q, array( 0 ) );
    if( !$jobrow || !is_array($jobrow) )
      {
	// no further jobs to process
	$parms = array();
	$parms['alldone'] = 1;
	$parms['foo'] = 0;
	$parms['disable_buffer'] = 1;
	$parms['disable_theme'] = 1;
	$parms['start_time'] = $start_time;
	$parms['num_emails'] = $num_emails;
	$this->Audit($jobrow['jobid'],'NMS - Process Queue','Job Finished');
	$this->Redirect( $id, 'process_queue', $returnid, $parms );
	return;
      }
    //$jobrow = $dbresult->FetchRow();
	
    // next check the message, make sure it still exists
    $messageid = '';
    {
      $q = "SELECT DISTINCT messageid 
                FROM ".NMS_JOB_PARTS_TABLE."
               WHERE jobid = ?";
      $dbresult = $db->Execute($q,array($jobrow['jobid']));
      if( !$dbresult )
	{
	  // process error - could not find job part
	  $parms = array();
	  $parms['alldone'] = 1;
	  $parms['foo'] = 1;
	  $parms['disable_buffer'] = 1;
	  $parms['disable_theme'] = 1;
	  $parms['start_time'] = $start_time;
	  $parms['error'] = $this->Lang('error_couldnotfindjobpart');
	  $parms['num_emails'] = $num_emails;
	  $parms['thejob'] = $jobrow['jobid'];
	  $this->Audit($jobrow['jobid'],'NMS - Process Queue',$parms['error']);
	  $this->Redirect( $id, 'process_queue', $returnid, $parms );
	}
      $tmprow = $dbresult->FetchRow();
	  
      $q = "SELECT * 
                  FROM ".NMS_MESSAGES_TABLE."
                 WHERE messageid = ?";
      $dbresult = $db->Execute($q,array($tmprow['messageid']));
      if( !$dbresult )
	{
	  // process error - could not find message
	  $parms = array();
	  $parms['alldone'] = 1;
	  $parms['foo'] = 2;
	  $parms['disable_buffer'] = 1;
	  $parms['disable_theme'] = 1;
	  $parms['start_time'] = $start_time;
	  $parms['error'] = $this->Lang('error_couldnotfindmessage');
	  $parms['num_emails'] = $num_emails;
	  $this->Audit($jobrow['jobid'],'NMS - Process Queue',$parms['error']);
	  $this->Redirect( $id, 'process_queue', $returnid, $parms );
	}
      $tmprow = $dbresult->FetchRow();
	  
      // then check to see if the template id that the message refers to (if >= 0 )
      // is valid and exists
/*
      if( $tmprow['templateid'] > 0 )
	{
	  global $gCms;
	  $obj =& $gCms->GetTemplateOperations();
	  $templ = $obj->LoadTemplateByID($tmprow['templateid']);
	  if( !$templ )
	    {
	      // process error - could not find template
	      $parms = array();
	      $parms['alldone'] = 1;
	      $parms['disable_buffer'] = 1;
	      $parms['disable_theme'] = 1;
	      $parms['start_time'] = $start_time;
	      $parms['error'] = $this->Lang('error_couldnotfindtemplate');
	      $parms['num_emails'] = $num_emails;
	      $parms['thejob'] = $jobrow['jobid'];
	      $this->Redirect( $id, 'process_queue', $returnid, $parms );
	    }
	}
*/

    }


    // check to see if our temporary table exists
    // if it does, and we've starting processing
    // that is an error
    $q = "SELECT * FROM ".NMS_TEMP_TABLE." LIMIT 1";
    $dbresult = $db->Execute( $q );
    if( $dbresult && $dbresult->RecordCount() )
      {
	// todo, error
	$parms = array();
	$parms['alldone'] = 1;
	$parms['foo'] = 3;
	$parms['disable_buffer'] = 1;
	$parms['disable_theme'] = 1;
	$parms['start_time'] = $start_time;
	$parms['error'] = $this->Lang('error_temporarytableexists');
	$parms['num_emails'] = $num_emails;
	$parms['thejob'] = $jobrow['jobid'];
	$this->Audit($jobrow['jobid'],'NMS - Process Queue',$parms['error']);
	$this->Redirect( $id, 'process_queue', $returnid, $parms );
	return;
      }

    echo "<p>".$this->Lang('initializing_job').': <strong>'.$jobrow['title'].'</strong></p>';
    flush(); @ob_flush();

    // create a table (temporary in purpose) containing all
    // of the emails we're going to send to
    $taboptarray = array('mysql' => 'TYPE=MyISAM');
    $dict = NewDataDictionary($db);
    $flds = "
                jobid I,
                messageid I,
                email C(125),
                uniqueid C(225),
                username C(255),
                status I
		";
    $sqlarray = $dict->CreateTableSQL(NMS_TEMP_TABLE,$flds,
				      $taboptarray);
    $dict->ExecuteSQLArray($sqlarray);
	
    // insert some records into the table 
    // NOTE: We can probably do this better, with some kind of SELECT FROM
    //       statement or something, but....
    $q = "SELECT DISTINCT jobid,email,username,C.uniqueid,messageid FROM ".
            NMS_LISTUSER_TABLE." A left join ".
            NMS_JOB_PARTS_TABLE." B on A.listid = B.listid left join ".
            NMS_USERS_TABLE." C on A.userid = C.userid 
	  WHERE C.disabled = 0 AND C.confirmed = 1 AND COALESCE(C.error_count,0) < ? AND jobid = ? 
          ORDER BY messageid";
    $dbresult = $db->Execute( $q, array( $this->GetPreference('max_error_count',5), $jobrow['jobid'] ) );
    if( !$dbresult || $dbresult->RecordCount() == 0 )
      {
	// error
	$parms = array();
	$parms['alldone'] = 1;
	  $parms['foo'] = 4;
	$parms['disable_buffer'] = 1;
	$parms['disable_theme'] = 1;
	$parms['start_time'] = $start_time;
	$parms['error'] = $this->Lang('error_buildingtemptable');
	$parms['num_emails'] = $num_emails;
	$parms['thejob'] = $jobrow['jobid'];
	$this->Audit($jobrow['jobid'],'NMS - Process Queue',$parms['error']);
	$this->Redirect( $id, 'process_queue', $returnid, $parms );
	return;
      }

    $count = 0;
    $q = "INSERT INTO ".NMS_TEMP_TABLE." VALUES (?,?,?,?,?,?)";
    while( $row = $dbresult->FetchRow() )
      {
	$tmp = array( $jobrow['jobid'],
		      $row['messageid'],
		      $row['email'],
		      $row['uniqueid'],
		      $row['username'],
		      0 );
	$dbresult2 = $db->Execute( $q, $tmp );
	if( !$dbresult2 )
	  {
	    $parms = array();
	    $parms['alldone'] = 1;
	    $parms['foo'] = 5;
	    $parms['disable_buffer'] = 1;
	    $parms['disable_theme'] = 1;
	    $parms['start_time'] = $start_time;
	    $parms['error'] = $this->Lang('error_buildingtemptable');
	    $parms['num_emails'] = $num_emails;
	    $parms['thejob'] = $jobrow['jobid'];
	    $this->Audit($jobrow['jobid'],'NMS - Process Queue',$parms['error']);
	    $this->Redirect( $id, 'process_queue', $returnid, $parms );
	    return;
	  }
	$count++;
	if( $count % 10 == 0 )
	  {
	    // some sort of progress indicator (hopefully)
	    echo "="; 
            if( $count % 50 == 0 ) echo '<br/>';
            flush(); @ob_flush();
	  }
      }

    // mark the job as started
    $q = "UPDATE ".NMS_JOBS_TABLE." SET started = ?, status = ?
              WHERE jobid = ?";
    $dbresult = $db->Execute( $q, array( trim($db->DbTimeStamp(time()),"'"), 
					 1, $jobrow['jobid'] ) );
    // send an event
    $this->SendEvent('OnStartJob',
		     array('jobname' => $jobrow['title'],
			   'jobid' => $jobrow['jobid'] ));

    // redirect back for refresh
    // set the start_record to 0 so that we get past this stuff again
    $params['num_emails'] = $num_emails;
    $params['start_record'] = 0;
    $params['start_time'] = $start_time;
    $params['thejob'] = $jobrow['jobid'];
    $params['thejobname'] = $jobrow['title'];
    $this->Audit($jobrow['jobid'],'NMS - Process Queue','Job Starting');
    $this->Redirect( $id, 'process_queue', $returnid, $params );
    return;
  }


//
// start processing a chunk
//
$num_per_batch = $this->GetPreference('messages_per_batch',50);
if( !isset( $params['start_record'] ) )
  {
    $parms = array();
    $parms['alldone'] = 1;
	  $parms['foo'] = 6;
    $parms['disable_buffer'] = 1;
    $parms['disable_theme'] = 1;
    $parms['start_time'] = $start_time;
    $parms['error'] = $this->Lang('error_otherprocessingerror').' 1';
    $parms['num_emails'] = $num_emails;
    $parms['thejob'] = $jobrow['jobid'];
    $this->Audit($jobrow['jobid'],'NMS - Process Queue',$parms['error']);
    $this->Redirect( $id, 'process_queue', $returnid, $params );
  }
$start_record = $params['start_record'];
    	
//get list were sending this round.
$q = "SELECT * FROM ".NMS_TEMP_TABLE." ORDER BY messageid LIMIT $start_record,$num_per_batch";
$dbresult = $db->Execute($q);

$message = array();
if ($dbresult && ($dbresult->RecordCount() > 0)){
      
  //start sending this round
  echo '<p>'.$this->Lang('send_next_batch',$num_per_batch, $start_record)."</p>"; flush(); @ob_flush();

  $end_record = $start_record + $dbresult->RecordCount();
  echo '<p>'.$this->Lang('processing_job').': <strong>'.$params['thejobname'].'</strong></p>';
  echo '<p>'.$this->Lang('processing_records',$start_record,$end_record).'</p>';
  flush(); @ob_flush();

  $num_sent = 0;      
  while ($row = $dbresult->FetchRow()) 
    {   		
      // and get the message stuff
      // note, we try to cache the messages
      if( count( $message ) == 0 )
	{
	  $q = "SELECT * FROM ".NMS_MESSAGES_TABLE." WHERE messageid = ?";
	  $dbresult2 = $db->Execute( $q, array( $row['messageid'] ) );
	  if( !$dbresult2 || $dbresult->RecordCount() == 0 )
	    {
	      $parms = array();
	      $parms['alldone'] = 1;
	  $parms['foo'] = 7;
	      $parms['disable_buffer'] = 1;
	      $parms['disable_theme'] = 1;
	      $parms['start_time'] = $start_time;
	      $parms['error'] = $this->Lang('error_couldnotfindmessage').' 2';
	      $parms['num_emails'] = $num_emails;
	      $parms['thejob'] = $jobrow['jobid'];
	      $this->Audit($jobrow['jobid'],'NMS - Process Queue',$parms['error']);
	      $this->Redirect( $id, 'process_queue', $returnid, $params );
	      return;
	    }
	  $message = $dbresult2->FetchRow();
	}

      $this->_ProcessOneEmail($id,$message,$row,$params['thejob']);

      flush();
      @ob_flush();

      //give the server a little break...
      usleep($this->GetPreference('ms_between_message_sleep',500)); 

      // something resembling progress
      $num_sent++;
      $num_emails++;
      echo "="; 
      if( $num_sent % 50 == 0 ) echo '<br/>';
      flush(); @ob_flush();
    } // while (processing a chunk)

  // have a little sleep before we keep going
  sleep($this->GetPreference('between_batch_sleep',30));
  
  // redirect back, with the start number
  // so that we can keep going if we need to
  $params['num_emails'] = $num_emails;
  $params['start_record'] = $end_record;
  $params['start_time'] = $start_time;
  $this->Redirect( $id, 'process_queue', $returnid, $params );
  return;
 }

//
// if we got here, there are no further records to process
// in this job.
//

// delete the temporary table
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_TEMP_TABLE );
$dict->ExecuteSQLArray($sqlarray);				

// mark the job as complete
$q = "UPDATE ".NMS_JOBS_TABLE." SET finished = ".
  $db->DbTimeStamp(time()).", status = ? WHERE jobid = ?";
$dbresult = $db->Execute( $q, array( 3, $params['thejob'] ) );

// send an event
$this->SendEvent('OnFinishJob',array('jobid'=>$params['thejob']));

// send a notification message
// todo, some other preference I don't want a copy of every
// email, just wanna be notified at the end when its done maybe
if ($this->GetPreference("send_admin_copies") == "true"){
  $totaltime = time() - $start_time;
  $mailer = $this->GetModuleInstance('CMSMailer');
  $mailer->reset();
  $mailer->IsHTML(true);
  $mailer->SetSubject($this->Lang('nms_job_complete_subject'));
  $mailer->SetBody($this->Lang('nms_job_complete_msg',$totaltime));
  $mailer->AddAddress($this->GetPreference('admin_email'));
  $mailer->SetCharSet($this->GetPreference('message_charset'));
  $mailer->SetFromName($this->GetPreference('admin_name'));
  $mailer->SetFrom($this->GetPreference('admin_email'));
  $mailer->AddCustomHeader("X-Mailer: CMS Made Simple ".CMS_VERSION.' ('.$this->GetName()." ".$this->GetVersion().')');

  $replyto = $this->GetPreference('admin_replyto');
  if( !empty($replyto) )
    {
      $mailer->AddReplyTo($replyto);
    }
  $mailer->Send();
  ++$num_emails;
 }

// and redirect back, with no start number
// parameter so we can start the next job
$params['num_emails'] = $num_emails;
$params['start_time'] = $start_time;
unset( $params['start_record'] );
unset( $params['thejob'] );
$this->Redirect( $id, 'process_queue', $returnid, $params );
return;


?>
