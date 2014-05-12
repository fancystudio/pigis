<?php 
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