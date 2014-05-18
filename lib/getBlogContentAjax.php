<?php
require_once 'HelperClass.php';
require_once '../config.php';
$pageItems = array();
$help = new Helper($config);
$pageItems = $help->getCurrentBlogPage($_POST["currentPage"],null);
$content = "";
for($i = 0; $i < count($pageItems); $i++){
	$content .= '<div class="row">';
	$content .= '<div class="col-md-3 col-md-offset-1 blog-img">';
	$content .= '<a href="javascript:void(0)" class="thumbnail showBlogDetail">';
	$content .= '<img src="crop.php?src='.$pageItems[$i]["img"].'&w=485&h=360" alt="'.$pageItems[$i]["title"].'">';
	$content .= '</a>';
	$content .= '</div>';
	$content .= '<div class="col-md-7 blog-desc article">';
	$content .= '<h2><a href="javascript:void(0)" class="showBlogDetail">'.$pageItems[$i]["title"].'</a><span></span></h2>';
	$content .= '<p class="article-date"><img src="img/blog/time-icon.png" width="15" height="15">'.$pageItems[$i]["date"].'</p>';
	$content .= '<p>'.$pageItems[$i]["summary"].'</p>';
	$content .= '<button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target="#blogContent'.$pageItems[$i]["id"].'">';
	$content .= '<span class="glyphicon glyphicon-align-justify"></span> viac';
	$content .= '</button>';
	$content .= '</div><!--blog-desc-->';
	$content .= '</div>';
}
$content .= '<script type="text/javascript">';
$content .= '$(".showBlogDetail").click(function(){ loadBlogDetailAndShow($(this).parents(".row").find("button").attr("data-target"), "thumbClick");});';
$content .= '</script>';
$response_array['status'] = (($pageItems != null) ? "success" : "error");
$response_array['content'] = $content;
$response_array['currentPage'] = $help->getBlogPageCount();
header('Content-type: application/json');
echo json_encode($response_array);
?>