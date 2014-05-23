<?php
require_once 'HelperClass.php';
require_once '../config.php';
$pageItems = array();
$help = new Helper($config);
$pageItems = $help->getCurrentBlogPage($_POST["currentPage"],(($_POST["contentHashId"] != "") ? $_POST["contentHashId"] : null));
$content = "";
for($i = 0; $i < count($pageItems); $i++){
	$content .= '<div class="row">';
	$content .= '<div class="col-md-10 col-md-offset-1">';
	$content .= '<div class="row">';
	$content .= '<div class="col-lg-4 col-md-5 col-sm-5 blog-img">';
	$content .= '<a href="javascript:void(0)" class="thumbnail showBlogDetail">';
	$content .= '<img class="img-responsive" src="crop.php?src='.$pageItems[$i]["img"].'&w=619&h=405" alt="'.$pageItems[$i]["title"].'">';
	$content .= '</a>';
	$content .= '</div>';
	$content .= '<div class="col-lg-8 col-md-7 col-sm-7 blog-desc article">';
	$content .= '<h2><a href="javascript:void(0)" class="showBlogDetail">'.$pageItems[$i]["title"].'</a><span></span></h2>';
	$content .= '<p class="article-date"><img src="img/blog/time-icon.png" width="15" height="15">'.$pageItems[$i]["date"].'</p>';
	$content .= '<div class="article-summary">'.$pageItems[$i]["summary"].'</div>';
	$content .= '<button type="button" class="btn btn-default btn-xs pull-right showBlogDetail" data-toggle="modal" id="#blogContent'.$pageItems[$i]["id"].'">';
	$content .= '<span class="glyphicon glyphicon-align-justify"></span> viac';
	$content .= '</button>';
	$content .= '</div><!--blog-desc-->';
	$content .= '</div>';
	$content .= '</div>';
	$content .= '</div>';
}
$content .= '<script type="text/javascript">';
$content .= '$(".showBlogDetail").click(function(){ loadBlogDetailAndShow($(this).parents(".row").find("button").attr("id"), "thumbClick");});';
$content .= '</script>';
$response_array['status'] = (($pageItems != null) ? "success" : "error");
$response_array['content'] = $content;
$response_array['totalPage'] = $help->getBlogPageCount();
$response_array['currentPage'] = $pageItems[0]["currentPage"];
header('Content-type: application/json');
echo json_encode($response_array);
?>