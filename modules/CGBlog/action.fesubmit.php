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
$article = array('cgblog_id'=>'',
		 'cgblog_title'=>'',
		 'cgblog_data'=>'',
		 'cgblog_date'=>time(),
		 'summary'=>'',
		 'start_time'=>time(),
		 'end_time'=>time(),
		 'status'=>$this->GetPreference('fesubmit_status','draft'),
		 'create_date'=>'',
		 'modified_date'=>'',
		 'author'=>'',
		 'cgblog_extra'=>'',
		 'url'=>'');

$error = false;
$useexp = 1;
$category_id = $this->GetPreference('default_category', '');
$fieldvals = array();
$do_send_email = false;
$do_redirect = false;
$fesubmit_usexpiry = $this->GetPreference('fesubmit_usexpiry',0);
$use_expiry = $this->GetPreference('fesubmit_dfltexpiry',1);
$ndays = (int)$this->GetPreference('expiry_interval',180);
if( $ndays <= 0 ) $ndays = 180;
$article['end_time'] = strtotime(sprintf("+%d days",$ndays), time());

// handle the page to go to after cancel or submit.
$dest_page = $returnid;
$tmp = $this->GetPreference('fesubmit_redirect');
if( $tmp != -1 ) $dest_page = $this->resolve_alias_or_id($tmp);
if( isset( $params['cgblog_origpage'] ) ) {
    $tmp = $this->resolve_alias_or_id($params['cgblog_origpage']);
    if( $tmp ) $dest_page = $tmp;
}
if( isset( $params['cgblog_cancel'] ) ) $this->RedirectContent($dest_page);

$article['author'] = 'unknown';
$module = $this->GetModuleInstance('FrontEndUsers');
if( $module ) {
    $tmp = $module->LoggedInName();
    if( $tmp ) $article['author'] = $tmp;
}

if (isset($params['category'])) {
    $tmp = cgblog_ops::get_categories_from_names($params['category']);
    if( $tmp ) $category_id = $tmp;
}

if( isset($params['articleid']) ) {
    $articleid = (int)$params['articleid'];
    $tmp = '';
    if( $article['author'] != 'unknown' ) {
        // load the article.
        $query = 'SELECT * FROM '.cms_db_prefix().'module_cgblog WHERE author = ? AND cgblog_id = ?';
        $tmp = $db->GetRow($query,array($article['author'],$articleid));
        if( $tmp ) {
            $article = $tmp;
            $val = $db->UnixTimeStamp($article['end_time']);
            if( $db->UnixTimeStamp($article['end_time']) != 0 ) {
                $use_expiry = 1;
            }
            else {
                $use_expiry = 0;
            }

            // load the categories.
            $query = 'SELECT category_id FROM '.cms_db_prefix().'module_cgblog_blog_categories WHERE blog_id = ?';
            $category_id = $db->GetCol($query,array($articleid));

            // load the fieldvals.
            $query = 'SELECT fielddef_id,value FROM '.cms_db_prefix().'module_cgblog_fieldvals WHERE cgblog_id = ?';
            $tmp2 = $db->GetArray($query,array($articleid));
            if( $tmp2 ) {
                foreach( $tmp2 as $one ) {
                    $fieldvals[$one['fielddef_id']] = $one['value'];
                }
            }
        }

        if( !$tmp ) {
            $this->Audit($articleid,$this->GetName(),sprintf('Attempt to modify article %d by unauthorized user %s',$articleid,$article['author']));
            return;
        }
    }
}

$fielddefs = cgblog_ops::get_fielddefs(FALSE,TRUE);

