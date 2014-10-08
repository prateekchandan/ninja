<?php

session_start();
error_reporting(0);
require('UploadHandler.php');
 if(isset($_SESSION['coachingid'])) $dir = 'data/'.$_SESSION['coachingid'].'/images/';
 else $dir='tmp/';
$option = array(
    /* some options */
    'upload_dir' => '../../'.$dir,
    'upload_url' => $dir
    /* .... */
);
$upload_handler = new UploadHandler($option);
?>


