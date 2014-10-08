<?php

session_start();
error_reporting(0);
require('UploadHandler.php');
 if(isset($_SESSION['cid'])) $dir = 'data/'.$_SESSION['cid'].'/images/';
 else $dir='tmp/';
$option = array(
    /* some options */
    'upload_dir' => '../../'.$dir,
    'upload_url' => $dir
    /* .... */
);
$upload_handler = new UploadHandler($option);
?>