if( isset( $params['cgblog_submit'] ) ) {
    if( isset($params['cgblog_src']) ) $do_redirect = true;
    if( isset($params['cgblog_content']) ) $article['cgblog_data'] = cms_html_entity_decode($params['cgblog_content']);
    if( isset($params['cgblog_summary']) ) $article['summary']= cms_html_entity_decode($params['cgblog_summary']);
    if( isset($params['cgblog_status']) && $this->GetPreference('fesubmit_updatestatus') ) {
        $article['status']= trim($params['cgblog_status']);
    }

    if( isset($params['cgblog_extra']) ) $article['cgblog_extra'] = cms_html_entity_decode($params['cgblog_extra']);
    if( isset($params['cgblog_sel_category_id']) ) $category_id = $params['cgblog_sel_category_id'];
    if( isset($params['cgblog_category_id']) ) $category_id = $params['cgblog_category_id'];

    if (isset($params['cgblog_postdate_Month'])) {
        $postdate = mktime($params['cgblog_postdate_Hour'], $params['cgblog_postdate_Minute'], $params['cgblog_postdate_Second'],
                           $params['cgblog_postdate_Month'], $params['cgblog_postdate_Day'], $params['cgblog_postdate_Year']);
        $article['cgblog_date'] = $postdate;
    }

    if( isset($params['cgblog_usexpiry']) && $fesubmit_usexpiry )	$use_expiry = (int)$params['cgblog_usexpiry'];
    if( $fesubmit_usexpiry ) {
        // allowed to change expiry
        if( $use_expiry ) {
            // and we're using expiry.
            if (isset($params['cgblog_startdate_Month'])) {
                $startdate = mktime($params['cgblog_startdate_Hour'], $params['cgblog_startdate_Minute'], $params['cgblog_startdate_Second'],
                                    $params['cgblog_startdate_Month'], $params['cgblog_startdate_Day'], $params['cgblog_startdate_Year']);
                $article['start_time'] = $startdate;
            }

            if (isset($params['cgblog_enddate_Month'])) {
                $enddate = mktime($params['cgblog_enddate_Hour'], $params['cgblog_enddate_Minute'], $params['cgblog_enddate_Second'],
                                  $params['cgblog_enddate_Month'], $params['cgblog_enddate_Day'], $params['cgblog_enddate_Year']);
                $article['end_time'] = $enddate;
            }
        }
        else {
            $article['end_time'] = null;
        }
    }
    if( isset($params['cgblog_title'] ) )	$article['cgblog_title'] = $params['cgblog_title'];
    if( ($article['start_time'] > $article['end_time']) && $use_expiry ) {
        $error = true;
        $smarty->assign('error',$this->Lang('startdatetoolate'));
    }

    if( ($article['cgblog_date'] > $article['end_time']) && $use_expiry ) {
        $error = true;
        $smarty->assign('error',$this->Lang('postdatetoolate'));
    }

    if( $article['cgblog_title'] == '' ) {
        $error = true;
        $smarty->assign('error',$this->Lang('notitlegiven'));
    }

    if( $article['cgblog_data'] == '' ) {
        $error = true;
        $smarty->assign('error',$this->Lang('nocontentgiven'));
    }

    // are we doing an insert, or an update
    $tmp_end_time = $article['end_time'];
    if( $tmp_end_time ) $tmp_end_time = trim($db->DbTimeStamp($tmp_end_time),"'");
    $is_insert = '';
    if( !$error ) {
        $dbr = '';
        if( isset($article['cgblog_id']) && $article['cgblog_id'] > 0 ) {
            $is_insert = 'false';
            // doing an update
            $query = 'UPDATE '.cms_db_prefix().'module_cgblog
                SET cgblog_title = ?, cgblog_data = ?, summary = ?,
                    cgblog_extra = ?, status = ?,
                    cgblog_date = ?, start_time = ?, end_time = ?,
                    modified_date = NOW()
                WHERE author = ? AND cgblog_id = ?';
            $dbr = $db->Execute($query,
                                array($article['cgblog_title'],
                                      $article['cgblog_data'],
                                      $article['summary'],
                                      $article['cgblog_extra'],
                                      $article['status'],
                                      trim($db->DBTimeStamp($article['cgblog_date']), "'"),
                                      trim($db->DBTimeStamp($article['start_time']), "'"),
                                      $tmp_end_time,
                                      $article['author'],
                                      $article['cgblog_id']));
        }
        else {
            // doing an insert
            $is_insert = 'true';

            // generate a new article id
            $articleid = $db->GenID(cms_db_prefix()."module_cgblog_seq");
            $article['cgblog_id'] = $articleid;

            // and generate the insert query
            $query = 'INSERT INTO '.cms_db_prefix().'module_cgblog
                (cgblog_id, cgblog_title, cgblog_data, summary,
                 cgblog_extra, status, cgblog_date, start_time, end_time, create_date,
                 modified_date,author)
                VALUES (?,?,?,?,?,?,?,?,?,NOW(),NOW(),?)';
            $dbr = $db->Execute($query,
                                array($article['cgblog_id'],
                                      $article['cgblog_title'],
                                      $article['cgblog_data'],
                                      $article['summary'],
                                      $article['cgblog_extra'],
                                      $article['status'],
                                      trim($db->DBTimeStamp($article['cgblog_date']), "'"),
                                      trim($db->DBTimeStamp($article['start_time']), "'"),
                                      (is_null($article['end_time']))?NULL:trim($db->DBTimeStamp($article['end_time']), "'"),
                                      $article['author']));
        } // update

        if( !$dbr ) {
            $error = true;
            $smarty->assign('error',$db->ErrorMsg().' :: '.$db->sql);
        }

    } // no error.

    if( $error == false && $is_insert == 'false' ) {
        $query = 'DELETE FROM '.cms_db_prefix().'module_cgblog_fieldvals WHERE cgblog_id = ? AND fielddef_id IN (';
        $query .= implode(',',array_keys($fieldvals)).')';
        $db->Execute($query,array($article['cgblog_id']));;

        $query = 'DELETE FROM '.cms_db_prefix().'module_cgblog_blog_categories WHERE blog_id = ?';
        $db->Execute($query,array($article['cgblog_id']));;
    }

    if( $error == false ) {
        // handle the categories
        $query = 'INSERT INTO '.cms_db_prefix().'module_cgblog_blog_categories (blog_id, category_id) VALUES (?,?)';
        if( isset($category_id) && is_array($category_id) ) {
            foreach( $category_id as $one ) {
                $db->Execute($query,array($articleid,$one));
            }
        }
    }

    if( $error == false && is_array($fielddefs) ) {
        // handle file uploads.
        $tmp_error = '';
        foreach( $fielddefs as $defn ) {
            $attrs = $defn['attrs'];
            switch( $defn['type'] ) {
            case 'file':
                $destname = cgblog_utils::handle_uploaded_file($id,$articleid,$defn['id'],$attrs,$tmp_error,'cgblog_customfield_');
                if( !$destname && $tmp_error != '' ) {
                    $smarty->assign('error',$tmp_error);
                    $error = 1;
                    break;
                }
                else if( $destname != '' ) {
                    $params['cgblog_customfield_'.$defn['id']] = $destname;
                }
                break;

            case 'image':
                $destname = cgblog_utils::handle_uploaded_image($id,$articleid,$defn['id'],$attrs,$tmp_error,'cgblog_customfield_');
                if( !$destname && $tmp_error != '' ) {
                    $smarty->assign('error',$tmp_error);
                    $error = 1;
                    break;
                }
                else if( $destname != '' ) {
                    $params['cgblog_customfield_'.$defn['id']] = $destname;
                }
                break;
            }
        }
    }

    $fieldvals = array();
    if( $error == false ) {
        // handle the custom fields
        $now = $db->DbTimeStamp(time());
        $query = 'INSERT INTO '.cms_db_prefix()."module_cgblog_fieldvals (cgblog_id, fielddef_id, value, create_date, modified_date)
              VALUES (?,?,?,$now,$now)";
        foreach( $params as $key => $value ) {
            if( preg_match('/^cgblog_customfield_/',$key) ) {
                $value = trim($value);
                if( empty($value) ) continue;
                $field_id = (int) substr($key,strlen('cgblog_customfield_'));
                $fieldvals[$field_id] = $value;
                $db->Execute($query,array($articleid,$field_id,$value));
            }
        }
        // should've checked those errors too, but eh, I'm up for the odds.
    }

    if( $error == false ) {
        //Update search index
        // todo: add public field vals here too
        $module = $this->GetModuleInstance('Search');
        if ($module != FALSE) {
            $text = $article['cgblog_data'] . ' ' . $article['summary'] . ' ' .
                $article['cgblog_title'] . ' ' . $article['cgblog_title'];
            if( count($fieldvals) ) {
                foreach( $fieldvals as $fldid => $value ) {
                    if( !isset($fielddefs[$fldid]) ) continue;
                    $text .= ' '.$value;
                }
            }
            $module->AddWords($this->GetName(), $article['cgblog_id'], 'article', $text,
                              $useexp == 1 ? $article['end_time'] : NULL);
        }

        // Send an email
        $do_send_email = true;
        //$do_redirect = true;

        // send an event
        @$this->SendEvent('CGBlogArticleAdded',
                          array('cgblog_id' => $article['cgblog_id'],
                                'category_id' => $category_id,
                                'title' => $article['cgblog_title'],
                                'content' => $article['cgblog_data'],
                                'summary' => $article['summary'],
                                'status' => $article['status'],
                                'start_time' => $article['start_time'],
                                'end_time' => $article['end_time'],
                                'useexp' => $useexp));

        // and we're done
        if( $article['status'] == 'draft' && $this->GetPreference('fesubmit_updatestatus',0) == 0 ) {
            $smarty->assign('message',$this->Lang('articleaddeddraft'));
        }
        else {
            $smarty->assign('message',$this->Lang('articleadded'));
        }
        $smarty->assign('return_link',$this->CreateContentLink($dest_page,$this->Lang('return_to_content')));
    }

    if( $error === false ) {
        if( $is_insert ) {
            audit((int)$article['cgblog_id'],$this->GetName(),$article['author'].' added an article via the frontend');
        }
        else {
            audit((int)$article['cgblog_id'],$this->GetName(),$article['author'].' edited an article via the frontend');
        }
    }
} // submit


