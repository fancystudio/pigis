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

$db = $this->GetDb();
global $themeObject;

$result= array ();
$page= isset ($params['page']) ? $params['page'] : 1;
$total_recs = 0;
$query= "SELECT * FROM ".NMS_LIST_TABLE;
$dbresult= $db->Execute($query);
if (($dbresult == false) || ($dbresult->RecordCount() == 0))
  {
    $smarty->assign('message', $this->Lang('error_nolists'));
    $smarty->assign('error', 1);
    $smarty->assign('noform', 1);
    echo $this->ProcessTemplate('users.tpl');
    return;
  }
$lists= array ();
$lists[$this->Lang('any')] = -1;
while ($row= $dbresult->FetchRow())
  {
    $lists[$row['name'] . ' - ' . $row['description']]= $row['listid'];
  }
if (isset ($params['filter'])) // the button
  {
    if (isset ($params['filter_user_regex']))
      {
	$this->SetPreference('nms_user_filter', $params['filter_user_regex']);
      } else
      {
	$this->RemovePreference('nms_user_filter');
      }
      if (isset ($params['filter_username_regex']))
      {
	$this->SetPreference('nms_username_filter', $params['filter_username_regex']);
      } else
      {
	$this->RemovePreference('nms_username_filter');
      }
    if (isset ($params['filter_lists']))
      {
	$this->SetPreference('nms_list_filter', implode(",", $params['filter_lists']));
      } else
      {
	$this->RemovePreference('nms_list_filter');
      }
    if (isset ($params['users_per_page']))
      {
	$this->SetPreference('nms_users_per_page', min((int)$params['users_per_page'],10000));
      } 
    if( isset($params['filter_errorusers']) )
      {
	$this->SetPreference('nms_filter_errorusers',(int)$params['filter_errorusers']);
      }
  }
$nms_user_filter= $this->GetPreference('nms_user_filter', '');
$nms_username_filter= $this->GetPreference('nms_username_filter', '');
$nms_list_filter= $this->GetPreference('nms_list_filter', '');
$num_per_batch= max(1,$this->GetPreference('nms_users_per_page', 25));
$filter_errorusers = $this->GetPreference('nms_filter_errorusers',0);
$is_filtered = false;
if( $nms_user_filter || $nms_username_filter || $nms_list_filter || $filter_errorusers ) $is_filtered = true;

$smarty->assign('startform', 
		$this->CreateFormStart($id, 'defaultadmin', '', 'post', '', 
				       false, '', 
				       array('cg_activetab' => 'users')));
$smarty->assign('endform', $this->CreateFormEnd());
$smarty->assign('prompt_userfilter', $this->Lang('prompt_userfilter'));
$smarty->assign('userfilter', $this->CreateInputText($id, 'filter_user_regex', $nms_user_filter, 30, 30));
$smarty->assign('prompt_usernamefilter', $this->Lang('prompt_usernamefilter'));
$smarty->assign('usernamefilter', $this->CreateInputText($id, 'filter_username_regex', $nms_username_filter, 30, 30));
$smarty->assign('prompt_listfilter', $this->Lang('prompt_listfilter'));
$smarty->assign('info_listfilter', $this->Lang('info_listfilter'));
$smarty->assign('filter_errorusers',$filter_errorusers);
$smarty->assign('is_filtered',$is_filtered);
$smarty->assign('listfilter', $this->CreateInputSelectList($id, 'filter_lists[]', $lists, explode(",", $nms_list_filter),min(10, count($lists))));

$smarty->assign('prompt_users_per_page', $this->Lang('prompt_users_per_page'));
$smarty->assign('users_per_page', $this->CreateInputText($id, 'users_per_page', $this->GetPreference('users_per_page', 25), 3, 3));
$smarty->assign('filter', $this->CreateInputSubmit($id, 'filter', $this->Lang('applyfilter')));
$query= "SELECT A.userid,A.uniqueid,A.email,A.username,A.disabled,A.error_count,A.confirmed,count(B.listid) as lists FROM ".NMS_USERS_TABLE." A ";;
$cquery = 'SELECT count(A.userid) FROM '.NMS_USERS_TABLE." A ";
$joins = array();
$cjoins = array();
$where = array();
$joins[] = "LEFT OUTER JOIN ".NMS_LISTUSER_TABLE." B ON A.userid = B.userid";
if ($nms_user_filter != '')
  {
    $where[] = "A.email REGEXP \"$nms_user_filter\""; 
  }
if ($nms_username_filter != '')
  {
    $where[] = "A.username REGEXP \"$nms_username_filter\"";
  }
if( $filter_errorusers )
  {
    $where[] = 'A.error_count > 0';
  }
if ($nms_list_filter != '')
  {
    $tmp = explode(',',$nms_list_filter);
    if( !in_array(-1,$tmp) )
      {
        $cjoins[] = "LEFT OUTER JOIN ".NMS_LISTUSER_TABLE." B ON A.userid = B.userid";
	$where[] = " B.listid IN ($nms_list_filter)";
      }
  }
if( count($joins) )
{
  $query .= ' '.implode(' ',$joins);
}
if( count($cjoins) )
{
  $cquery .= ' '.implode(' ',$cjoins);
}
if( count($where) )
{
  $query .= ' WHERE '.implode(' AND ',$where);
  $cquery .= ' WHERE '.implode(' AND ',$where);
}
$query .= " GROUP BY A.userid ORDER BY A.email";
$total_recs = $db->GetOne($cquery);
$start_record= ($page -1) * $num_per_batch;
$dbresult= $db->SelectLimit($query,$num_per_batch,$start_record);
$currow= "row1";

