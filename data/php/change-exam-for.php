<?php
$con=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","infermap") or die(mysql_error());
$con1=mysqli_connect("localhost","prateek","Prateek5545@gmail.com","college_data") or die(mysql_error());
session_start();
if(isset($_GET['cid']))
    {
        $cid=$_GET['cid'];
    }
    else
    {
        die("error");
    }
$catQuery=mysqli_query($con,"select * from category");
$categories=[];
$i=0;
while($row=mysqli_fetch_assoc($catQuery))
{
    $a=['id'=>$row['id'],'name'=>$row['name']];
    $categories[$i]=$a;
    $i+=1;
}
$newexam=$_POST['new-exam'];
$oldexam=$_POST['previous'];
$type=$_POST['examnametype'];
$no=mysqli_query($con,"select * from college_entrance_test where type='".$type."'&& cid=".$cid." && name=".$newexam);
if(mysqli_num_rows($no)>=1&&$newexam!=$oldexam)
    die("error");

$catexam=mysqli_fetch_array(mysqli_query($con,"select category from exam where eid=".$newexam))['category'];
$catexam=json_decode($catexam,true);
$q="update college_entrance_test set name=".$newexam." ";
foreach ($categories as $key) {
    $q.=",";
    if(in_array($key['id'], $catexam))
    $q.=" ".$key['id']."=1 ";
    else
    $q.=" ".$key['id']."=0 ";
}
mysqli_query($con,$q."  where type='".$type."' && cid=".$cid." && name=".$oldexam);

$q="update t".$cid." set name=".$newexam;
mysqli_query($con1,$q."  where program='".$type."' && name=".$oldexam);
$name=$newexam;

$college_exams=mysqli_query($con,'select * from college_entrance_test where cid='.$cid.'&& type="'.$type.'" && name='.$name);
                        $exam=[];
                        $exampr=[];
                        $iter=0;
                        $examname=[];
                        foreach ($categories as $key) {
                            $exam[$iter]=$key['id'];
                            $exampr[$iter]=0;
                            $examname[$iter]=$key['name'];
                            $iter+=1;
                        }
                        $query="select department,program,intake";
                        $table_list="['Department','Intake'";
                        while($row=mysqli_fetch_assoc($college_exams))
                            {
                                for ($i=0; $i < sizeof($exam); $i++) { 
                                    if($row[$exam[$i]]!=0)
                                    {
                                        $exampr[$i]=$row[$exam[$i]];
                                        $query.=",".$exam[$i];
                                        $table_list.=",'".ucfirst($examname[$i])."'";
                                    }
                                    else
                                       $examname[$i]="";
                                }
                            }
                        $table_list.="]";
                        $query.=" from t".$cid." where program = '".$type."' && name=".$name." && ((intake != 0 || gen!=0 || sc!=0 || st!=0 || obc!=0 || rg_st!=0 || rg_sc!=0 || rg_obc!=0 || state!=0)|| (placed = 0 && min_package=0 && max_package=0 && avg_package=0)) ";
                        $closingrank=mysqli_query($con1,$query);
                        $closing_year=mysqli_fetch_assoc(mysqli_query($con,'select closing_year from college_entrance_test where cid='.$cid.'&&type="'.$type.'" && name='.$name))['closing_year'];
                        $eid=$name;
                            echo "<div class='section-sub-sub-heading' '><div class=\"col-md-2\"> Exam : </div>";
                        $exams=mysqli_query($con,"select * from allcourses");
                         $real_name_exx=mysqli_fetch_assoc(mysqli_query($con,'select name,eid from exam where eid='.$eid));
                         $real_name=$real_name_exx['name'];
                        $a="<div class=\"col-md-4\">".$real_name;
                       
                        $a.="</div>";
                         $type_exam[$real_name_exx['eid']]=1;
                        echo $a;
                        echo "<div class=\"col-md-2\"><button class=\"btn btn-success\" onclick=\"edittable('".$name."','".$type."')\">Change this exam</button></div>";
                        echo " <div class=\"col-md-4\" style='text-align: right;font-size: 0.66em;text-shadow: 0 0;min-height: 45px;'>Year : 
                            <input type=\"number\" id=\"".$type.$name."-closing-year\" min=2000 max=2020 value=".$closing_year." placeholder=".$closing_year." /></div></div>";
                        echo '<br><div class="col-md-4"><div class="edit-button" id="'.$type.$name.'-closing-rank-table-edit-btn" onclick="editTable(\''.$type.$name.'-closing-rank-table\', \''.$type.$name.'-closing-rank-table-edit-btn\', \''.$type.$name.'-closing-rank-editable\', \''.$type.$name.'-closing-rank-table-editable\','.$table_list.',1,0)">
                                            <span class="glyphicon glyphicon-pencil"></span> edit table
                                        </div></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div id="'.$type.$name.'-closing-rank-editable" style="display:none">
                                        <div class="table-responsive"><table class="table table-bordered mytable" id="'.$type.$name.'-closing-rank-table-editable">

                                            </table></div>
                                            Note : Excpet department all others column should contain <b>Only numbers</b> or data wont be saved<br>
                                              <button class="btn btn-primary btn-save closingranksave"  id="'.$type.$name.'-closing-rank-table-save-btn" onclick=" saveTable(\''.$type.$name.'-closing-rank-table\', \''.$type.$name.'-closing-rank-table-edit-btn\', \''.$type.$name.'-closing-rank-editable\', \''.$type.$name.'-closing-rank-table-editable\',1,0);saveTheTableData(\''.$type.$name.'\')">SAVE TABLE</button>
                                            <button class="btn btn-danger btn-save" id="'.$type.$name.'-closing-rank-table-cancel-btn" onclick=" cancelTable(\''.$type.$name.'-closing-rank-table\', \''.$type.$name.'-closing-rank-table-edit-btn\', \''.$type.$name.'-closing-rank-editable\', \''.$type.$name.'-closing-rank-table-editable\',1,0);">CANCEL</button>
                                            <input type="hidden" id="'.$type.$name.'-eid" value='.$name.' />
                                            <input type="hidden" id="'.$type.$name.'-type" value="'.$type.'"/>
                                        </div>
                            <div class="table-responsive"><table id="'.$type.$name.'-closing-rank-table" class="table table-bordered table-responsive mytable">';
                            echo "<tr> <td>Sl. No.</td><td>Department</td><td>Intake</td>";
                            for ($i=0; $i <sizeof($exam) ; $i++) {
                                if($examname[$i]!="")
                                {
                                    echo "<td>".ucfirst($examname[$i])."</td>";
                                }
                            }
                            echo "</tr>";
                            $rc=1;
                            while($row=mysqli_fetch_assoc($closingrank))
                            {
                                echo "<tr><td>".$rc."</td><td>".$row['department']."</td><td>".$row['intake']."</td>";
                                for ($i=0; $i <sizeof($exam) ; $i++) {
                                    if($examname[$i]!="")
                                    {
                                      if($row[$exam[$i]]!=0)
                                        echo "<td>".$row[$exam[$i]]."</td>";
                                      else
                                        echo "<td>-</td>";
                                    }
                                }
                                echo '</tr>';
                                $rc+=1;
                            }
                             echo "</table></div>";

?>