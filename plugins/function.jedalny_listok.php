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

function smarty_function_jedalny_listok($params, &$template){
	$pondelok = "";
	$utorok = "";
	$streda = "";
	$stvrtok = "";
	$piatok = "";
	$sobota = "";
	$nedela = "";
	$db = cmsms()->GetDb();
	$weekDaysSelect = $db->GetArray("SELECT prop_name, content FROM cms_content_props where content_id = 57");
	foreach($weekDaysSelect as $weekDay){	
		if($weekDay["prop_name"] == "content_en"){ $pondelok = $weekDay["content"]; }
		if($weekDay["prop_name"] == "utorok"){ $utorok = $weekDay["content"]; }
		if($weekDay["prop_name"] == "streda"){ $streda = $weekDay["content"]; }
		if($weekDay["prop_name"] == "stvrtok"){ $stvrtok = $weekDay["content"]; }
		if($weekDay["prop_name"] == "piatok"){ $piatok = $weekDay["content"]; }
		if($weekDay["prop_name"] == "sobota"){ $sobota = $weekDay["content"]; }
		if($weekDay["prop_name"] == "nedela"){ $nedela = $weekDay["content"]; }
	}
	?>
	<div class="container content jedalny-listok">
	<div class="col-md-12">
	<h1><img src="img/titles/jedalny-listok.png" alt="jedálny lístok"></h1>
	</div>
	
	<div class="jedalny-items">
	<div class="col-md-3 col-md-offset-1 listok"><a class="jedalny" href="#"><img  class="img-responsive" src="img/jedalny-listok/jedalny-listok.png" alt="jedálny lístok"/></a></div>
	<div class="col-md-6 col-md-offset-1">
	<div class="specialita-dna"><div class="inner-content">
	<?php 
		echo $pondelok;
		echo $utorok;
		echo $streda;
		echo $stvrtok;
		echo $piatok;
		echo $sobota;
		echo $nedela;
	?>
	</div><!--inner conent-->
	<img  class="img-responsive" src="img/jedalny-listok/chalkboard.png" alt="špecialita dňa"/></div><!--specialita-dna-->
	</div>
	</div><!--jedalny items-->
	
	</div><!--container-->
	<?php
}
?>
