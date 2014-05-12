<?php
if( !$gCms ) exit();

// Get the session Id passed from SWFUpload. We have to do this to work-around the Flash Player Cookie Bug
if (isset($_POST['PHPSESSID']))
{
	session_id($_POST['PHPSESSID']);
}
//session_start();
//ini_set("html_errors", "0");

// Check the upload
if (!isset($_FILES['Filedata']) || !is_uploaded_file($_FILES['Filedata']['tmp_name']) || $_FILES['Filedata']['error'] != 0)
{
	echo 'ERROR:invalid upload';
	exit(0);
}

// Check the uploaddirectory
$root_path = str_replace('\\', '/', $config['root_path']) . '/';
if ( !isset($_SESSION['uploaddir']) || !is_dir($root_path . $_SESSION['uploaddir']) )
{
	echo 'ERROR:invalid uploaddirectory';
	exit(0);
}

// cleanup the filename, copied some code from munge_string_to_url() and modified to exclude the extension
$pos = strrpos($_FILES['Filedata']['name'], '.');
include('../lib/replacement.php');
$alias = substr($_FILES['Filedata']['name'], 0, $pos);
$alias = str_replace($toreplace, $replacement, $alias);
$alias = preg_replace('/[^a-z0-9-_]+/i','-',$alias);
$alias = trim($alias . substr($_FILES['Filedata']['name'], $pos), '-');

$filename = $_SESSION['uploaddir'] . '/' . $alias;
$thumbname = $_SESSION['uploaddir'] . '/thumb_' . $alias;
$thumbid = urlencode(base64_encode($thumbname));

if ( Gallery_utils::CreateThumbnail('../' . $thumbname, $_FILES['Filedata']['tmp_name'], get_site_preference('thumbnail_width',96), get_site_preference('thumbnail_height',96), 'sc') )
{
	move_uploaded_file($_FILES['Filedata']['tmp_name'], str_replace('/', DIRECTORY_SEPARATOR, $root_path . $filename));
	echo 'FILEID:' . $thumbid; 	// Return the file id to the script
}
else
{
	echo 'File corrupt: ' . $alias;
}
exit(0);
?>