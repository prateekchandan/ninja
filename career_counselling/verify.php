<?php
session_start();
$return_arr=array();
if(isset($_POST['Q_1']))
{
	$return_arr["n1"] = $_POST['Q_1'];
}

if(isset($_POST['Q_2']))
{
	$return_arr["n2"] = $_POST['Q_2'];
}

if(isset($_POST['Q_3']))
{
	$return_arr["n3"] = $_POST['Q_3'];
}

if(isset($_POST['Q_4']))
{
	$return_arr["n4"] = $_POST['Q_4'];
}

if(isset($_POST['Q_5']))
{
	$return_arr["n5"] = $_POST['Q_5'];
}

if(isset($_POST['Q_6']))
{
	$return_arr["n6"] = $_POST['Q_6'];
}

if(isset($_POST['Q_7']))
{
	$return_arr["n7"] = $_POST['Q_7'];
}


if(isset($_POST['Q_8']))
{
	$return_arr["n8"] = $_POST['Q_8'];
}

if(isset($_POST['Q_9']))
{
	$return_arr["n9"] = $_POST['Q_9'];
}

if(isset($_POST['Q_10']))
{
	$return_arr["n10"] = $_POST['Q_10'];
}

if(isset($_POST['Q_11']))
{
	$return_arr["n11"] = $_POST['Q_11'];
}

if(isset($_POST['Q_12']))
{
	$return_arr["n12"] = $_POST['Q_12'];
}

if(isset($_POST['Q_13']))
{
	$return_arr["n13"] = $_POST['Q_13'];
}

if(isset($_POST['Q_14']))
{
	$return_arr["n14"] = $_POST['Q_14'];
}

if(isset($_POST['Q_15']))
{
	$return_arr["n15"] = $_POST['Q_15'];
}

if(isset($_POST['Q_16']))
{
	$return_arr["n16"] = $_POST['Q_16'];
}

if(isset($_POST['Q_17']))
{
	$return_arr["n17"] = $_POST['Q_17'];
}

if(isset($_POST['Q_18']))
{
	$return_arr["n18"] = $_POST['Q_18'];
}

if(isset($_POST['Q_19']))
{
	$return_arr["n19"] = $_POST['Q_19'];
}

if(isset($_POST['Q_20']))
{
	$return_arr["n20"] = $_POST['Q_20'];
}

echo json_encode($return_arr);
?>
