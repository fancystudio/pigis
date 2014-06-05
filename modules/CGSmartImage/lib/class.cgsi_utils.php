<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGSmartImage (c) 2012 by Robert Campbell (calguy1000@cmsmadesimple.org)
#
#  An addon module for CMS Made Simple to allow creating image tags in a smart
#  way to optimize performance.
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005-2010 by Ted Kulp (wishy@cmsmadesimple.org)
# This projects homepage is: http://www.cmsmadesimple.org
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

final class cgsi_utils
{
    protected function __construct() {}
    static private $_device_data;

    /**
     * Given a fairly loose image type identifier (either an extension, or a mime type that could be somewhat mis-spelled
     * attempt to return a reasonable mime type
     */
    private static function parse_type($str,$dflt = 'image/png')
    {
        $str = strtolower($str);
        while( startswith($str,'.') ) $str = substr($str,1);

        switch( $str ) {
        case 'image/jpeg':
        case 'image/png':
        case 'image/gif':
        case 'image/bmp':
        case 'image/webp':
            return $str;
        case 'image/x-windows-bmp':
        case 'image/x-ms-bmp':
            return 'image/bmp';
        case 'image/jpg':
        case 'jpeg':
        case 'jpg':
            return 'image/jpeg';
        case 'png':
            return 'image/png';
        case 'gif':
            return 'image/gif';
        case 'bmp':
            return 'image/bmp';
        case 'webp':
            return 'image/webp';
        default:
            return $dflt;
        }
    }

    /**
     * Given a mime type for or known image formats, return an extension
     */
    private static function get_extension($mime_type)
    {
        $map = array('image/jpeg'=>'.jpg',
                     'image/png'=>'.png',
                     'impage/bmp'=>'.bmp',
                     'image/gif'=>'.gif');
        if( isset($map[$mime_type]) ) return $map[$mime_type];
    }

    /**
     * Return the options for a particular alias
     */
    private static function _get_alias_options($name)
    {
        static $aliases;
        if( !$aliases ) {
            $mod = cms_utils::get_module('CGSmartImage');
            $tmp = $mod->GetPreference('aliases');
            $aliases = 'FALSE';
            if( $tmp ) $aliases = unserialize($tmp);
        }
        if( is_array($aliases) ) {
            $keys = array_keys($aliases);
            for( $i = 0; $i < count($keys); $i++ ) {
                $key = $keys[$i];
                if( $aliases[$key]['name'] == $name ) return $aliases[$key]['options'];
            }
        }
    }

    private static function _expand_quoted_string($str)
    {
        $result = array();
        $col = '';
        $safe = '';
        $prev_char = '';
        for( $i = 0; $i < strlen($str); $i++ ) {
            switch( $str[$i] ) {
            case ' ':
                if( !$safe ) {
                    if( strpos($col,'=') !== FALSE ) {
                        list($k,$v) = explode('=',$col,2);
                        $result[$k] = $v;
                    }
                    $col = '';
                }
                else {
                    $col .= $str[$i];
                }
                break;

            case "'":
            case '"':
                if( $prev_char != '\\' ) {
                    if( $str[$i] == $safe ) {
                        $safe = null;
                    }
                    else {
                        $safe = $str[$i];
                    }
                }
            break;

            default:
                $col .= $str[$i];
                break;
            }

            $prev_char = $str[$i];
        }

        if( strlen($col) != 0 ) {
            if( strpos($col,'=') !== FALSE ) {
                list($k,$v) = explode('=',$col,2);
                $result[$k] = $v;
            }
        }

        return $result;
    }


    private static function _is_stylesheet()
    {
        $tmp = debug_backtrace();
        foreach( $tmp as $elem ) {
            if( isset($elem['function']) && $elem['function'] == 'smarty_cms_function_cms_stylesheet' ) return TRUE;
        }
        return FALSE;
    }


