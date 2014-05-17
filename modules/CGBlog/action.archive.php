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

#
# Initialization
#
$thetemplate = $this->GetPreference('current_archive_template');
$tmp = $this->GetPreference('default_summarypage',-1);
$summarypage = $returnid;
if( $tmp != -1 ) {
  $summarypage = $tmp;
}
$category = '';

#
# Setup
#
if( isset($params['archivetemplate']) ) {
  $thetemplate = trim($params['archivetemplate']);
  unset($params['archivetemplate']);
}
$thetemplate = 'archive'.$thetemplate;

if( isset($params['summarypage']) ) {
  $tmp = $this->resolve_alias_or_id($params['summarypage']);
  if( $tmp ) $summarypage = $tmp;
  unset($params['summarypage']);
}
if( isset($params['category']) ) {
  $category = explode(',',trim($params['category']));
}

#
# Get the data
#
$query = 'SELECT DISTINCT MONTH(A.start_time) AS month, YEAR(A.start_time) AS year, count(A.cgblog_id) AS count
          FROM '.cms_db_prefix().'module_cgblog A ';
$joins = array();
$where = array();
$qparms = array();
$where[] = 'A.status = ?';
$qparms[] = 'published';

if( is_array($category) && count($category) > 0 ) {
  $joins[] = cms_db_prefix().'module_cgblog_blog_categories B on A.cgblog_id = B.blog_id';
  $joins[] = cms_db_prefix().'module_cgblog_categories C ON B.category_id = C.id';
  $tmp = array();
  foreach( $category as $one ) {
    $tmp[] = $db->qstr(trim($one));
  }
  $where[] = 'C.name IN ('.implode($tmp).')';
}
if( isset($params['year']) ) {
  $where[] = 'YEAR(A.start_time) = ?';
  $qparms[] = (int)$params['year'];
}

# final query assembly
if( count($joins) ) {
  foreach( $joins as $one ) {
    $query .= ' LEFT JOIN '.$one;
  }
}
if( count($where) ) {
  $query .= ' WHERE '.implode(' AND ',$where);
}
$query .= ' GROUP BY YEAR(A.start_time), MONTH(A.start_time)';
$query .= ' ORDER BY A.start_time DESC';
$dbr = $db->Execute($query,$qparms);
if( !$dbr ) {
  echo 'FATAL QUERY:'.$db->sql.'<br/>'.$db->ErrorMsg().'<br/>';
  die();
}

$data = array();
$fmt = '%s/archive/%4d/%02d';
while( $dbr && ($row = $dbr->FetchRow()) ) {
  $parms = $params;
  $parms['year'] = $row['year'];
  $parms['month'] = $row['month'];

  $prettyurl = sprintf($fmt,$this->GetPreference('urlprefix','cgblog'),$row['year'],$row['month']);
  if( $this->GetPreference('default_summarypage','-1') != -1 ) {
    $prettyurl .= "/$summarypage";
  }
  $row['summary_url'] = $this->CreateURL($id,'default',$summarypage,$parms,false,$prettyurl);

  $row['datestamp'] = mktime(0,0,0,$row['month'],1,$row['year']);
  $data[] = $row;
}
$dbr->Close();


#
# Give Everything to Smarty
#
if( count($data) ) {
  $smarty->assign('archivelist',$data);
}

#
# Process The template
#
echo $this->ProcessTemplateFromDataBase($thetemplate);

?>