// build the category list
$categorylist = cgblog_ops::get_category_list(); // for backwards compat
$category_tree = cgblog_ops::get_category_tree();

// build the form
$txt = $this->CreateFrontEndFormStart($id,$returnid,'fesubmit','post','multipart/form-data');
$smarty->assign('startform',$txt);
$smarty->assign('endform',$this->CreateFormEnd());
$smarty->assign('article',$article);
$smarty->assign('category_id',$category_id);
$smarty->assign('categorylist',$categorylist);
if( count($category_tree) ) $smarty->assign('category_tree',$category_tree);

$hidden = $this->CreateInputHidden($id,'cgblog_sel_category_id',$category_id);
if( $article['cgblog_id'] > 0 ) $hidden .= $this->CreateInputHidden($id,'articleid',$article['cgblog_id']);
if( isset($params['cgblog_src']) ) $hidden .= $this->CreateInputHidden($id,'cgblog_src',$params['cgblog_src']);
$smarty->assign('fesubmit_useexpiry',$fesubmit_usexpiry);
$smarty->assign('hidden',$hidden);
$smarty->assign('titletext', $this->Lang('title')); // deprecated
$smarty->assign('inputtitle', $this->CreateInputText($id, 'cgblog_title', $article['cgblog_title'], 30, 255)); // deprecated
$smarty->assign('extratext',$this->Lang('extra'));
$smarty->assign('inputextra',$this->CreateInputText($id,'cgblog_extra',$article['cgblog_extra'],30,255)); // deprecated
$smarty->assign('inputcontent', $this->CreateTextArea($this->GetPreference('fesubmit_wysiwyg',1), $id, $article['cgblog_data'], 'cgblog_content'));
$smarty->assign('hide_summary_field',$this->GetPreference('hide_summary_field','0')); // deprecated
$smarty->assign('inputsummary', 	$this->CreateTextArea($this->GetPreference('allow_summary_wysiwyg',1) && $this->GetPreference('fesubmit_wysiwyg',1),
                                                          $id, $article['summary'], 'cgblog_summary'));
