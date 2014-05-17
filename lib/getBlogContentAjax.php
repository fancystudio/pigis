<?php
error_reporting( E_ALL );
ini_set('display_errors', 1);
	require_once('HelperClass.php');
	require_once ('../config.php');
	$pageItems = array();
	$help = new Helper($config);
	$pageItems = $help->getCurrentBlogPage($_POST["currentPage"],null);
	for($i = 0; $i < count($pageItems); $i++){
		?>
		<div class="row">
			<div class="col-md-3 col-md-offset-1 blog-img">
			    <a href="javascript:void(0)" class="thumbnail">
			      <img src="<?php echo $pageItems[$i]["img"]?>" alt="<?php echo $pageItems[$i]["title"]?>">
			    </a>
			</div>
			<div class="col-md-7 blog-desc article">
				<h2><a href="#"><?php echo $pageItems[$i]["title"]?></a><span></span></h2>
				<p class="article-date"><img src="img/blog/time-icon.png" width="15" height="15"><?php echo $pageItems[$i]["date"]?></p>
				<p><?php echo $pageItems[$i]["summary"]?></p>
				<button type="button" class="btn btn-default btn-xs pull-right showBlogModal" data-toggle="modal" data-target="#blogContent<?php echo $pageItems[$i]["id"]?>">
	  				<span class="glyphicon glyphicon-align-justify"></span> viac
				</button>
			</div><!--blog-desc-->
		</div>
		<?php 
	}
	for($i = 0; $i < count($pageItems); $i++){
		?>
		<div class="modal fade" id="blogContent<?php echo $pageItems[$i]["id"]?>" tabindex="-1" role="dialog" aria-hidden="true">
	  		<?php echo $pageItems[$i]["content"]?>
		</div>
		<?php 
	}
	?>
	<div class="currentPage" style="display:none"><?php echo $help->getBlogPageCount();?></div>
	<?php
?>