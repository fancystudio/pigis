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
	$dayOfWeek = date("w");
	$dayOfWeekToSelect = "content_en"; //pondelok len v db sa inak vola pole
	$dayOfWeekSk = "Pondelok";
	if($dayOfWeek == 2){
		$dayOfWeekToSelect = "utorok";
		$dayOfWeekSk = "Utorok";
	}
	if($dayOfWeek == 3){
		$dayOfWeekToSelect = "streda";
		$dayOfWeekSk = "Streda";
	}
	if($dayOfWeek == 4){
		$dayOfWeekToSelect = "stvrtok";
		$dayOfWeekSk = "Štvrtok";
	}
	if($dayOfWeek == 5){
		$dayOfWeekToSelect = "piatok";
		$dayOfWeekSk = "Piatok";
	}
	if($dayOfWeek == 6){
		$dayOfWeekToSelect = "sobota";
		$dayOfWeekSk = "Sobota";
	}
	$weekDayContent = "";
	$db = cmsms()->GetDb();
	$weekDaysSelect = $db->GetArray("SELECT prop_name, content FROM cms_content_props where content_id = 57 and prop_name like '".$dayOfWeekToSelect."'");
	foreach($weekDaysSelect as $weekDay){	
		$weekDayContent = $weekDay["content"];
	}
	?>

	<div class="container content jedalny-listok">
	
	<div class="col-md-12">
	<h1><img src="img/titles/menu.png" alt="jedálny lístok" width="116" height="35"></h1>
	</div>
	
	<div class="jedalny-items">
	<div class="col-md-3 col-md-offset-1 listok">
	
	<!--<a href="includes/jedalny-listok.php" class="jedalny" data-toggle="modal" data-target="#myModal">-->
	<a href="./uploads/jedalny-listok.pdf" class="jedalny">
	<img  class="img-responsive" src="img/jedalny-listok/jedalny-listok.png" alt="jedálny lístok" width="378" height="489"/></a>
	
	
	
	
	</div>
	<div class="col-md-7 col-lg-6 col-md-offset-1">
	<div class="specialita-dna"><div class="inner-content">
	<h2>špecialita dňa</h2>
	<h3><?php echo $dayOfWeekSk." ".(($dayOfWeek == 0) ? Date('d.m.Y', strtotime("+1 days")) : date("d.m.Y"))?></h3>
	<?php 
		echo $weekDayContent;
	?>
	<a href="includes/newsletter.php" class="specialita-dna-news" data-toggle="modal" data-target="#modlanews">
	<img class="mail-icon" src="img/mail-icon.png" width="47" height="30"/><br>Dostávaj špecialitu dňa na tvoj e-mail!</a>
	</div><!--inner conent-->
	<img  class="img-responsive" src="img/jedalny-listok/chalkboard.png" alt="špecialita dňa" width="584" height="590"/></div><!--specialita-dna-->
	</div>
	</div><!--jedalny items-->
	
	</div><!--container-->
	<?php
}
?>
