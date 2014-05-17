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

class cgblog_article 
{
  private $_rawdata = array();
  private $_meta = array();
  private $_inparams = array();
  private $_inid = 'm1_';
  private $_ro = FALSE;
  private $_internalok = null;
  private static $_cached_rows = array();

  protected function __construct() {}

  private function _getdata($key)
  {
    $res = null;
    if( isset($this->_rawdata[$key]) ) $res = $this->_rawdata[$key];
    return $res;
  }

  private function &mod()
  {
    return cms_utils::get_module(MOD_CGBLOG);
  }

  private function _get_returnid()
  {
    if( !isset($this->_meta['returnid']) ) {
      $mod = $this->mod();
      $tmp = $mod->GetPreference('default_detailpage',-1);
      if( $tmp < 1 ) {
	$tmp = cms_utils::get_current_pageid();
	if( $tmp < 1 ) $tmp = ContentOperations::get_instance()->GetDefaultContent();
      }
      $this->_meta['returnid'] = $tmp;
    }
    return $this->_meta['returnid'];
  }

  private function _get_canonical()
  {
    if( !isset($this->_meta['canonical']) ) {
      $tmp = $this->url;
      if( $tmp == '' ) {
	$aliased_title = munge_string_to_url($this->title);
	$str = $this->mod()->GetPreference('urlprefix','cgblog');
	if( $this->mod()->GetPreference('default_detailpage',-1) > 0 ) {
	  $tmp = "$str/".$this->id."/{$aliased_title}";
	}
	else {
	  $tmp = "$str/".$this->id.'/'.$this->returnid."/{$aliased_title}";
	}
      }
      $canonical = $this->mod()->create_url($this->_inid,'detail',$this->returnid,$this->params,false,false,$tmp);
      $this->_meta['canonical'] = $canonical;
    }
    return $this->_meta['canonical'];
  }

  private function _get_params()
  {
    $params = $this->_inparams;
    $params['articleid'] = $this->id;
    return $params;
  }

  private function _get_useexp()
  {
    // useexp is defined if startdate and endd date are not null.
    return ( $this->start_time && $this->end_time );
  }

  public function set_readonly($flag = TRUE)
  {
    $this->_ro = $flag;
  }

  public function set_linkdata($id,$params,$returnid = '')
  {
    if( $id ) $this->_inid = $id;
    if( is_array($params) ) $this->_inparams = $params;
    if( $returnid != '' ) $this->_meta['returnid'] = $returnid;
  }

  public function set_field(cgblog_field $field)
  {
    if( $this->_ro ) throw new Exception('Modifying readonly blog article object '.$key);
    if( !isset($this->_rawdata['fieldsbyname']) ) $this->_rawdata['fieldsbyname'] = array();
    $name = $field->name;
    $this->_rawdata['fieldsbyname'][$name] = $field;
  }

  public function unset_field($name)
  {
    if( isset($this->_rawdata['fieldsbyname']) ) {
      if( isset($this->_rawdata['fieldsbyname'][$name]) ) unset($this->_rawdata['fieldsbyname'][$name]);
      if( count($this->_rawdata['fieldsbyname']) == 0 ) unset($this->_rawdata['fieldsbyname']);
    }
  }

  public function __get($key)
  {
    switch( $key ) {
    case 'id':
    case 'author':
    case 'title':
    case 'content':
    case 'summary':
    case 'postdate':
    case 'start_time':
    case 'end_time':
    case 'status':
    case 'extra':
    case 'url':
    case 'categories':
    case 'create_date': // readable, not writable
    case 'modified_date': // readable, not writable
      return $this->_getdata($key);

    case 'file_location': // metadata
      $config = cmsms()->GetConfig();
      return $config['uploads_url'].'/cgblog/id'.$this->id;

    case 'canonical': // metadata
      return $this->_get_canonical();

    case 'fields':
    case 'fieldsbyname':
      if( isset($this->_rawdata['fieldsbyname']) ) return $this->_rawdata['fieldsbyname'];
      break;

    case 'returnid': // metadata
      return $this->_get_returnid();

    case 'params': // metadata
      return $this->_get_params();

    case 'useexp':
      return $this->_get_useexp();

    case 'aliases':
      if( isset($this->_rawdata['fieldsbyname']) && is_array($this->_rawdata['fieldsbyname']) ) {
	$tmp = array();
	foreach( $this->_rawdata['fieldsbyname']  as $fname => &$obj ) {
	  if( !is_object($obj) ) continue;
	  $tmp[] = $obj->alias;
	}
	return $tmp;
      }
      return;
      
    default:
      if( isset($this->_rawdata['fieldsbyname']) && is_array($this->_rawdata['fieldsbyname']) ) {
	if( isset($this->_rawdata['fieldsbyname'][$key]) ) return $this->_rawdata['fieldsbyname'][$key]->value;
	foreach( $this->_rawdata['fieldsbyname']  as $fname => $obj ) {
	  if( !is_object($obj) ) continue;
	  if( $key == $obj->alias || $key == $obj->name ) return $obj->value;
	}
      }
      //throw new Exception('Requesting invalid data from News article object '.$key);
    } // switch
  }