    public static function color_to_rgb($str)
    {
        $str = trim($str);
        $res = array(0,0,0);

        if( startswith($str,'#') && strlen($str) == 4 ) {
            $r = substr($str,1,1); $r = $r.$r;
            $g = substr($str,2,1); $g = $g.$g;
            $b = substr($str,3,1); $b = $b.$b;
            $res[0] = hexdec($r);
            $res[1] = hexdec($g);
            $res[2] = hexdec($b);
            return $res;
        }

        if( startswith($str,'#') && strlen($str) == 7 ) {
            $res[0] = hexdec(substr($str,1,2));
            $res[1] = hexdec(substr($str,3,2));
            $res[2] = hexdec(substr($str,5,2));
            return $res;
        }

        $tmp = explode(':',$str,3);
        if( is_array($tmp) && count($tmp) == 3 && is_numeric($tmp[0]) && is_numeric($tmp[1]) && is_numeric($tmp[1]) ) {
            $res[0] = (int)$tmp[0];
            $res[1] = (int)$tmp[1];
            $res[2] = (int)$tmp[2];
            return $res;
        }

        // assume it's a color name.
        static $_colors;
        if( !is_array($_colors) ) {
            $fn = __DIR__.'/colors.dat';
            $data = file($fn);
            if( count($data) ) {
                $_colors = array();
                for( $i = 0; $i < count($data); $i++ ) {
                    list($rgb,$name) = explode('-',$data[$i],2);
                    if( !startswith($rgb,'#') || strlen($rgb) != 7 || $name == '' ) continue;

                    $tmp = array();
                    $tmp[0] = hexdec(substr($rgb,1,2));
                    $tmp[1] = hexdec(substr($rgb,3,2));
                    $tmp[2] = hexdec(substr($rgb,5,2));

                    $_colors[strtolower(trim($name))] = $tmp;
                }
            }
        }
        if( is_array($_colors) && isset($_colors[$str]) ) $res = $_colors[$str];
        return $res;
    }

