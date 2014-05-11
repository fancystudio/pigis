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

require_once(dirname(__FILE__).'/pop3.class.inc');

class bounce_processor
{
  var $module;
  var $pop3;
  var $server;
  var $username;
  var $password;
  var $error;
  var $delete_flag;
  var $current_msg;
  var $total_messages;
  var $bounce_handler;
  var $required_headers;
  var $header_prefix;

  // 
  // Constructor
  //
  function bounce_processor(&$module)
  {
    $this->module =& $module;
    $this->pop3 = NULL;
    $this->server = NULL;
    $this->username = NULL;
    $this->password = NULL;
    $this->error = '';
    $this->delete_flag = 1;
    $this->current_msg = -1;
    $this->total_messages = -1;
    $this->bounce_handler = NULL;
    $this->required_headers = NULL;
    $this->header_prefix = '';
  }


  function SetServer($server)
  {
    $this->server = $server;
  }


  function SetUsername($username)
  {
    $this->username = $username;
  }


  function SetPassword($password)
  {
    $this->password = $password;
  }


  function GetError()
  {
    return $this->error;
  }


  function SetBounceHandler($bounce_handler)
  {
    $this->bounce_handler = $bounce_handler;
  }


  function Connect()
  {
    if( empty($this->username) || empty($this->server) || empty($this->password) )
      {
	$error = 'error_invalidsettings';
	return false;
      }

    $this->pop3 = new POP3;
    $result = $this->pop3->connect($this->server);
    if( $result == false )
      {
	$error = $this->pop3->error;
	return false;
      }

    $result = $this->pop3->login($this->username,$this->password);
    if( $result == false )
      {
	$error = $this->pop3->error;
	$this->pop3->close();
	return false;
      }

    $result = $this->pop3->get_office_status();
    if( $result == false )
      {
	$error = $this->pop3->error;
	$this->pop3->close();
	return false;
      }
    $this->total_messages = $result['count_mails'];

    return true;
  }


  function GetMessageCount()
  {
    return $this->total_messages;
  }

  function RequireHeader($str)
  {
    if( $this->required_headers == NULL )
      {
	$this->required_headers = array();
      }
    $this->required_headers[$str] = 1;
  }


  function SetHeaderPrefix($str)
  {
    $this->header_prefix = $str;
  }


  function Close()
  {
    if( $this->pop3 != NULL )
      {
	$this->pop3->close();
      }
  }

  // return FALSE if email is not a bounce
  function _test_for_bounce(&$email,&$fields)
  {
    $tmp_fields = array();
    //
    // Search for our important headers
    if( $this->required_headers == NULL )
      {
	// we have nothing to check against
	return FALSE;
      }

    $matches = 0;
    for( $i = 0; $i < count($email); $i++ )
      {
	$line = trim($email[$i]);
	if( empty($line) ) continue;

	foreach( $this->required_headers as $header => $value )
	  {
	    if( preg_match('/^'.$this->header_prefix.$header.'\:/',$line ) )
	      {
		$key = trim(substr($this->header_prefix.$header,6));
		$value = trim(substr($line,strlen($this->header_prefix.$header)+1));
		$matches++;

		$tmp_fields[$key] = $value;
		break;
	      }
	  }

	if( $matches == count($this->required_headers) )
	  {
	    break;
	  }
      }

    if( $matches == count($this->required_headers) )
      {
	$fields = $tmp_fields;
	return TRUE;
      }

    return FALSE;
  }


  function ProcessBounces($batch_size)
  {
    $batch_count = 0;
    if( $this->current_msg < 0 ) $this->current_msg = 1;

    while( $batch_count < $batch_size &&
	   $this->current_msg <= $this->total_messages)
      {
	// Get A Message
	$email = $this->pop3->get_mail($this->current_msg);
	if( $email == false )
	  {
	    return false;
	  }

	// See if it's a failure message
	$fields = array();
	$result = $this->_test_for_bounce($email,$fields);
	if( $result === TRUE && $this->bounce_handler != NULL)
	  {
	    // if so, handle it
	    call_user_func($this->bounce_handler,$fields);
	    
	    // and delete it
	    $this->pop3->delete_mail($this->current_msg);
	  }

	// on to the next message
        $this->current_msg++;
	$batch_count++;
      }

    return true;
  }

} // End of class

#
# EOF
#
?>