$smarty->assign('summary_wysiwyg',$this->GetPreference('allow_summary_wysiwyg',1) && $this->GetPreference('fesubmit_wysiwyg',1));
$smarty->assign('postdate', $article['cgblog_date']);
$smarty->assign('postdateprefix', $id.'cgblog_postdate_');
$smarty->assign('inputexp',
                $this->CreateInputCheckbox($id, 'cgblog_useexp', '1', $useexp, 'class="pagecheckbox"'));
$smarty->assign('startdate', $article['start_time']);
$smarty->assign('startdateprefix', $id.'cgblog_startdate_');
$smarty->assign('enddate', $article['end_time']);
$smarty->assign('enddateprefix', $id.'cgblog_enddate_');
if( $this->GetPreference('fesubmit_updatestatus',0) ) {
    $opts = array($this->Lang('draft')=>'draft',
                  $this->Lang('review')=>'review',
                  $this->Lang('published')=>'published');
    $smarty->assign('status_opts');

    $smarty->assign('prompt_status',$this->Lang('status'));
    $smarty->assign('input_status', $this->CreateInputDropdown($id,'cgblog_status',$opts,-1,$article['status']));
}
$smarty->assign('submit', $this->CreateInputSubmit($id, 'cgblog_submit', $this->Lang('submit'))); // deprecated
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cgblog_cancel', $this->Lang('cancel'))); // deprecated