if ($total_recs > $num_per_batch)
  {
    $numpages= (int)($total_recs / $num_per_batch);
    if ($total_recs % $num_per_batch)
      {
	$numpages++;
      }
    if ($page > 1)
      {
	$smarty->assign('prevpage', $this->CreateLink($id, 'defaultadmin', $returnid, '<', array (
												  'page' => $page -1,
												  'cg_activetab' => 'users'
												  )));
	$smarty->assign('firstpage', $this->CreateLink($id, 'defaultadmin', $returnid, '<<', array (
												    'page' => 1,
												    'cg_activetab' => 'users'
												    )));
      } else
      {
	$smarty->assign('prevpage', '<');
	$smarty->assign('firstpage', '<<');
      }
    if ($page < $numpages)
      {
	$smarty->assign('nextpage', $this->CreateLink($id, 'defaultadmin', $returnid, '>', array (
												  'page' => $page +1,
												  'cg_activetab' => 'users'
												  )));
	$smarty->assign('lastpage', $this->CreateLink($id, 'defaultadmin', $returnid, '>>', array (
												   'page' => $numpages,
												   'cg_activetab' => 'users'
												   )));
      } else
      {
	$smarty->assign('nextpage', '>');
	$smarty->assign('lastpage', '>>');
      }
    $smarty->assign('pagetext', $this->Lang('page'));
    $smarty->assign('pagecount', $numpages);
    $smarty->assign('curpage', $page);
  }
$smarty->assign('usertext', $this->Lang('userid'));
$smarty->assign('nametext', $this->Lang('name'));
$smarty->assign('emailtext', $this->Lang('emailaddress'));
$smarty->assign('confirmedtext', $this->Lang('confirmed'));
$smarty->assign('disabledtext', $this->Lang('disabled'));
$smarty->assign('liststext', $this->Lang('lists'));
$rowclass= 'row1';
$rowarray= array ();
if ($dbresult && $dbresult->RecordCount() > 0)
  {
    while ($row= $dbresult->FetchRow())
      {
	$onerow= new StdClass();
	$onerow->user= $row['userid'];
	$onerow->disabled= ($row['disabled'] == 1) ? $this->Lang('yes') : $this->Lang('no');
	$onerow->confirmed= ($row['confirmed'] == 1) ? $this->Lang('yes') : $this->Lang('no');
	$onerow->email= $this->CreateLink($id, 'edit_user', $returnid, $row['email'], $row);
	$onerow->name= $row['username'];
	$onerow->errors = $row['error_count'];
	$onerow->lists= $row['lists'];
	$onerow->editlink= $this->CreateLink($id, 'edit_user', $returnid, $themeObject->DisplayImage('icons/system/edit.gif', $this->Lang('edit'), '', '', 'systemicon'), $row);
	$onerow->deletelink= $this->CreateLink($id, 'delete_email', $returnid, $themeObject->DisplayImage('icons/system/delete.gif', $this->Lang('delete'), '', '', 'systemicon'), $row, $this->Lang('delete_user_confirm'));
	$onerow->rowclass= $rowclass;
	($rowclass == "row1" ? $rowclass= "row2" : $rowclass= "row1");
	$rowarray[]= $onerow;
      }
  }
$smarty->assign('oftext', $this->Lang('of'));
$smarty->assign('totalitems', $total_recs);
$smarty->assign('itemsfound', $this->Lang('usersfoundtext'));
$smarty->assign('itemcount', count($rowarray));
$smarty->assign('items', $rowarray);
$link= $this->CreateLink($id, 'create_new_user', $returnid, $themeObject->DisplayImage('icons/system/newobject.gif', $this->Lang('title_user_createnew'), '', '', 'systemicon'), array ()) . ' ';
$link .= $this->CreateLink($id, 'create_new_user', $returnid, $this->Lang('title_user_createnew'), array ());
$smarty->assign('createlink', $link);

$link= $this->CreateLink($id, 'import_users', $returnid, $themeObject->DisplayImage('icons/system/import.gif', $this->Lang('title_users_import'), '', '', 'systemicon'), array ()) . ' ';
$link .= $this->CreateLink($id, 'import_users', $returnid, $this->Lang('title_users_import'), array ());
$smarty->assign('importlink', $link);

$smarty->assign('exportlink', $this->CreateLink($id, 'export_users', $returnid, $this->Lang('title_users_export'), array ()));
$smarty->assign('bounceslink',$this->CreateLink($id, 'manage_bounces', $returnid, $this->Lang('process_bounces')));
	
$feu =& $this->GetModuleInstance('FrontEndUsers');
if( $feu )
  {
    // todo, add an icon here
    $smarty->assign('feuimportlink', 
		    $this->CreateLink($id,'feu_import_users',$returnid,
				      $themeObject->DisplayImage('icons/system/import.gif',
								 $this->Lang('import_feu_title'), '', '', 'systemicon'),
				      array()).' '.
		    $this->CreateLink($id, 
				      'feu_import_users', 
				      $returnid, 
				      $this->Lang('import_feu_title')));
  }

$options = array();
$options['bulk_delete'] = $this->Lang('delete');
$options['bulk_confirm'] = $this->Lang('confirm');
$options['bulk_unconfirm'] = $this->Lang('unconfirm');
$smarty->assign('bulk_actions',$this->CreateInputDropdown($id,'bulk_action',array_flip($options)));
$smarty->assign('formstart2',$this->CreateFormStart($id,'admin_dobulkusers',$returnid));
$smarty->assign('formend2',$this->CreateFormEnd());
echo $this->ProcessTemplate('users.tpl');

#
# EOF
#
?>
