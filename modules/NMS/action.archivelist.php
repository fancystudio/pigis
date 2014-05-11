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

// display list of archived newsletters
$db = &$this->GetDb();
$limit = '';

if(isset($params['limit'])) 
  {
    $limit = ' LIMIT 0,'.intval($params['limit']);
  }

// specify the field to sort by
$sortby = (isset($params['sortby'])) ? $params['sortby'] : 'entered';
$orderby = ' entered ';
switch (strtolower($sortby)) {
 case 'msgid':
 case 'id':
   $orderby = ' messageid ';
   break;
 case 'subject':
   $orderby = ' subject ';
   break;
 case 'date':
 case 'entered':
 default:
   $orderby = ' entered ';
   break;
 }
				
// specify the sort order for archived messages
$sortorder = 'DESC';
if(isset($params['sortorder']) && (strtolower($params['sortorder'])=='asc')) $sortorder = 'ASC';

// build the query
// but only pull out public messages ??
$archiveQ = 'SELECT messageid, subject, entered FROM '.NMS_MESSAGES_TABLE.'
              WHERE archivable = 1
              ORDER BY '.$orderby.$sortorder.' '.$limit;

$archiveQRes = $db->Execute($archiveQ);
if( !$archiveQRes ) die( $db->sql );
$archived_messages = array();
while ($archiveQRow = $archiveQRes->FetchRow()) 
  {
    $archiveParams['msgID'] = $archiveQRow['messageid'];
    
    // array to hold this message
    $archived_messages[] = array(
				 'msgID'   => $archiveQRow['messageid'],
				 'subject' => $archiveQRow['subject'],
				 'fullurl' => $this->_CreatePrettyLink($id, $returnid, 'showmessage', 
								$archiveQRow['subject'], $archiveParams),
				 'href' => $this->_CreatePrettyLink($id, $returnid, 'showmessage', 
							     $archiveQRow['subject'], $archiveParams, false, true),
				 'date' => $db->UnixTimeStamp($archiveQRow['entered']));
  } // end while

$smarty->assign('archive_heading',$this->Lang('archive_heading'));
$smarty->assign('archive_tbl_msgID',$this->Lang('archive_tbl_msgID'));
$smarty->assign('archive_tbl_subject',$this->Lang('archive_tbl_subject'));
$smarty->assign('archive_tbl_fullurl',$this->Lang('archive_tbl_fullurl'));
$smarty->assign('archive_tbl_href',$this->Lang('archive_tbl_href'));
$smarty->assign('archive_tbl_date',$this->Lang('archive_tbl_date'));
$smarty->assign('archived_messages',$archived_messages);

$template = $this->GetPreference('curdeflt_archivelist');
if( isset($params['archivelist_template']) )
  {
    $template = trim($params['archivelist_template']);
  }
echo $this->ProcessTemplateFromDatabase('archivelist_'.$template);

#
# EOF
#
?>