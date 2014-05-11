<?php
/*
   Smarty postfilter rel2abs 1.0 - released July 28, 2004

   The postfilter rel2abs detects relative URI:s in a template-file
   and uses make_abs (see below) to make them absolute and then replaces them.
   The absolute URI of the template has to be put into the variable
   $GLOBALS['tpl_absuri'](please leave out http://domain)
   (i.e. /templates/something/something.tpl
   and not http://domain/templates/something/something.tpl)
   If anybody figures out a way to not having to input $GLOBALS['tpl_absuri']
   please let me know. Other comments, suggestions and modifications are welcome.

   It was written by Simon Rönnqvist, the most recent version can
   be found at http://ownmedia.net/products/


   make_abs takes a relative URI (i.e. ../../css/stylesheet.css)
   asd and the absolute URI (i.e. /templates/something/something.tpl)
   of the document in which the relative URI was found
   and outputs an absolute one (i.e. /css/stylesheet.css)

   make_abs was written by Andreas Friedrich http://www.x-author.de/
   and found at http://www.webmasterworld.com/forum88/334.htm
*/
/* 
 ------------------
 HELPER FUNCTIONS 
 ------------------ */
function create_page_dropdown(&$module,$id,$name,$current='',$templateid='',$addtext='',$markdefault =true)
{
  // we get here (hopefully) when the template is changed
  // in the dropdown.
  $db = $module->GetDb();
  $gCms = cmsms();
  $defaultid = '';
  if( $markdefault )
    {
      $contentops = $gCms->GetContentOperations();
      $defaultid = $contentops->GetDefaultPageID();
    }
  
  // get a list of the pages used by this template
  $mypages = array();
  $parms = array('content');
  $q = "SELECT content_id,content_name 
                FROM ".cms_db_prefix()."content
               WHERE type = ?
                 AND active = 1";
  
  if( $templateid != '' )
    {
      $q .= ' AND templateid = ?';
      $parms[] = $templateid;
    }
  $dbresult = $db->Execute( $q, $parms );
  while( $row = $dbresult->FetchRow() )
    {
      if( $defaultid != '' && $row['content_id'] == $defaultid )
        {
	  // use a star instead of a word here so I don't have to
	  // worry about translation stuff
	  $mypages[$row['content_name'].' (*)'] = $row['content_id'];
	}
      else
	{
	  $mypages[$row['content_name']] = $row['content_id'];
	}
    }

  return $module->CreateInputDropdown($id,$name,$mypages,-1,$current,$addtext);
}



function _make_abs($rel_uri, $base, $REMOVE_LEADING_DOTS = true) 
{ 
  preg_match("'^([^:]+://[^/]+)/'", $base, $m); 
  $base_start = $m[1]; 
  if (preg_match("'^/'", $rel_uri)) { 
    return $base_start . $rel_uri; 
  } 
  $base = preg_replace("{[^/]+$}", '', $base); 
  $base .= $rel_uri; 
  $base = preg_replace("{^[^:]+://[^/]+}", '', $base); 
  $base_array = explode('/', $base); 
  if (count($base_array) and!strlen($base_array[0])) 
    array_shift($base_array); 
  $i = 1; 
  while ($i < count($base_array)) { 
    if ($base_array[$i - 1] == ".") { 
      array_splice($base_array, $i - 1, 1); 
      if ($i > 1) $i--; 
    } elseif ($base_array[$i] == ".." and $base_array[$i - 1]!= "..") { 
      array_splice($base_array, $i - 1, 2); 
      if ($i > 1) { 
	$i--; 
	if ($i == count($base_array)) array_push($base_array, ""); 
      } 
    } else { 
      $i++; 
    } 
  } 
  /* How do we treat the case where there are still some leading ../
   segments left? According to RFC2396 we are free to handle that
   any way we want. The default is to remove them.
   #
   "If the resulting buffer string still begins with one or more
   complete path segments of "..", then the reference is considered
   to be in error. Implementations may handle this error by
   retaining these components in the resolved path (i.e., treating
   them as part of the final URI), by removing them from the
   resolved path (i.e., discarding relative levels above the root),
   or by avoiding traversal of the reference."
   #
   http://www.faqs.org/rfcs/rfc2396.html  5.2.6.g
  */ 
  if ($REMOVE_LEADING_DOTS) { 
    while (count($base_array) and preg_match("/^\.\.?$/", $base_array[0])) { 
      array_shift($base_array); 
    } 
  } 
  $result = $base_start . '/' . implode("/", $base_array); 
  return $result;
}


function make_absolute_links($src,$base_url)
{
  // Extracts strings containing href or src="something"
  // that "something" can't begin with / or contain a :
  // because that would indicate that its already a relative URI

  // adjust the base url to have a trailing slash if it doesn't already
  if( !endswith($base_url,'/') ) $base_url .= '/';

  $count = 0;
  while (($count < 100) && 
	 preg_match("/(href|src|action)=\"(([^\/^\#])[[:alnum:]\/\+\=\%\&_\.\~\?\-]*)\"/", $src, $regs)) 
    {
      $count++;
      $input_uri = $regs[2];

      //Inputs the extracted string into the function make_abs
      $output_uri = _make_abs($input_uri, $base_url);

      $input_uri = str_replace('?','\?',$input_uri);
      $input_uri = str_replace('/','\/',$input_uri);
      //Replaces the relative URI with the absolute one
      $src = preg_replace("/(href|src|action)=\"$input_uri\"/", 
			  "$1=\"$output_uri\"", 
			  $src);

      //Repeats over again until no relative URI:s are detected
    }

 return($src);

}


function check_email_mx($email,$check_mx = 0) 
{ 
  if( ((preg_match('/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/', $email)) || 
       (preg_match('/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/',$email))) && strlen($email) > 5 ) { 

    if( $check_mx == 0 )
      {
	return true;
      }

    $host = explode('@', $email);
    if(checkdnsrr($host[1].'.', 'MX') ) return true;
    if(checkdnsrr($host[1].'.', 'A') ) return true;
    if(checkdnsrr($host[1].'.', 'CNAME') ) return true;			
  }
  return false;
}

?>