    public static function &process_image($params)
    {
        $mod = cms_utils::get_module('CGSmartImage');
        $config = cmsms()->GetConfig();
        $want_transform = 0;
        $do_transform = 0;
        $have_transform = 0;
        $dest_fname = '';
        $dest_url = '';
        $img = '';
        $srcfile = '';
        $rel = 0;
        $outp = array();  // output params
        $outp['id'] = '';
        $outp['name'] = '';
        $outp['class'] = '';
        $outp['style'] = '';
        $outp['src'] = '';
        $outp['width'] = '';
        $outp['height'] = '';
        $outp['error'] = '';
        $opp = array();  // operation params
        $opp['overwrite'] = 0;
        $opp['nobcache'] = 0;
        $opp['noremote'] = 0;
        $opp['noembed'] = 0;
        $opp['noauto'] = 0;
        $opp['norotate'] = 0;
        $opp['notimecheck'] = 0;
        $opp['noautoscale'] = 0;
        $opp['notag'] = 0;
        $opp['noresponsive'] = 0;
        $opp['nobreakpoints'] = 0;
        $opp['max_width'] = '';
        $opp['max_height'] = '';
        $opp['src'] = '';
        $opp['quality'] = 75;
        $opp['filters'] = array();
        $opp['force_type'] = '';
        $opp['force_ext'] = $mod->GetPreference('force_extension',0);
        $srcimgsize = ''; // src image size
        $lastfilter = null;

        try {
            $tmp = $mod->GetPreference('aliases');
            if( $tmp ) $aliases = unserialize($tmp);

            // first pass... expand aliases and build src
            $new_params = array();
            foreach( $params as $key => $value ) {
                if( startswith($key,'alias') ) {
                    // expand alias
                    $options = self::_get_alias_options($value);
                    if( $options ) {
                        // parse a string into an array of arguments.
                        $data = self::_expand_quoted_string($options);
                        if( is_array($data) ) {
                            foreach( $data as $key => $value ) {
                                $new_params[$key] = $value;
                            }
                        }
                        continue;
                    }
                }
                elseif( startswith($key,'src') && $key != 'src' ) {
                    // handle src1 through src99 arguments.
                    if( !isset($new_params['src']) ) $new_params['src'] = '';
                    if( !empty($new_params['src']) && !endswith($new_params['src'],'/') ) $new_params['src'] .= '/';
                    $new_params['src'] .= $value;
                    continue;
                }

                // everything else just gets added.
                $new_params[$key] = $value;
            }
            $params = $new_params;

            // second pass, build our arrays
            $parse_params = function($parms, $depth = 0) use( &$parse_params, &$opp, &$outp ) {
                foreach( $parms as $key => $value ) {
                    $matches = array();
                    if( preg_match('/^filter_[0-9]._/',$key,$matches) ) {
                        $key = substr($key,strlen($matches[0]));
                        $filter = ucwords($key);
                        $args = explode(',',$value);
                        $classname = 'CGImage_'.$filter.'_Filter';
                        if( !class_exists($classname) ) throw new Exception($mod->Lang('error_unknownfilter',$filter));

                        // add it to the ops.
                        $opp['filters'][] = array($classname,$args);
                        // done.
                        continue;
                    }

                    if( startswith($key,'filter_') ) {
                        // handle filter argument.
                        $filter = ucwords(substr($key,strlen('filter_')));
                        $args = explode(',',$value);
                        $classname = 'CGImage_'.$filter.'_Filter';
                        if( !class_exists($classname) ) throw new Exception($mod->Lang('error_unknownfilter',$filter));

                        // add it to the ops.
                        $opp['filters'][] = array($classname,$args);
                        // done.
                        continue;
                    }

                    switch( $key ) {
                    case 'data':
                    if( $depth == 0 ) $parse_params($value,$depth+1);
                    break;

                    case 'class':
                    case 'id':
                    case 'style':
                    case 'name':
                    case 'alt':
                    case 'rel':
                    case 'title':
                    $outp[$key] = trim($value);
                    break;

                    case 'width':
                    case 'height':
                    $outp[$key] = (int)$value;
                    break;

                    case 'max_width':
                    case 'max_height':
                    $opp[$key] = (int)$value;
                    break;

                    case 'src':
                    case 'force_type':
                    $opp[$key] = trim($value);
                    break;

                    case 'quality':
                    $opp['quality'] = (int)$value;
                    $opp['quality'] = min(100,max(0,$opp['quality']));
                    break;

                    case 'overwrite':
                    case 'notag':
                    case 'noremote':
                    case 'noresponsive':
                    case 'nobreakpoints':
                    case 'nobcache':
                    case 'noembed':
                    case 'noauto':
                    case 'norotate':
                    case 'notimecheck':
                    case 'force_ext':
                    $opp[$key] = cge_utils::to_bool($value);
                    break;
                    }
                }
            };

            $parse_params($params);

            if( !$opp['src'] ) throw new Exception($mod->Lang('error_missingparam','src'));

            //
            // find the source image ... the actual filename
            // use some automagic intelligence to find it.
            //
            $opp['src'] = urldecode($opp['src']);
            if( !$srcfile && startswith($opp['src'],$config['uploads_url']) ) {
                $tmp = str_replace($config['uploads_url'],$config['uploads_path'],$opp['src']);
                if( file_exists($tmp) ) $srcfile = $tmp;
            }
            if( !$srcfile && startswith($opp['src'],$config['root_url']) ) {
                $tmp = str_replace($config['root_url'],$config['root_path'],$opp['src']);
                if( file_exists($tmp) ) $srcfile = $tmp;
            }
            if( !$srcfile && isset($config['ssl_url']) && startswith($opp['src'],$config['ssl_url']) ) {
                $tmp = str_replace($config['ssl_url'],$config['root_path'],$opp['src']);
                if( file_exists($tmp) ) $srcfile = $tmp;
            }
            if( !$srcfile && startswith($opp['src'],'/') ) {
                $rp1 = realpath($config['root_path']);
                $rp2 = realpath($opp['src']);
                if( startswith($rp2,$rp1) && file_exists($opp['src']) ) $srcfile = $opp['src'];
            }
            if( !$srcfile ) {
                // check relative path wrt the uploads dir.
                $tmp = cms_join_path($config['uploads_path'],$opp['src']);
                $rp1 = realpath($config['uploads_path']);
                $rp2 = realpath($tmp);
                if( startswith($rp2,$rp1) && file_exists($tmp) ) $srcfile = $tmp;
            }
            if( !$srcfile ) {
                // check relative path wrt the root dir.
                $tmp = cms_join_path($config['root_path'],$opp['src']);
                $rp1 = realpath($config['root_path']);
                $rp2 = realpath($tmp);
                if( startswith($rp2,$rp1) && file_exists($tmp) ) $srcfile = $tmp;
            }
            if( !$srcfile && $opp['noremote'] == 0 &&
                (startswith($opp['src'],'http:') || startswith($opp['src'],'https:') || startswith($opp['src'],'ftp:'))) {
                // okay, gotta assume that ths is a remote file
                // get it, and cache it.
                $cachefile = TMP_CACHE_LOCATION.'/cgsi_'.md5($opp['src']).'.img';
                if( !file_exists($cachefile) ) {
                    $data = file_get_contents($opp['src']);
                    if( $data ) {
                        file_put_contents($cachefile,$data);
                        $srcfile = $cachefile;
                    }
                }
                else {
                    $srcfile = $cachefile;
                }
            }

            if( !$srcfile ) {
                throw new Exception($mod->Lang('error_srcnotfound',$opp['src']));
                return $outp;
            }

            // get the source image size
            $srcinfo = getimagesize($srcfile);
            if( !is_array($srcinfo) || count($srcinfo) < 2 ) {
                throw new Exception($mod->Lang('error_srcnotfound',$opp['src']));
            }
            else {
                $srcimgsize = array('width'=>$srcinfo[0],'height'=>$srcinfo[1]);
                $memory_needed = round( $srcinfo[0] * $srcinfo[1]
                                        * (isset($srcinfo['bits'])?$srcinfo['bits']:8)
                                        * (isset($srcinfo['channels'])?$srcinfo['channels']:3) / 8 + 65535 );
                if( $mod->GetPreference('checkmemory',1) && !cge_utils::have_enough_memory($memory_needed) ) {
                    throw new Exception($mod->Lang('error_insufficientmemory').': '.(int)($memory_needed/1024).'k');
                }
            }

            // are we automagically rotating.
            if( !$opp['norotate'] && function_exists('exif_read_data') ) {
                // if there is already a rotate filter in the list, we won't override that.
                $fn = 0;
                for( $f = 0; $f < count($opp['filters']); $f++ ) {
                    if( $opp['filters'][$f][0] == 'CGImage_Rotate_Filter' ) {
                        $fn = 1;
                        break;
                    }
                }

                if( $fn == 0 ) {
                    // we can try to read the exif information to find an orientation.
                    $exif = @exif_read_data($srcfile,0,TRUE);
                    if( is_array($exif) && isset($exif['IFD0']) && isset($exif['IFD0']['Orientation']) &&
                        is_int($exif['IFD0']['Orientation']) ) {

                        // found an orientation, now we gotta figure out what filters to add.
                        $orientation = (int)$exif['IFD0']['Orientation'];
                        $new_filters = array();
                        switch( $orientation ) {
                        case 1:
                            // nothing.
                            break;
                        case 2:
                            // horizontal flip.
                            $new_filters[] = array('CGImage_Flip_Filter',0);
                            break;
                        case 3:
                            // rotate 180
                            $new_filters[] = array('CGImage_Rotate_Filter',array(180));
                            break;
                        case 4:
                            $new_filters[] = array('CGImage_Flip_Filter',1);
                            break;
                        case 5:
                            $new_filters[] = array('CGImage_Flip_Filter',1);
                            $new_filters[] = array('CGImage_Rotate_Filter',array(90));
                            break;
                        case 6:
                            $new_filters[] = array('CGImage_Rotate_Filter',array(90));
                            break;
                        case 7:
                            $new_filters[] = array('CGImage_Flip_Filter',0);
                            $new_filters[] = array('CGImage_Rotate_Filter',array(90));
                            break;
                        case 8:
                            $new_filters[] = array('CGImage_Rotate_Filter',array(-90));
                            break;
                        }

                        $opp['filters'] = array_merge($new_filters,$opp['filters']);
                    }
                }
            }

            // doing responsive images... get device width and height.
            $is_responsive = 0;
            if( $mod->GetPreference('responsive',1) && $opp['noresponsive'] == 0 ) {
                $device = self::get_device_capabilities();
                if( is_array($device) && isset($device['width']) && isset($device['height']) ) {
                    // we found device capabilities.

                    // we have to do auto-scaling now, responsive stuff trumps it.
                    $opp['noautoscale'] = 0;
                    $is_responsive = 1;

                    // merge that data with any max_width and max_height that have already been supplied.
                    $w = max(1,(int)$device['width']);
                    if( $opp['max_width'] > 0 ) {
                        $opp['max_width'] = min($opp['max_width'],$w);
                    }
                    else {
                        $opp['max_width'] = $w;
                    }

                    $h = max(1,(int)$device['height']);
                    if( $opp['max_height'] > 0 ) {
                        $opp['max_height'] = min($opp['max_height'],$h);
                    }
                    else {
                        $opp['max_height'] = $h;
                    }
                }
            }

            // rationalize width/height, max_width, max_height
            $no_width_height = 0;
            if( $opp['max_width'] && $outp['width'] ) {
                $no_width_height = 1;
                $opp['max_width'] = min($opp['max_width'],$outp['width']);
            }
            if( $opp['max_height'] && $outp['height'] ) {
                $no_width_height = 1;
                $opp['max_height'] = min($opp['max_height'],$outp['height']);
            }

            // now do some intelligence, and see if the width, and height arguments passed in
            // match the image size... if not, and max_width/height aren't already smaller... add a filter.
            if( $no_width_height == 0 && ($outp['width'] > 0 || $outp['height'] > 0) && $opp['noautoscale'] == 0 ) {
                if( $outp['width'] != $srcimgsize['width'] || $outp['height'] != $srcimgsize['height'] ) {
                    // we wanna display the file at a different dimenion.
                    $args = '';
                    $filter = '';
                    if( $outp['width'] && $outp['height'] ) {
                        // gonna do a crop to fit
                        $filter = 'CGImage_Croptofit_Filter';
                        $args = array((int)$outp['width'],(int)$outp['height']);
                    }
                    else if( $outp['width'] ) {
                        // gonna do a resize
                        $filter = 'CGImage_Resize_Filter';
                        $args = array('w',(int)$outp['width']);
                    }
                    else if ( $outp['height'] ) {
                        // gonna do a resize
                        $filter = 'CGImage_Resize_Filter';
                        $args = array('h',(int)$outp['height']);
                    }
                    if( is_array($args) && $filter != '' ) {
                        $found = 0;
                        for( $i = 0; $i < count($opp['filters']); $i++ ) {
                            if( $opp['filters'][$i][0] == 'CGImage_Resize_Filter' ) {
                                $found = 1;
                                break;
                            }
                        }
                        // add a filter to the end
                        if( !$found ) $lastfilter = array($filter,$args);
                    }
                }
            }

            // if we are forcing a type and that type is not the same as our current type.
            if( $opp['force_type'] ) {
                $tmp_a = self::parse_type($opp['force_type']);
                if( $tmp_a != $srcinfo['mime'] ) $want_transform = 1;
            }

            // if we have max width and/or height... add a filter at the end
            // to make sure that our output never exceeds those max values.
            if( ($opp['max_width'] > 0 || $opp['max_height'] > 0) && $opp['noautoscale'] == 0 ) {
                // if we have breakpoints, use find the closest one
                $args = '';
                $filter = '';
                $bp = null;

                if( ($tmp = $mod->GetPreference('responsive_breakpoints')) && $is_responsive == 1 &&
                    !$opp['nobreakpoints'] ) {
                    $tmp = explode(',',$tmp);
                    $bp = array();
                    for( $i = 0; $i < count($tmp); $i++ ) {
                        $t1 = (int)trim($tmp[$i]);
                        if( $t1 > 0 ) $bp[] = $t1;
                    }
                    asort($bp);
                }

                if( is_array($bp) && count($bp) ) {
                    // we have valid breakpoints.
                    $lval = max($opp['max_width'],$opp['max_height']);
                    for( $i = count($bp)-1; $i > 0; $i-- ) {
                        if( $bp[$i] > $lval ) continue;
                        break;
                    }

                    // resize to maximum dimension of lval
                    // note, it'd be nice to have some kind of settings here
                    // i.e: which filer (and other params) to use.
                    $lval = $bp[$i];
                    $filter = 'CGImage_Resize_Filter';
                    $args = array('e',$lval,0);
                }
                else {
                    // standard handling of max width/max height.
                    if( $opp['max_width'] && $opp['max_height'] ) {
                        $filter = 'CGImage_Croptofit_Filter';
                        $args = array((int)$opp['max_width'],(int)$opp['max_height']);
                    }
                    else if( $opp['max_width'] ) {
                        $filter = 'CGImage_Resize_Filter';
                        $args = array('w',(int)$opp['max_width'],0);
                    }
                    else if( $opp['max_height'] ) {
                        $filter = 'CGImage_Resize_Filter';
                        $args = array('h',(int)$opp['max_height'],0);
                    }
                }
                // adjust our lastfilter
                if( $filter ) $lastfilter = array($filter,$args);
            }

            // if we have a last filter... add it.
            if( $lastfilter ) $opp['filters'][] = $lastfilter;

            //
            // end of smartness stuff... now begin the work
            //
            if( count(array_keys($opp['filters'])) ) $want_transform = 1; // we're doing some kind of magic to the image.

            if( $want_transform ) {
                // calculate our destination name and url.
                $tmp = basename($srcfile);
                if( !isset($outp['alt']) ) $outp['alt'] = $tmp;
                $ext = strrchr($tmp,'.');
                $t2 = md5(serialize($opp));
                $destname = 'img-'.$t2;
                $t3 = self::parse_type(($opp['force_type'])?$opp['force_type']:$srcinfo['mime']);
                if( $opp['force_ext'] ) $destname .= self::get_extension($t3);

                $cache_path = $mod->GetPreference('cache_path', cms_join_path('uploads', '_'.$mod->GetName()));
                $destdir = cms_join_path($config['root_path'], $cache_path);
                if( !is_dir($destdir) ) {
                    @mkdir($destdir, 0777, true);
                    touch($destdir.'/index.html');
                }

                if( !is_dir($destdir) ) throw new Exception($mod->Lang('error_mkdir',$destdir));

                // see if it exists
                $dest_fname = $destdir.'/'.$destname;

                $dest_url = $mod->get_cached_image_url($destname);
                $t1 = filemtime($srcfile);
                $t2 = file_exists($dest_fname) ? filemtime($dest_fname) : 0;
                if( !file_exists($dest_fname) || (($t2 < $t1) && !$opp['notimecheck']) || $opp['overwrite']  ) $do_transform = 1;
            }
            else {
                // no transofmration... just use the src image
                $dest_fname = $srcfile;
                $dest_url = $opp['src'];
            }

            if( $do_transform ) {
                try {
                    // load the image.
                    $img = new CGImageBase($srcfile);

                    // process filters
                    $i = 0;
                    while( $i < count($opp['filters']) ) {
                        $filter = $opp['filters'][$i][0];
                        $filter_obj = new $filter($opp['filters'][$i][1]);
                        $img = $filter_obj->transform($img);
                        $img['dirty'] = 1; // force the image dirty, just so that we can save it.
                        $i++;
                    }

                    // check some stuff
                    if( $opp['noauto'] == 0 && (($outp['width'] && $img['width'] < $outp['width']) ||
                                                ($outp['height'] && $img['height'] < $outp['height'])) ) {
                        // user specified a width, and/or height...but they are smaller than the output of the filtering.
                        // this will ensure that the tag will match the image.
                        $outp['width'] = $img['width'];
                        $outp['height'] = $img['height'];
                    }

                    // and write the thing.
                    if( is_object($img) ) {
                        if( $opp['force_type'] ) $img['type'] = self::parse_type($opp['force_type']);
                        if( $img['dirty'] ) $img->save($dest_fname,$opp['quality']);
                    }
                }
                catch( Exception $e ) {
                    audit('','CGSmartImage','Error encountered on '.$opp['src'].': '.$e->GetMessage());
                    throw $e;
                }
            } // if

            // now, we have a cached filename ... need to get its dimensions.
            // and make sure that we're never outputting anything bigger than the cached dimensions
            // unless noauto is set
            if( $opp['noauto'] == 0 ) {
                $tmp = getimagesize($dest_fname);
                if( !is_array($tmp) || count($tmp) < 2 ) throw new Exception($mod->Lang('error_destnotfound',$dest_fname));
                $t_width = $tmp[0]; $t_height = $tmp[1];
                if( ($outp['width'] && $t_width < $outp['width']) || ($outp['height'] && $t_height < $outp['height']) ) {
                    $outp['width'] = $t_width;
                    $outp['height'] = $t_height;
                }
            }

            // at this point, we're ready to handle building the tag.
            if( $opp['nobcache'] ) $dest_url .= '?x='.time();

            if( !isset($outp['alt']) ) {
                if( $dest_fname ) {
                    $outp['alt'] = basename($dest_fname);
                }
                else if( $srcfile ) {
                    $outp['alt'] = basename($srcfile);
                }
                else {
                    $outp['alt'] = basename($opp['src']);
                }
            }

            // build the output.
            if( $opp['notag'] || self::_is_stylesheet() ) {
                $outp['src'] = $dest_url;
                if( !$opp['noembed'] && $mod->can_embed($dest_fname) ) {
                    $type = cge_utils::get_mime_type($dest_fname);
                    if( $type && $type != 'unknown' ) {
                        $tmp = base64_encode(file_get_contents($dest_fname));
                        $outp['src'] = 'data:'.$type.';base64,'.$tmp;
                    }
                }
                else {
                    $outp['src'] = $dest_url;
                }

                if( !isset($outp['output']) ) $outp['output'] = $outp['src'];
            }
            else {
                //
                // gotta build a tag.
                //
                // get the src first.
                if( !$opp['noembed'] && $mod->can_embed($dest_fname) ) {
                    $type = cge_utils::get_mime_type($dest_fname);
                    if( $type && $type != 'unknown' ) {
                        $tmp = base64_encode(file_get_contents($dest_fname));
                        $outp['src'] = 'data:'.$type.';base64,'.$tmp;
                    }
                }

                if( !isset($outp['src']) || !$outp['src'] ) {
                    // fallback to the destination url.
                    $outp['src'] = $dest_url;
                }

                if( $dest_fname && !$opp['noauto'] ) {
                    $details = getimagesize($dest_fname);
                    if( is_array($details) ) {
                        $outp['width']  = (int)$details[0];
                        $outp['height'] = (int)$details[1];
                    }
                }

                // now we can build the tag.
                $output = '<img';
                foreach( $outp as $key => $value ) {
                    if( !$value && $key != 'alt' ) continue; // empty alt is valid... stupid, but valid.
                    $output .= ' '.$key.'="'.$value.'"';
                }
                $output .= '/>';
                $outp['output'] = $output;
            }
        }
        catch( Exception $e ) {
            $outp['error'] = $e->GetMessage();
        }

        // here we're gonna return something
        return $outp;
    }


