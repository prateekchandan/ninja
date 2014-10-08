<?php
function clean($string) {
     $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
include 'php/dbconnect.php';

	$str='<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
  <loc>http://www.infermap.com/</loc>
  <changefreq>always</changefreq>
  <priority>1.00</priority>
</url>
';


$q=mysqli_query($con,"select distinct state from college_id where disabled='1' && state !='' && state != '--Select State--'");
while($row=mysqli_fetch_assoc($q)){
	$str.= '<url>
  <loc>http://www.infermap.com/main.php?search=side-filter&amp;state='.urlencode($row['state']).'</loc>
  <changefreq>weekly</changefreq>
  <priority>0.50</priority>
</url>
';
}

$q=mysqli_query($con,"select distinct city,state from college_id where disabled='1' && state !='' && state != '--Select State--' && city!=''");
while($row=mysqli_fetch_assoc($q)){
  $str.= '<url>
  <loc>http://www.infermap.com/main.php?search=side-filter&amp;state='.urlencode($row['state']).'&amp;city='.urlencode($row['city']).'</loc>
  <changefreq>weekly</changefreq>
  <priority>0.40</priority>
</url>
';
}

$q=mysqli_query($con,"select distinct name from exam where active = '1'");
while($row=mysqli_fetch_assoc($q)){
  $str.= '<url>
  <loc>http://www.infermap.com/main.php?search=side-filter&amp;exam='.urlencode($row['name']).'</loc>
  <changefreq>weekly</changefreq>
  <priority>0.40</priority>
</url>
';
}

$str.='</urlset>';
$file = fopen("./sitemap1.txt", "w");
 fwrite($file,$str);
	fclose($file);

rename("sitemap1.txt", "sitemap1.xml");
header("location:sitemap1.xml");
?>