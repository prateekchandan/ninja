<?php
if(isset($_GET["cid"])){
    $cid=$_GET["cid"]; 
}
    else
$cid=0;

$path="data/".$cid."/";
$path_chk="../data/".$cid."/";
$default_path="data/default/";
$return="";
$return='<ol class="carousel-indicators">';
     // Reading all images from directory 
    if ($handle = opendir($path_chk.'images/')) {
        $count=0;
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
       if($entry!=="." && $entry!=".." &&$entry!="logo.png"&&$entry!='thumbnail')
       {
         if($count==0)
            $add="";
        else
            $add="";
          $return.='<li data-target="#carousel-gallery" data-slide-to="'.$count.'" class="'.$add.'"></li>';
         $count=$count+1;
       }
    }
    $return.=' </ol><div class="carousel-inner">';
     closedir($handle);
     $handle = opendir($path_chk.'images/');
    $t=0;
     while (false !== ($entry = readdir($handle))) {
       if($entry!=="." && $entry!=".." &&$entry!="logo.png"&&$entry!='thumbnail')
       {
        $alt="";
        if(file_exists($path_chk."img-alt/".$entry.".txt"))
            {
                $file = fopen($path_chk."img-alt/".$entry.".txt", "r") or exit("Unable to open file!");
                $alt= fgets($file);
                fclose($file);
            }
            else
                $alt="";
            $filename=$path."images/".$entry;
            if($t==0)
                $add="active";
            else
            $add="";
            $return.='<div class="item '.$add.'">
                            <img src="'.$filename.'">
                            <div class="carousel-caption">
                              <h4 style="background:rgba(100,100,100,0.3);height:27px;">'.$alt.'</h4>
                            </div></div>';
            $t=1;
       }
    }

    $return.='</div>
                        <a class="left carousel-control" href="#carousel-gallery" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-gallery" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                      </div>';
    closedir($handle);
    }
    echo $return;
?>