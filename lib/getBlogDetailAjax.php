<?php
require_once 'HelperClass.php';
require_once '../config.php';
$pageItems = array();
$help = new Helper($config);
$pageItems = $help->getBlogDetail($_POST["blogId"]);
$content = '<div class="modal fade blogModalDetail" id="blogContent'.$pageItems[0]["id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';

$content .= '<div class="modal-dialog modal-lg"><div class="modal-content">
             <div class="modal-header"><img src="img/blog/logo-det.png"/>
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>';
             
$content .= '<div class="modal-body">';
$content .= $pageItems[0]["content"];
$content .= '</div>';

$content .= '<div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Zavrieť</button>
             </div>';

$content .= '</div>
             </div>';

$content .= '</div>';
$content .= '<script type="text/javascript">';
$content .= '$(".blogModalDetail").on("show.bs.modal", function () { window.location.hash = $(this).attr("id"); });';
$content .= '</script>';
$response_array['status'] = (($pageItems != null) ? "success" : "error");
$response_array['content'] = $content;
header('Content-type: application/json');
echo json_encode($response_array);
?>