if( is_array($fielddefs) ) {
    $customfields = array();
    $customfieldsbyname = array();
    foreach( $fielddefs as $row ) {
        $obj = new StdClass();
        $obj->type = $row['type'];
        $obj->attrs = $row['attrs'];
        $obj->name = $row['name'];
        $obj->value = '';
        if( isset($fieldvals[$row['id']]) ) $obj->value = $fieldvals[$row['id']];
        switch($row['type']) {
        case 'file':
        case 'image':
            $obj->field = $obj->value.'<br/>'.
                $this->CreateInputHidden($id,'cgblog_customfield_'.$row['id'],$obj->value).
                $this->CreateFileUploadInput($id,'cgblog_customfield_'.$row['id'],'',50);
            break;
        case 'checkbox':
            $obj->field = $this->CreateInputCheckbox($id,'cgblog_customfield_'.$row['id'],1,$obj->value);
            break;
        case 'textarea':
            $obj->field = $this->CreateTextArea($obj->attrs['textarea_wysiwyg'] && $this->GetPreference('fesubmit_wysiwyg'),$id,$obj->value,'cgblog_customfield_'.$row['id']);
            break;
        case 'textbox':
            $obj->field = $this->CreateInputText($id,'cgblog_customfield_'.$row['id'],$obj->value,$obj->attrs['size'],$obj->attrs['max_length']);
            break;
        }
        $customfields[] = $obj;
        $key = str_replace(' ','_',strtolower($row['name']));
        $customfieldsbyname[$key] = $obj;
    }
    if( count($customfields) ) {
        $smarty->assign('customfields',$customfields);
        $smarty->assign('customfieldsbyname',$customfieldsbyname);
    }
}

$smarty->assign('titletext', $this->Lang('title'));
$smarty->assign('summarytext', $this->Lang('summary')); // deprecated
$smarty->assign('statustext',$this->Lang('status'));
$smarty->assign('ipaddresstext',$this->Lang('ipaddress'));
$smarty->assign('categorytext',$this->Lang('category')); // deprecated
$smarty->assign('contenttext', $this->Lang('content'));
$smarty->assign('postdatetext', $this->Lang('postdate'));
$smarty->assign('useexpirationtext', $this->Lang('useexpiration'));
$smarty->assign('startdatetext', $this->Lang('startdate'));
$smarty->assign('enddatetext', $this->Lang('enddate'));
$smarty->assign('ipaddress',cge_utils::get_real_ip());
$smarty->assign('use_expiry',$use_expiry);


$template = 'fesubmit'.$this->GetPreference('current_fesubmit_template');
if (isset($params['fesubmittemplate'])) $template = 'fesubmit'.$params['fesubmittemplate'];
echo $this->ProcessTemplateFromDatabase($template);

if( $error == false ) {
    $cmsmailer = $this->GetModuleInstance('CMSMailer');
    if( $do_send_email == true && $cmsmailer ) {
        $test_status = $this->GetPreference('fesubmit_email_status','any');
        if( $test_status == 'any' || $test_status == $article['status'] ) {
            // this needs to be done after the form is generated
            // because we use some of the same smarty variables
            $tmp = $this->GetPreference('fesubmit_email_users');
            $users = cge_userops::expand_userlist($tmp);
            if( is_array($users) && count($users) ) {
                if( $article['cgblog_title'] != '' ) $smarty->assign('title',$article['cgblog_title']);
                if( $article['summary'] != '' ) $smarty->assign('summary',$article['summary']);
                if( $article['cgblog_data'] != '' ) $smarty->assign('content',$article['cgblog_data']);
                $smarty->assign('article',$article);
                $smarty->assign('statusfld',$article['status']);

                // expand uid's into email addresses
                $userops = $gCms->GetUserOperations();
                foreach( $users as $uid ) {
                    $user = $userops->LoadUserById($uid);
                    if( is_object($user) && !empty($user->email) ) $cmsmailer->AddAddress( $user->email );
                }
                $cmsmailer->SetSubject( $this->GetPreference('fesubmit_email_subject',$this->Lang('subject_newcgblog')));
                $cmsmailer->IsHTML( $this->GetPreference('fesubmit_email_html',0) );

                $body = $this->ProcessTemplateFromDatabase('email_template');
                $cmsmailer->SetBody( $body );
                $cmsmailer->Send();
            }
        }
    }

    if( $do_redirect && $error == false ) $this->RedirectContent($dest_page);
}
// END OF FILE
?>
