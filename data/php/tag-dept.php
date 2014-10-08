<?php
$q="select department from t".$cid;
	$query=mysqli_query($con1,$q);
		$q_new="UPDATE `college_department` SET `cid`=".$cid;
		while($row=mysqli_fetch_assoc($query))
		{
			$dept=$row['department'];
			$dept=strtolower($dept);
			$res=" ";
			$pos=strpos($dept,"physics");
			if($pos!==false)
				{
					$res.=" (Physics)";
					$q_new.=" ,`phy`=1";
				}
			$pos=strpos($dept,"chemistry");
			if($pos!==false)
			{
				$res.=" (Chemistry)";
				$q_new.=" ,`cham`=1";
			}
			$pos=strpos($dept,"math");
			if($pos!==false)
			{
				$res.=" (Maths)";
				$q_new.=" ,`math`=1";
			}
			$pos=strpos($dept,"pharm");
			if($pos!==false){
				$res.=" (Pharmacy)";
				$q_new.=" ,`pharm`=1";
			}
			$pos=strpos($dept,"electronics");
			if($pos!==false){
				$res.=" (Electronics)";
				$q_new.=" ,`electronic`=1";
			}
			$pos=strpos($dept,"chemical");
			if($pos!==false){
				$res.=" (Chemical)";
				$q_new.=" ,`chem`=1";
			}
			$pos=strpos($dept,"aerospace");
			if($pos!==false){
				$res.=" (Aerospace)";
				$q_new.=" ,`aero`=1";
			}
			$pos=strpos($dept,"cse");
			if($pos!==false){
				$res.=" (CSE)";
				$q_new.=" ,`cse`=1";
			}
			$pos=strpos($dept,"computer");
			if($pos!==false){
				$res.=" (CSE)";
				$q_new.=" ,`cse`=1";
			}
			$pos=strpos($dept,"civil");
			if($pos!==false){
				$res.=" (Civil)";
				$q_new.=" ,`civil`=1";
			}
			$pos=strpos($dept,"me");
			if($pos!==false)
				if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
					if(($pos+2<strlen($dept)&&!ctype_alpha($dept[$pos+2]))||$pos+2>=strlen($dept)){
				$res.=" (Mechanical)";
				$q_new.=" ,`mech`=1";
			}
			$pos=strpos($dept,"mechanical");
			if($pos!==false){
				$res.=" (Mechanical)";
				$q_new.=" ,`mech`=1";
			}
			$pos=strpos($dept,"mech");
			if($pos!==false){
				$res.=" (Mechanical)";
				$q_new.=" ,`mech`=1";
			}
			$pos=strpos($dept,"electrical");
			if($pos!==false){
				$res.=" (Electrical)";
				$q_new.=" ,`elec`=1";
			}
			$pos=strpos($dept,"information");
			if($pos!==false){
				$res.=" (Information Technology)";
				$q_new.=" ,`it`=1";
			}
			$pos=strpos($dept,"ee");
			if($pos!==false)
				if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
					if(($pos+2<strlen($dept)&&!ctype_alpha($dept[$pos+2]))||$pos+2>=strlen($dept)){
				$res.=" (Electrical)";
				$q_new.=" ,`elec`=1";
			}
			$pos=strpos($dept,"ce");
			if($pos!==false)
				if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
					if(($pos+2<strlen($dept)&&!ctype_alpha($dept[$pos+2]))||$pos+2>=strlen($dept)){
				$res.=" (civil)";
				$q_new.=" ,`civil`=1";
			}
			$pos=strpos($dept,"ec");
			if($pos!==false)
				if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
					if(($pos+2<strlen($dept)&&!ctype_alpha($dept[$pos+2]))||$pos+2>=strlen($dept)){
				$res.=" (Electrical)";
				$q_new.=" ,`elec`=1";
			}
			$pos=strpos($dept,"it");
			if($pos!==false)
				if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
					if(($pos+2<strlen($dept)&&!ctype_alpha($dept[$pos+2]))||$pos+2>=strlen($dept)){
				$res.=" (Information Technology)";
				$q_new.=" ,`it`=1";
			}
			$pos=strpos($dept,"eee");
			if($pos!==false)
				if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
					if(($pos+3<strlen($dept)&&!ctype_alpha($dept[$pos+3]))||$pos+3>=strlen($dept)){
				$res.=" (Electrical and electronics)";
				$q_new.=" ,`elec`=1 ,`electronic=1`";
			}
			$pos=strpos($dept,"ele");
			if($pos!==false)
				if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
					if(($pos+3<strlen($dept)&&!ctype_alpha($dept[$pos+3]))||$pos+3>=strlen($dept)){
				$res.=" (Electrical)";
				$q_new.=" ,`elec`=1";
			}
			$pos=strpos($dept,"ece");
			if($pos!==false)
				if(($pos!=0&&!ctype_alpha($dept[$pos-1]))||$pos==0)
					if(($pos+3<strlen($dept)&&!ctype_alpha($dept[$pos+3]))||$pos+3>=strlen($dept)){
				$res.=" (Electronics and Communication)";
				$q_new.=" ,`electronic`=1";
			}
		}
		$q_new.=" where `cid`=".$cid;
		mysqli_query($con,$q_new);
?>