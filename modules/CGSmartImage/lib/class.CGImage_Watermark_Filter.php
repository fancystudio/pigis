<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGSmartImage (c) 2011 by Robert Campbell (calguy1000@cmsmadesimple.org)
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

class CGImage_Watermark_Filter extends CGImageFilterBase
{
  private $_wmimg = null;
  private $_wminfo = null;
  private $_hmargin = 40;
  private $_vmargin = 40;
  private $_height = null;
  private $_width = null;
  private $_align = cg_watermark::ALIGN_MC;
  private $_translucency = 50;
  private $_use_merge = false;
  private $_padding_x = 0;
  private $_padding_y = 0;

  public function __construct()
  {
      $cge = cge_utils::get_cge();
      $txt = $cge->GetPreference('watermark_text');
      $img = $cge->GetPreference('watermark_file');
      $this->_align = $cge->GetPreference('watermark_alignment',cg_watermark::ALIGN_MC);
      $this->_translucency = $cge->GetPreference('watermark_translucency',50);

      $config = cmsms()->GetConfig();

      if( !empty($img) && file_exists(cms_join_path($config['uploads_path'],$img)) )
      {
          $tmp = cms_join_path($config['uploads_path'],$img);
          $this->_wminfo = getimagesize($tmp);
          $this->_width = $this->_wminfo[0];
          $this->_height = $this->_wminfo[1];
          $data = @file_get_contents($tmp);
          $this->_wmimg = imagecreatefromstring($data);
      }
      else if( !empty($txt) )
      {
          $font = $cge->GetPreference('watermark_font');
          if( !startswith($font,'/') ) $font = $cge->GetModulePath().'/fonts/'.$font;
          $size = $cge->GetPreference('watermark_textsize');
          $angl = $cge->GetPreference('watermark_textangle',0);
          $angl = (float)$angl;
          $fclr = $cge->GetPreference('watermark_textcolor','#000000');
          $bclr = $cge->GetPreference('watermark_bgcolor','#ffffff');
          $tpnt = $cge->GetPreference('watermark_transparent',1);

          if( !$font || !$size )
              throw new Exception('Insufficient information to generate watarmark... Ensure watermark preferences are set in CGExtensions');

// calculate a size for the image
          $tmp = imageftbbox($size,$angl,$font,$txt);
          $this->_width = abs($tmp[0])+abs($tmp[2])+$this->_hmargin;
          $this->_height = abs($tmp[1])+abs($tmp[5])+$this->_vmargin;

// create the image.
          $this->_wmimg = imagecreatetruecolor($this->_width,$this->_height);
          $this->_use_merge = true;

// bgcolor
          $r = hexdec(substr($bclr,1,2)); $g = hexdec(substr($bclr,3,2)); $b = hexdec(substr($bclr,5,2));
          $bc = imagecolorallocatealpha($this->_wmimg,$r,$g,$b,($tpnt)?0:127);
// fill the background
          imagefilledrectangle($this->_wmimg,0,0,$this->_width-1,$this->_height-1,$bc);
// make the background transparent.
          if( $tpnt ) imagecolortransparent($this->_wmimg,$bc);

// draw the foreground text
          $r = hexdec(substr($fclr,1,2)); $g = hexdec(substr($fclr,3,2)); $b = hexdec(substr($fclr,5,2));
          $fc = imagecolorallocate($this->_wmimg,$r,$g,$b);
          $res = imageTTFText($this->_wmimg,$size,$angl,
                              (int)($this->_hmargin/2),(int)($this->_height - $this->_vmargin/2),
                              $fc,$font,$txt);
}
  }


  public function transform(CGImageBase $image)
  {
      $_dest = new CGImageBase($image);
      if( $image['width'] < $this->_width || $image['height'] < $this->_height ) return $_dest;

      // Find out the placement of the watermark
      // on the result image
      $posx = '';
      $posy = '';
      $cx = ($image['width'] - $this->_width)/2;
      $cy = ($image['height'] - $this->_height)/2;
      switch( $this->_align ) {
      case cg_watermark::ALIGN_UL:
          $posx = (int)$this->_padding_x;
          $posy = (int)$this->_padding_y;
          break;

      case cg_watermark::ALIGN_UC:
          $posx = $cx;
          $posy = (int)$this->_padding_y;
          break;

      case cg_watermark::ALIGN_UR:
          $posx = (int)($image['width'] - $this->_width);
          $posy = 0;
          break;

      case cg_watermark::ALIGN_ML:
          $posx = 0;
          $posy = (int)$cy;
          break;

      case cg_watermark::ALIGN_MC:
          $posx = (int)$cx;
          $posy = (int)$cy;
          break;

      case cg_watermark::ALIGN_MR:
          $posx = (int)($image['width'] - $this->_width);
          $posy = (int)$cy;
          break;

      case cg_watermark::ALIGN_LL:
          $posx = (int)0;
          $posy = (int)($image['height'] - $this->_height);
          break;

      case cg_watermark::ALIGN_LC:
          $posx = (int)$cx;
          $posy = (int)($image['height'] - $this->_height);
          break;

      case cg_watermark::ALIGN_LR:
      default:
          $posx = (int)($image['width'] - $this->_width);
          $posy = (int)($image['height'] - $this->_height);
          break;
      }

      if( $posx === '' || $posy === '' ) throw new Exception('Error applying filter (watermark) - could not calculate position');

      $res = '';
      imagealphablending($this->_wmimg,FALSE);
      if( $this->_use_merge ) {
          $res = imagecopymerge($_dest['rsrc'],$this->_wmimg,$posx,$posy, 0,0,$this->_width,$this->_height,$this->_translucency);
      }
      else {
          imagesavealpha($this->_wmimg,TRUE);
          $res = imagecopyresampled($_dest['rsrc'],$this->_wmimg,$posx,$posy, 0,0,$this->_width,$this->_height,$this->_width,$this->_height);
      }

      if( is_resource($this->_wmimg) ) imagedestroy($this->_wmimg);
      return $_dest;
  }
} // end of class

#
# EOF
#
?>
