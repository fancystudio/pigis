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

define('NMS_USERS_TABLE',cms_db_prefix().'module_nms_users');
define('NMS_MESSAGES_TABLE',cms_db_prefix().'module_nms_messages');
define('NMS_MESSAGE_CONTENT_TABLE',cms_db_prefix().'module_nms_message_content');
define('NMS_MSG_TEMPLATES_TABLE',cms_db_prefix().'module_nms_msg_templates');
define('NMS_LIST_TABLE',cms_db_prefix().'module_nms_list');
define('NMS_LISTUSER_TABLE',cms_db_prefix().'module_nms_listuser');
define('NMS_USER_DATA_TABLE',cms_db_prefix().'module_nms_user_data');
define('NMS_JOBS_TABLE',cms_db_prefix().'module_nms_jobs');
define('NMS_JOB_PARTS_TABLE',cms_db_prefix().'module_nms_job_parts');
define('NMS_SEQ_TABLE',cms_db_prefix().'module_nms_seq');
define('NMS_TEMP_TABLE',cms_db_prefix().'module_nms_temp_jobstatus');


#
# EOF
#
?>