    public static function cgsi_convert($params,$content,&$smarty,$repeat)
    {
        if( !$content ) return;
        $max_width = -1;
        $max_height = -1;
        if( isset($params['max_height']) ) $max_height = max(0,(int)$params['max_height']);
        if( isset($params['max_width']) ) $max_width = max(0,(int)$params['max_width']);

        $did_modify = FALSE;
        $mod = cms_utils::get_module('CGSmartImage');
        $old_errorval = libxml_use_internal_errors(true);
        $dom = new CGDomDocument();
        $dom->strictErrorChecking = FALSE;
        $dom->validateOnParse = FALSE;
        if( function_exists('mb_convert_encoding') ) $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
        $dom->loadHTML($content);

        $imgs = $dom->GetElementsByTagName('img');
        if( is_object($imgs) && $imgs->length ) {
            for( $i = 0; $i < $imgs->length; $i++ ) {
                $node = $imgs->item($i);
                $sxe = simplexml_import_dom($node);

                $parms = $params;
                $process = true;
                foreach( $sxe->attributes() as $name => $value ) {
                    $value = (string)$value;
                    if( $value == '' ) continue;

                    switch( $name ) {
                    case 'width':
                        if( $max_width > 0 ) $value = min($max_width,(int)$value);
                        break;

                    case 'height':
                        if( $max_height > 0 ) $value = min($max_height,(int)$value);
                        break;

                    case 'class':
                        $words = explode(' ',$value);
                        if( in_array('nocgsi',$words) ) $process = false;
                        break;
                    }
                    $parms[$name] = $value;
                }

                if( !$process ) continue; // found a reason not do to anything with this image.
                if( !isset($parms['src']) ) continue;
                if( startswith($parms['src'],'data:') ) continue;   // already embedded, can't do anything.

                $parms['notag'] = 1;
                $outp = self::process_image($parms);
                foreach( $outp as $key => $value ) {
                    $did_modify = TRUE;
                    switch( $key ) {
                    case 'width':
                    case 'height':
                        $sxe->attributes()->$key = (int)$value;
                        break;
                    case 'src':
                    default:
                        $sxe->attributes()->$key = $value;
                        break;
                    }
                }
            } // for each image
        }

        // get the contents.
        if( $did_modify ) {
            $node = $dom->documentElement;
            $content = $node->innerHTML;
            $content = str_replace(chr(13),'',$content);
            $content = str_replace('&#13;','',$content);
            if( startswith($content,'<html>') ) {
                $content = str_replace('<html>','',$content);
                $content = str_replace('</html>','',$content);
            }
            if( startswith($content,'<body>') ) {
                $content = str_replace('<body>','',$content);
                $content = str_replace('</body>','',$content);
            }
        }
        return $content;
    }


