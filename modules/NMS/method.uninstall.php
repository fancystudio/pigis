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
$db = &$this->GetDb();
		
// remove the database tables
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_USERS_TABLE );
$dict->ExecuteSQLArray($sqlarray);

$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_MESSAGES_TABLE );
$dict->ExecuteSQLArray($sqlarray);

$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_LIST_TABLE );
$dict->ExecuteSQLArray($sqlarray);

$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_LISTUSER_TABLE );
$dict->ExecuteSQLArray($sqlarray);

$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_USER_DATA_TABLE );
$dict->ExecuteSQLArray($sqlarray);			
		
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_JOBS_TABLE );
$dict->ExecuteSQLArray($sqlarray);				

$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_JOB_PARTS_TABLE );
$dict->ExecuteSQLArray($sqlarray);				

$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_MESSAGE_CONTENT_TABLE );
$dict->ExecuteSQLArray($sqlarray);				

$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_MSG_TEMPLATES_TABLE );
$dict->ExecuteSQLArray($sqlarray);				

$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( NMS_TEMP_TABLE );
$dict->ExecuteSQLArray($sqlarray);				

// remove the sequence
$db->DropSequence( NMS_SEQ_TABLE );

// remove the permissions
$this->RemovePermission('Use NMS');
$this->RemovePermission('Manage NMS Users');
$this->RemovePermission('Manage NMS Lists');
$this->RemovePermission('Manage NMS Jobs');
$this->RemovePermission('Manage NMS Messages');
$this->RemovePermission('NMS Advanced Mode');
$this->RemovePermission('Manage NMS Preferences');
		
// remove the preference
$this->RemovePreference();
$this->DeleteTemplate();

// Events
$this->RemoveEvent( 'OnNewUser' );
$this->RemoveEvent( 'OnEditUser' );
$this->RemoveEvent( 'OnDeleteUser' );
$this->RemoveEvent( 'OnNewList' );
$this->RemoveEvent( 'OnEditList' );
$this->RemoveEvent( 'OnDeleteList' );
$this->RemoveEvent( 'OnCreateMessage' );
$this->RemoveEvent( 'OnEditMessage' );
$this->RemoveEvent( 'OnDeleteMessage' );
$this->RemoveEvent( 'OnCreateJob' );
$this->RemoveEvent( 'OnDeleteJob' );
$this->RemoveEvent( 'OnStartJob' );
$this->RemoveEvent( 'OnFinishJob' );
$this->RemoveEvent( 'OnUnsubscribe' );

// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));
?>