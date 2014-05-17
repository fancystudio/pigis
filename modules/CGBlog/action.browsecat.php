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
$thetemplate = $this->GetPreference('current_browsecat_template');
if( isset($params['browsecattemplate']) ) {
    $thetemplate = trim($params['browsecattemplate']);
    unset($params['browsecattemplate']);
}

$tmp = $this->GetPreference('default_summarypage',-1);
$summarypage = $returnid;
if( $tmp != -1 ) $summarypage = $tmp;
if( isset($params['summarypage']) ) {
    $tmp = $this->resolve_alias_or_id($params['summarypage']);
    if( $tmp ) $summarypage = $tmp;
    unset($params['summarypage']);
}

$where = array();
$qparms = array();
$query = 'SELECT a.*,count(b.blog_id) as count
            FROM '.cms_db_prefix().'module_cgblog_categories a
            LEFT JOIN '.cms_db_prefix().'module_cgblog_blog_categories b
              ON a.id = b.category_id
            LEFT JOIN '.cms_db_prefix().'module_cgblog c
              ON c.cgblog_id = b.blog_id';
$where[] = ' c.status = ?';
$qparms[] = 'published';
if( isset($params['author']) ) {
    // filter by username.
    $feu = cge_utils::get_module('FrontEndUsers');
    if( !$feu ) return false; // no feu modules, therefore no results.

    $user = cms_html_entity_decode(trim($params['author']));
    $users = explode(',',$user);
    for( $i = 0; $i < count($users); $i++ ) {
        $users[$i] = "'".trim($users[$i])."'";
    }
    $tmp = implode(',',$users);

    // make sure we're exluding expired users.
    $query2 = 'SELECT username FROM '.cms_db_prefix().'module_feusers_users
               WHERE username IN ('.$tmp.') AND expires > NOW()';
    $tmp = $db->GetCol($query2);
    if( !is_array($tmp) ) return; // get outa here... no matching users.

    for( $i = 0; $i < count($tmp); $i++ ) {
        $tmp[$i] = "'".trim($tmp[$i])."'";
    }
    $where[] = "c.author IN (".implode(',',$tmp).')';
}

if( !isset($params['showall']) || $params['showall'] = 0 ) {
    // count only articles that either have no end time, or have an end time after now.
    $where[] = 'COALESCE(c.end_time,NOW()) >= NOW()';
}

$query .= ' WHERE '.implode(' AND ',$where) . ' GROUP BY a.id ORDER BY hierarchy';
$items = $db->GetArray($query,$qparms);
if( !is_array( $items ) ) return;

for( $i = 0; $i < count($items); $i++ ) {
    $one =& $items[$i];
    $params['category_id'] = $one['id'];
    $prettyurl = '';
    if( (!isset($params['uglyurls']) || !$params['uglyurls']) && !isset($params['author']) ) {
        if( $this->GetPreference('default_summarypage',-1) == -1 ) {
            $fmt = '%s/category/%d/%d/%s';
            $prettyurl = sprintf($fmt, $this->GetPreference('urlprefix','cgblog'), $one['id'], $summarypage, munge_string_to_url($one['name']));
        }
        else {
            $fmt = '%s/category/%d/%s';
            $prettyurl = sprintf($fmt, $this->GetPreference('urlprefix','cgblog'), $one['id'], munge_string_to_url($one['name']));
        }
    }
    $one['url'] = $this->CreateURL($id,'default',$summarypage,$params,false,$prettyurl);
}


// convert the flat list to nested
if( !function_exists('_cgblog_browsecat_add_to_tree') ) {
    function _cgblog_browsecat_add_to_tree(&$tree,$record,$depth = 0) {
        $record['depth'] = count(explode('.',$record['hierarchy'])) - 1;
        $parent_id = (int)$record['parent_id'];
        if( $parent_id < 1 && $depth == 0 ) {
            $tree[$record['id']] = $record;
            return true;
        }

        foreach( $tree as $id => &$rec ) {
            if( $id == $parent_id ) {
                if( !isset($rec['children']) ) $rec['children'] = array();
                $rec['children'][$record['id']] = $record;
                return true;
            }
            else if( isset($rec['children']) ) {
                $res = _cgblog_browsecat_add_to_tree($rec['children'],$record,$depth+1);
                if( $res ) return true;
            }
        }
    }
}

$tree = array();
foreach( $items as $row ) {
    _cgblog_browsecat_add_to_tree($tree,$row);
}

#Display template
$smarty->assign('categories',$tree);

$thetemplate = 'browsecat'.$thetemplate;
echo $this->ProcessTemplateFromDatabase($thetemplate);

?>