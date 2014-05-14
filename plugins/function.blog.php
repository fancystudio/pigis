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
		<div class="row">
			<div class="col-md-3 col-md-offset-1 blog-img">
			    <a href="#" class="thumbnail">
			      <img src="img/blog/article-img.jpg" alt="tu nadpis">
			    </a>
			</div>
			
			<div class="col-md-7 blog-desc article">
			<h2><a href="#">Mate tuto hento novinku</a><span></span></h2>
			
			<p class="article-date"><img src="img/blog/time-icon.png" width="15" height="15"> 23.5.2014 / 13:00</p>
			<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur...
			</p>
			<button type="button" class="btn btn-default btn-xs pull-right">
  <span class="glyphicon glyphicon-align-justify"></span> viac
</button>
			</div><!--blog-desc-->
		</div>
	
		<div class="row">
			<div class="col-md-3 col-md-offset-1 blog-img">
			    <a href="#" class="thumbnail">
			      <img src="img/blog/article-img.jpg" alt="tu nadpis">
			    </a>
			</div>
			
			<div class="col-md-7 blog-desc article">
			<h2><a href="#">Mate tuto hento novinku</a><span></span></h2>
			
			<p class="article-date"><img src="img/blog/time-icon.png" width="15" height="15"> 23.5.2014 / 13:00</p>
			<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur...
			</p>
			<button type="button" class="btn btn-default btn-xs pull-right">
  <span class="glyphicon glyphicon-align-justify"></span> viac
</button>
			</div><!--blog-desc-->
		</div>
	
	
		<div class="row">
			<div class="col-md-3 col-md-offset-1 blog-img">
			    <a href="#" class="thumbnail">
			      <img src="img/blog/article-img.jpg" alt="tu nadpis">
			    </a>
			</div>
			
			<div class="col-md-7 blog-desc article">
			<h2><a href="#">Mate tuto hento novinku</a><span></span></h2>
			
			<p class="article-date"><img src="img/blog/time-icon.png" width="15" height="15"> 23.5.2014 / 13:00</p>
			<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur...
			</p>
			<button type="button" class="btn btn-default btn-xs pull-right">
  <span class="glyphicon glyphicon-align-justify"></span> viac
</button>
			</div><!--blog-desc-->
		</div>
		
		
			</div>
	<div class="pagination">
	</div>
	
	</div><!--blog-->
	<?php 
}
?>
