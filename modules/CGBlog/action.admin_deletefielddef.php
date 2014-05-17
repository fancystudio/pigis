<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGBlog (c) 2010-2014 by Robert Campbell
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow creation, management of
#  and display of blog articles.
#
#  This module forked from the original CMSMS News Module (c)
#  Ted Kulp, and Robert Campbell.
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# Visit the CMSMS homepage at: http://www.cmsmadesimple.org
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

if (!isset($gCms)) exit;
if (!$this->CheckPermission('Modify Site Preferences')) return;

$fdid = '';
if (isset($params['fdid']))	$fdid = $params['fdid'];

// Get the category details
$query = 'SELECT * FROM '.cms_db_prefix().'module_cgblog_fielddefs WHERE id = ?';
$row = $db->GetRow($query, array($fdid));

//Now remove the category
$query = "DELETE FROM ".cms_db_prefix()."module_cgblog_fielddefs WHERE id = ?";
$db->Execute($query, array($fdid));

//And remove it from any entries
$query = "DELETE FROM ".cms_db_prefix()."module_cgblog_fieldvals WHERE fielddef_id = ?";
$db->Execute($query, array($fdid));

$db->Execute('UPDATE '.cms_db_prefix().'module_cgblog_fielddefs SET item_order = (item_order - 1) WHERE item_order > ?', array($row['item_order']));

$this->SetCurrentTab('customfields');
$this->SetMessage($this->Lang('fielddefdeleted'));
$this->RedirectToTab();

?>