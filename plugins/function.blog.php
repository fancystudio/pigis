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
	<div class="blogContent">
		<div class="row">
			<div class="col-md-3 col-md-offset-1 blog-img">
			    <a href="#" class="thumbnail">
			      <img data-src="holder.js/100%x180" alt="...">
			    </a>
			</div>
			
			<div class="col-md-7 blog-desc well">
			<h2>mate tuto hento novinku</h2>
			
			<p class="article-date"><span>tu bude ikona hodin</span> tu datum a cas</p>
			<p>tu bude popis truncate na pocet znako</p>
			<a class="pull-right" href="#">viac -></a>
			</div><!--blog-desc-->
		</div>
	
		<div class="row">
			<div class="col-md-3 col-md-offset-1 blog-img">
			    <a href="#" class="thumbnail">
			      <img data-src="holder.js/100%x180" alt="...">
			    </a>
			</div>
			
			<div class="col-md-7 blog-desc well">
			<h2>mate tuto hento novinku</h2>
			
			<p class="article-date"><span>tu bude ikona hodin</span> tu datum a cas</p>
			<p>tu bude popis truncate na pocet znako</p>
			<a class="pull-right" href="#">viac -></a>
			</div><!--blog-desc-->
		</div>
	
	
		<div class="row">
			<div class="col-md-3 col-md-offset-1 blog-img">
			    <a href="#" class="thumbnail">
			      <img data-src="holder.js/100%x180" alt="...">
			    </a>
			</div>
			
			<div class="col-md-7 blog-desc well">
			<h2>mate tuto hento novinku</h2>
			
			<p class="article-date"><span>tu bude ikona hodin</span> tu datum a cas</p>
			<p>tu bude popis truncate na pocet znako</p>
			<a class="pull-right" href="#">viac -></a>
			</div><!--blog-desc-->
		</div>
	</div>
	<div class="pagination">
	</div>
	
	</div><!--blog-->
	<?php 
}
?>
