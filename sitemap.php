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
<url>
  <loc>http://www.infermap.com/guide.php</loc>
  <changefreq>always</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://www.infermap.com/blog/2014/03/related-topics/</loc>
  <changefreq>always</changefreq>
  <priority>0.64</priority>
</url>
<url>
  <loc>http://www.infermap.com/blog/2014/03/engineering-career/</loc>
  <changefreq>always</changefreq>
  <priority>0.60</priority>
</url>
<url>
  <loc>http://www.infermap.com/blog/2014/03/need-infermap/</loc>
  <changefreq>always</changefreq>
  <priority>0.60</priority>
</url>
<url>
  <loc>http://www.infermap.com/about.php</loc>
  <changefreq>always</changefreq>
  <priority>0.70</priority>
</url>
<url>
  <loc>http://www.infermap.com/FAQ.php</loc>
  <changefreq>always</changefreq>
  <priority>0.60</priority>
</url>
<url>
  <loc>http://www.infermap.com/main.php</loc>
  <changefreq>always</changefreq>
  <priority>0.90</priority>
</url>
<url>
  <loc>http://www.infermap.com/compare.php</loc>
  <changefreq>always</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://www.infermap.com/blog/</loc>
  <changefreq>always</changefreq>
  <priority>0.64</priority>
</url>
<url>
  <loc>http://www.infermap.com/blog/about-us/</loc>
  <changefreq>always</changefreq>
  <priority>0.64</priority>
</url>
<url>
  <loc>http://www.infermap.com/blog/category/uncategorized/</loc>
  <changefreq>always</changefreq>
  <priority>0.64</priority>
</url>
<url>
  <loc>http://www.infermap.com/blog/author/infermap/</loc>
  <changefreq>always</changefreq>
  <priority>0.64</priority>
</url>
<url>
  <loc>http://www.infermap.com/blog/feed/</loc>
  <lastmod>2014-04-03T19:52:15+00:00</lastmod>
  <changefreq>always</changefreq>
  <priority>0.64</priority>
</url>
<url>
  <loc>http://www.infermap.com/blog/comments/feed/</loc>
  <lastmod>2014-04-22T00:43:08+00:00</lastmod>
  <changefreq>always</changefreq>
  <priority>0.64</priority>
</url>
<url>
  <loc>http://www.infermap.com/.</loc>
  <changefreq>always</changefreq>
  <priority>0.64</priority>
</url>';


$q=mysqli_query($con,"select * from college_id where disabled='1'");
$url=array('about','academics','admission','fees','facilities','sports','placements','contacts');
while($row=mysqli_fetch_assoc($q)){
	$str.= '<url>
  <loc>http://www.infermap.com/college/'.$row['link'].'</loc>
  <changefreq>weekly</changefreq>
  <priority>0.40</priority>
</url>
';
 /* foreach ($url as $key)  {
    $str.= '<url>
  <loc>http://www.infermap.com/college/'.clean($row['name'])."-".$row['city']."-".$row['link'].'&amp;tab='.$key.'</loc>
  <changefreq>weekly</changefreq>
  <priority>0.20</priority>
</url>
    ';
  }*/
}
$str.='</urlset>';
$file = fopen("./sitemap.txt", "w");
 fwrite($file,$str);
	fclose($file);

rename("sitemap.txt", "sitemap.xml");
header("location:sitemap.xml");
?>