  public function __isset($key)
  {
    switch( $key ) {
    case 'id':
    case 'author':
    case 'title':
    case 'content':
    case 'summary':
    case 'postdate':
    case 'start_time':
    case 'end_time':
    case 'status':
    case 'extra':
    case 'url':
    case 'fieldsbyname':
    case 'categories':
      return isset($this->_rawdata[$key]);
      
    case 'fields': // deprecated
      return isset($this->_rawdata['fieldsbyname']);

    case 'create_date':
    case 'modified_date':
    case 'canonical':
      if( $this->id ) return TRUE;
      break;

    case 'returnid':
    case 'params':
      return true;

    default:
      throw new Exception('Requesting invalid data from News article object '.$key);
    }

    return FALSE;
  }

  public function __set($key,$value)
  {
    if( $this->_ro ) throw new Exception('Modifying readonly blog article object '.$key);

    switch( $key ) {
    case 'id':
    case 'author':
    case 'title':
    case 'content':
    case 'summary':
    case 'extra':
    case 'url':
      $this->_rawdata[$key] = $value;
      break;

    case 'categories':
      if( is_array($value) ) {
	if( count($value) ) {
	  if( isset($value[0]['category_id']) && isset($value[0]['name']) ) $this->_rawdata[$key] = $value;
	}
	else {
	  // handle passing in empty array.
	  if( isset($this->_rawdata[$key]) ) unset($this->_rawdata[$key]);
	}
      }
      break;

    case 'status':
      $value = trim(strtolower($value));
      switch( $value ) {
      case 'published':
      case 'review':
      case 'draft':
	$this->_rawdata[$key] = $value;
      }
      break;

    case 'postdate':
    case 'start_time':
    case 'end_time':
      if( is_int($value) ) {
	$db = cmsms()->GetDb();
	$value = $db->DbTimeStamp($value);
      }
      $this->_rawdata[$key] = $value;
      break;

    case 'create_date':
    case 'modified_date':
      if( !$this->_internalok )	throw new Exception('Modifying invalid data in blog article object '.$key);
      $this->_rawdata[$key] = $value;
      break;

    default:
      throw new Exception('Modifying invalid data in blog article object '.$key);
    }
  }

  public function fill_from_formparams($params,$handle_uploads = FALSE,$handle_deletes = FALSE)
  {
    if( $this->_ro ) throw new Exception('Modifying readonly blog article object '.$key);

    $usexp = 0;
    foreach( $params as $key => $value ) {
      switch( $key ) {
      case 'articleid':
	$this->id = $value;
	break;

      case 'author':	
      case 'title':
      case 'content':
      case 'summary':
      case 'start_time':
      case 'end_time':
      case 'extra':
      case 'url':
	$this->$key = $value;
	break;

      case 'postdate_Month':
	$this->postdate = mktime($params['postdate_Hour'], $params['postdate_Minute'], 0,
				 $params['postdate_Month'], $params['postdate_Day'], $params['postdate_Year']);
	break;

      case 'startdate_Month':
	$this->start_time = mktime($params['startdate_Hour'], $params['startdate_Minute'], 0,
				   $params['startdate_Month'], $params['startdate_Day'], $params['startdate_Year']);
	break;

      case 'enddate_Month':
	$this->end_time = mktime($params['enddate_Hour'], $params['enddate_Minute'], 0,
				 $params['enddate_Month'], $params['enddate_Day'], $params['enddate_Year']);
	break;

      case 'useexp':
	$useexp = $value;
	break;

      case 'status':
	$value = strtolower($value);
	if( $value != 'published' ) $value = 'draft';
	$this->status = $value;
	break;
      }
    }

    $fielddefs = cgblog_ops::get_fielddefs(FALSE);
    if( isset($params['customfield']) && is_array($params['customfield']) ) {
      foreach( $params['customfield'] as $fldid => $value ) {
	$value = trim($value);
	if( $value == '' ) continue;
	if( !isset($fielddefs[$fldid]) ) continue;

	// todo: do data validation
	$field = cgblog_field::from_row($fielddefs[$fldid]);
	$field->value = $value;
	$this->set_field($field);
      }
    }
  }

