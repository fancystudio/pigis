<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGSimpleSmarty (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple that provides simple smarty
#  methods and functions to ease developing CMS Made simple powered
#  websites.
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

final class cgsimple
{
  ///////////
  // A function to output the current page url
  //////////
  static public function self_url($assign='')
  {
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $p = strpos($_SERVER['SERVER_PROTOCOL'],'/');
    $protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,$p)).$s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    $s = $protocol."://".$_SERVER['SERVER_NAME'].$port;

    $txt = $s.$_SERVER['REQUEST_URI'];
    if( !empty($assign) ) {
      $gCms = cmsms();
      $smarty = $gCms->GetSmarty();
      $smarty->assign($assign,$txt);
      return;
    }
    return $txt;
  }


  //////////
  // A function to test if a CMS Made Simple module is installed
  //////////
  static public function module_installed($module,$assign = '')
  {
    if( $module == '' ) return 0;
    $module = cms_utils::get_module($module);

    $result = 0;
    if( is_object( $module ) ) $result = 1;
    if( !empty($assign) ) {
      $smarty = cms_utils::get_smarty();
      $smarty->assign($assign,$result);
      return;
    }
    return $result;
  }

  /////////
  // A function to return the parent page alias of a given page or
  // of the current page
  /////////
  static public function get_parent_alias($alias = '',$assign = '')
  {
    $gCms = cmsms();
    $hm = $gCms->GetHierarchyManager();
    $smarty = $gCms->GetSmarty();

    if( $alias == '' ) $alias = $smarty->get_template_vars('page_alias');

    $node = $hm->find_by_tag('alias',$alias);
    if( !$node ) return;

    $alias = $node->getParent()->get_tag('alias');
    if( $assign != '' ) {
      $smarty->assign($assign,$alias);
      return;
    }
    return $alias;
  }

  
  /////////
  // A function to return the topmost parent page alias of a given page or
  // of the current page
  /////////
  static public function get_root_alias($alias = '',$assign = '')
  {
    $gCms = cmsms();
    $hm = $gCms->GetHierarchyManager();
    $smarty = $gCms->GetSmarty();

    if( $alias == '' ) $alias = $smarty->get_template_vars('page_alias');

    $stack = array();
    $node = $hm->find_by_tag('alias',$alias);
    while( $node && $node->get_tag('id') > 0 ) {
      $stack[] = $node;
      $node = $node->getParent();
    }
    if( count($stack) == 0 ) return;

    $alias = $stack[count($stack)-1]->get_tag('alias');
    if( $assign != '' ) {
      $smarty->assign($assign,$alias);
      return;
    }
    return $alias;
  }


  /////////
  // A function to return the page title of a given page or
  // of the current page
  /////////
  static public function get_page_title($alias = '',$assign = '')
  {
    $gCms = cmsms();
    $contentops = $gCms->GetContentOperations();
    $smarty = $gCms->GetSmarty();

    if( $alias == '' ) $alias = $smarty->get_template_vars('page_alias');
    $content = $contentops->LoadContentFromAlias($alias);
    if( !is_object($content) ) return '';

    if( $assign != '' ) {
      $smarty->assign($assign,$content->Name());
      return;
    }
    return $content->Name();
  }

  
  /////////
  // A function to return the menutext of a given page or
  // of the current page
  /////////
  static public function get_page_menutext($alias = '',$assign = '')
  {
    $gCms = cmsms();
    $contentops = $gCms->GetContentOperations();
    $smarty = $gCms->GetSmarty();

    if( $alias == '' ) $alias = $smarty->get_template_vars('page_alias');
    $content = $contentops->LoadContentFromAlias($alias);
    if( !is_object($content) ) return '';

    if( $assign != '' ) {
      $smarty->assign($assign,$content->MenuText());
      return;
    }
    return $content->MenuText();
  }


  /////////
  // A function to return the type of a given page
  /////////
  static public function get_page_type($alias = '',$assign = '')
  {
    $gCms = cmsms();
    $contentops = $gCms->GetContentOperations();
    $smarty = $gCms->GetSmarty();

    if( $alias == '' ) $alias = $smarty->get_template_vars('page_alias');
    $content = $contentops->LoadContentFromAlias($alias);
    if( !is_object($content) ) return '';

    if( $assign != '' ) {
      $smarty->assign($assign,$content->Type());
      return;
    }
    return $content->Type();
  }


  /////////
  // A function to test if a given (or the current page) has
  // children.
  /////////
  static public function has_children($alias = '',$assign = '')
  {
    $result = false;
    $gCms = cmsms();
    $contentops = $gCms->GetContentOperations();
    $smarty = $gCms->GetSmarty();

    if( $alias == '' ) $alias = $smarty->get_template_vars('page_alias');
    $content = $contentops->LoadContentFromAlias($alias);
    if( is_object($content) ) $result = $content->HasChildren();

    if( $assign != '' ) {
      $smarty->assign($assign,$result);
      return;
    }
    return $result;
  }


  /*---------------------------------------------------------
   Return an array containing the page ids of all of the specified page's
   children.
   ---------------------------------------------------------*/
  static public function get_children($alias = '',$showall = false,$assign = '')
  {
    $gCms = cmsms();
    $db = $gCms->GetDb();
    $smarty = $gCms->GetSmarty();

    if( $alias == '' ) $alias = $smarty->get_template_vars('page_alias');
    if( $alias == '' ) return FALSE;

    $hm = cmsms()->GetHierarchyManager();
    $parent = $hm->find_by_tag('alias',$alias);
    if( !$parent ) return FALSE;

    $child_nodes = $parent->get_children();
    if( !is_array($child_nodes) || count($child_nodes) == 0 ) return false;

    $results = array();
    foreach( $child_nodes as $node ) {
      $content = $node->getContent();
      if( !is_object($content) ) continue;
      if( !$content->Active() && !$showall ) continue;
      $row = array('alias'=>$content->Alias(),'id'=>$content->Id(),'title'=>$content->Name(),'menutext'=>$content->MenuText(),
		   'active'=>$content->Active(),'show_in_menu'=>$content->ShowInMenu(),'type'=>$content->Type());
      $results[] = $row;
    }
    if( !count($results) ) return false;

    if( !empty($assign) ) {
      $smarty->assign($assign,$results);
      return;
    }

    return $results;
  }

  /*---------------------------------------------------------
   Return a module's version
   ---------------------------------------------------------*/
  static public function module_version($name, $assign = '')
  {
    $out = '';
    if( !empty($name) ) {
      $obj = cms_utils::get_module($name);
      if( is_object($obj) ) $out = $obj->GetVersion();
    }

    if( $assign != '' ) {
      $smarty = cms_utils::get_smarty();
      $smarty->assign($assign,$out);
      return;
    }
    return $out;
  }


  //////////
  // Get page content from a content block
  //////////
  static public function get_page_content($alias,$block = '',$assign = '')
  {
    $result = false;
    $gCms = cmsms();
    $contentops = $gCms->GetContentOperations();
    $smarty = $gCms->GetSmarty();

    if( $block == '' ) $block = 'content_en';

    if( $alias != '' ) {
      $content = $contentops->LoadContentFromAlias($alias);
      if( is_object($content) ) $result = $content->GetPropertyValue($block);
    }

    if( $assign != '' ) {
      $smarty->assign(trim($assign),$result);
      return;
    }
    return $result;
  }


  ////////////////////
  // Get prev sibling
  ////////////////////
  static public function get_sibling($dir,$assign = '',$alias = '')
  {
    $gCms = cmsms();
    $db = $gCms->GetDb();
    $smarty = $gCms->GetSmarty();
    $contentops = $gCms->GetContentOperations();

    if( empty($alias) ) $alias = $smarty->get_template_vars('page_alias');
    $content = $contentops->LoadContentFromAlias($alias);
    if( !is_object($content) ) return false;
    
    // get the last item out of the hierarchy
    // and rebuild
    $query = 'SELECT content_alias FROM '.cms_db_prefix().'content
              WHERE parent_id = ? AND item_order %s ? AND active = 1 ORDER BY item_order %s LIMIT 1';

    switch(strtolower($dir)) {
    case '-1':
    case 'prev':
      $thechar = '<';
      $order = 'DESC';
      break;
      
    default:
      $thechar = '>';
      $order = 'ASC';
      break;
    }

    $res = $db->GetOne(sprintf($query,$thechar,$order), array($content->ParentId(),$content->ItemOrder()));
    if( !empty($assign) ) {
      $smarty->assign(trim($assign),$res);
      return;
    }
    return $res;
  }

  //////////
  // Get a file listing for a specified directory
  //////////
  static public function get_file_listing($dir,$excludeprefix='',$assign = '')
  {
    $gCms = cmsms();
    $smarty = $gCms->GetSmarty();
    $config = $gCms->GetConfig();

    $fileprefix = '';
    if( !empty($excludeprefix) ) $fileprefix = $excludeprefix;
    if( startswith($dir,'/') ) return;
    $dir = cms_join_path($config['uploads_path'],$dir);
    $list = get_matching_files($dir,'',true,true,$fileprefix,1);
    if( !empty($assign) ) {
      $smarty->assign(trim($assign),$list);
      return;
    }
    return $list;
  }

  //////////
  // Get a parallel page alias given a different root alias
  // i.e: if the current (or specified page alias) is at hierarchy level 4.1.1
  // and the 'new parent' alias is at hierarchy level 5
  // this function will return the page alias for hierarchy level 5.1.1 (if it exists).
  // useful for multi-lang sites.
  //////////
  static public function get_parallel_page($new_root,$current_page = null,$assign = null)
  {
    $smarty = cmsms()->GetSmarty();
    $contentops = cmsms()->GetContentOperations();

    if( empty($new_root) ) return;
    if( empty($current_page) ) $current_page = $smarty->get_template_vars('page_alias');

    $cur_content = $contentops->LoadContentFromAlias($current_page);
    if( !is_object($cur_content) ) return;

    $tmp = self::get_root_alias($new_root); // make sure we go to the root
    if( $tmp ) $new_root = $tmp;
    $new_root_content = $contentops->LoadContentFromAlias($new_root);
    if( !is_object($new_root_content) ) return;
    
    $hier1 = $cur_content->Hierarchy();
    $hier2 = $new_root_content->Hierarchy();
    if( $hier1 == '' || $hier2 == '' ) return;

    $a_hier1 = explode('.',$hier1);
    $a_hier2 = explode('.',$hier2);
    $a_hier1[0] = $a_hier2[0];  
    $hier3 = implode('.',$a_hier1);

    // we have the new hierarchy... just gotta find the right page for it.
    $new_pageid = $contentops->GetPageIDFromHierarchy($hier3);
    if( !$new_pageid ) return;
    
    $newcontent = $contentops->LoadContentFromAlias($new_pageid);
    if( !is_object($newcontent) ) return; // oops.

    if( $assign ) {
      $smarty->assign($assign,$newcontent->Alias());
      return;
    }
    return $newcontent->Alias();
  }
};

// EOF
?>