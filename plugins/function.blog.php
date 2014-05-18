<?php
#CMS - CMS Made Simple
#(c)2004 by Ted Kulp (wishy@users.sf.net)
#This project's homepage is: http://www.cmsmadesimple.org
#
#This program is free software; you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation; either version 2 of the License, or
#(at your option) any later version.
#
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#GNU General Public License for more details.
#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

function smarty_function_blog($params, &$template){
	?>
	<div class="container blog">
	<div class="col-md-12">
	<h1><img src="img/titles/nauc-sa-chefovat.png" alt="nauč sa chefovať"></h1>
	</div>
	
	<div class="blogContent container">
		<div class="blogThumbs container"></div>
		<div class="blogModal container"></div>
	</div>
			
	<div class="pagination col-md-10 col-md-offset-1">
	
	</div>
	
	</div><!--blog-->
	<?php 
}
?>