  public static function &blank()
  {
    $ob = new cgblog_article();
    return $ob;
  }

  protected static function get_fields(cgblog_article& $article,$status) 
  {
    // not handling preload yet.
    if( !$article->id ) return;
    if( $status ) $status = strtolower($status);
    if( $status != 'all' ) $status == 'publlic';

    $db = cmsms()->GetDb();
    $qparms = array($article->id);
    $query = 'SELECT A.value,B.id,B.name,B.type FROM '.cms_db_prefix().'module_cgblog_fieldvals A, '.cms_db_prefix().'module_cgblog_fielddefs B 
              WHERE A.fielddef_id = B.id AND A.cgblog_id = ?';
    if( $status == 'public' ) $query .' AND B.public = 1';
    $query .= ' ORDER BY B.item_order';

    $tmp = $db->GetArray($query,$qparms);
    if( is_array($tmp) && count($tmp) ) {
      foreach( $tmp as $row ) {
	$field = cgblog_field::from_row($row);
	if( is_object($field) ) $article->set_field($field);
      }
    }
  }

  protected static function get_categories(cgblog_article& $article)
  {
    if( !$article->id ) return;
    
    $db = cmsms()->GetDb();
    $query = 'SELECT A.category_id,B.name FROM '.cms_db_prefix().'module_cgblog_blog_categories A
              LEFT JOIN '.cms_db_prefix().'module_cgblog_categories B ON A.category_id = B.id WHERE A.blog_id = ?';
    $tmp = $db->GetArray($query,array($article->id));
    if( is_array($tmp) ) $article->categories = $tmp;
  }

  public static function &get_from_row($row,$get_fields = 'PUBLIC',$get_categories = TRUE) 
  {
    $res = null;
    if( !is_array($row) ) return $res;
    $article = new cgblog_article;
    foreach( $row as $key => $value ) {
      switch( $key ) {
      case 'cgblog_id':
	$article->id = $value;
	break;

      case 'cgblog_title':
	$article->title = $value;
	break;

      case 'cgblog_data':
	$article->content = $value;
	break;

      case 'cgblog_date':
	$article->postdate = $value;
	break;

      case 'status':
      case 'summary':
      case 'start_time':
      case 'end_time':
      case 'author':
      case 'url':
      case 'create_date':
      case 'modified_date':
	$article->_internalok = 1;
	$article->$key = $value;
	$article->_internalok = 0;
	break;

      case 'cgblog_extra':
	$article->extra = $value;
	break;
      }
    }

    if( $get_fields ) self::get_fields($article,$get_fields);
    if( $get_categories ) self::get_categories($article);
    return $article;
  }

  public static function &get_latest($canviewdraft = FALSE,$get_fields = 'PUBLIC',$get_categories = TRUE)
  {
    $db = cmsms()->GetDb();
    $now = $db->DbTimeStamp(time());
    $query = 'SELECT mn.* FROM '.cms_db_prefix().'module_cgblog mn WHERE';
    $qparms = array();
    if( !$canviewdraft ) {
      $query .= ' status = ? AND ';
      $qparms[] = 'published';
    }
    $query .= " (".$db->IfNull('start_time',$db->DBTimeStamp(1))." < $now) AND ";
    $query .= "((".$db->IfNull('end_time',$db->DBTimeStamp(1))." = ".$db->DBTimeStamp(1).") OR (end_time > $now)) ";
    $query .= 'ORDER BY end_time,start_time DESC LIMIT 1';
    $row = $db->GetRow($query,$qparms);

    $res = null;
    if( !is_array($row) ) {
      return $res;
      // todo: throw an exception?
    }

    return self::get_from_row($row,$get_fields,$get_categories);
  }

  public static function &get_by_id($articleid,$canviewdraft = FALSE,$get_fields = 'PUBLIC',$get_categories = TRUE)
  {
    if( !isset(self::$_cached_rows[$articleid]) ) {
      $db = cmsms()->GetDb();
      $query = "SELECT mn.* FROM ".cms_db_prefix()."module_cgblog mn WHERE cgblog_id = ?";
      $tmp = $db->GetRow($query, array($articleid));
      if( is_array($tmp) ) self::$_cached_rows[$articleid] = $tmp;
    }

    $res = null;
    if( !isset(self::$_cached_rows[$articleid]) ) return; // throw an exception?
    $row = self::$_cached_rows[$articleid];
    if( !$canviewdraft && $row['status'] != 'published' ) return $res;
    return self::get_from_row($row,$get_fields,$get_categories);
  }
} // end of class

#
# EOF
#
?>