    public static function get_device_capabilities()
    {
        if( is_array(self::$_device_data) && isset(self::$_device_data['width']) ) return self::$_device_data;

        if( !isset($_SERVER['HTTP_USER_AGENT']) ) return;
        $browser = cge_utils::get_browser();

        $agent = $_SERVER['HTTP_USER_AGENT'];
        $config = cmsms()->GetConfig();
        $ckey = md5($config['root_url'].'CGExtensionsDeviceCapabilitiesCache');

        // cache results for 14 days.
        $handler = new cms_filecache_driver(array('lifetime'=>24*3600*14,'auto_cleaning'=>1,'group'=>__CLASS__));
        $data = array();
        if( $handler->exists($ckey) ) {
            $rawdat = $handler->get($ckey);
            if( $rawdat ) $data = unserialize($rawdat);
        }
        $ukey = md5($agent);
        if( isset($data[$ukey]) ) {
            self::$_device_data = $data[$ukey];
            return $data[$ukey];
        }

        // gotta do a web service request.
        // here we would determine what client to use.
        $mod = cms_utils::get_module('CGSmartImage');
        if( !$mod ) return;

        // instantiate the class and do the request
        $client_class = 'cgsi_DeviceAtlasPersonal_client';
        if( !class_exists($client_class) ) return; // no client class found.
        $client_obj = new $client_class($agent);
        if( !is_object($client_obj) ) return; // no client class possible.
        $res = $client_obj->get_device_resolution();
        if( !is_array($res) ) return;

        // got results from web service
        $data[$ukey] = $res;
        $handler->set($ckey,serialize($data));
        self::$_device_data = $res;
        return $res;
    }

    public static function trim_to_device($flag,$value)
    {
        $flag = strtolower($flag);
        if( $value > 0 && is_array(self::$_device_data) && isset(self::$_device_data[$flag]) ) {
            return min($value,self::$_device_data[$flag]);
        }
        return $value;
    }

    public static function get_transparent_color(CGImageBase $img)
    {
        if( $img['transparent'] != '' ) return $img['transparent'];
    }

    public static function find_unused_color(CGImageBase $img)
    {
        // dont have a transparency color... so guess one.
        // find a random unused color for transparency.
        $r = $g = $b = 255;
        $found = 0;
        while( $found < 100 ) {
            $r = rand(0,255);
            $g = rand(0,255);
            $b = rand(0,255);
            if( imagecolorexact($img['rsrc'],$r,$g,$b) != -1 ) break;
            $found++;
        }

        if( $found == 50 ) audit('','CGSmartImage','No unused color found');
        return array($r,$g,$b);
    }
}

#
# EOF
#
?>