<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="icon" href="favico.ico" type="image/x-icon">
		<link rel="shortcut icon" type="image/x-icon" href="/favico.ico"/>
<title>Framingham心血管疾病風險預測結果</title>
	<style type="text/css">
		.nor{
			color:#000000;
		}
		.p3{
			background-color:#F2CE6B;
			width:500px;
			height:700px;
			text-align:center;
			border-radius: 40px;
			margin:0 auto;
		}	
	</style>
</head>
<?php require("header.php"); ?>
<body style="background-color:#BCECFF">
	<div class="p3"><img src="logo.png" width="60" height="60" alt=""/>
<font size="6">Framingham風險預測結果</font><br>
<hr style="border: 1px solid ;">

	
<?php
	
	
	//主程式
	echo '你的性別是: ';
	switch($_REQUEST['SexGroup']){
	case('1'):
	$sex = 1;
	$gender='男生';
	break;
	case('2'):
	$gender='女生';
	$sex = 0;
	break;
	}
	echo $gender . '<br>';
	echo '你的年齡是: '.$_REQUEST['age']. '<br>';
	$age=$_REQUEST['age'];
	echo '你的舒張壓是: '.$_REQUEST['blood_press1']. '<br>';
	$blood1 = $_REQUEST['blood_press1'];
	echo '你的收縮壓是: '.$_REQUEST['blood_press2']. '<br>';
	$blood2 = $_REQUEST['blood_press2'];
	if(isset($_REQUEST['high_blood'])){
	echo '有使用高血壓藥物' . '<br>';
	}
	else{
	echo '無使用高血壓藥物' . '<br>';
	}
	if(isset($_REQUEST['smoke'])){
		$smoke = 1;	
	echo '有抽菸' . '<br>';
	}
	else{
		$smoke = 0;	
	echo '無抽菸' . '<br>';
	}
	if(isset($_REQUEST['sugar'])){
		$diabates = 1;
	echo '有糖尿病' . '<br>';
	}
	else{
		$diabates = 0;
	echo '無糖尿病' . '<br>';
	}
	echo '你的高密度膽固醇是: '.$_REQUEST['hdl']. '<br>';
	$hdl = $_REQUEST['hdl'];
	echo '你的總膽固醇是: '.$_REQUEST['tdl']. '<br>';
	$tdl = $_REQUEST['tdl'];
	?> 
	<?php
	$age_score				=age_gender($age,$sex);
	$blood_score			=blood_score((int)$blood1,(int)$blood2,$sex);
	$hdl_score				=hdl_score($hdl,$sex);
	$tdl_score				=tdl_score($tdl,$sex);
	$diabates_score			=diabates_score($diabates,$sex);
	$smoke_score			=smoke_score($smoke,$sex);
	$total_score			=$age_score+$blood_score+$hdl_score+$tdl_score+$diabates_score+$smoke_score;
	$total_risk				=risk_score($total_score,$sex);
	  ?> 
<h>----------------------------------------<br></h>  
	<h>你的年齡分數是:<?php echo $age_score ?><br></h>  
	<h>你的血壓分數是:<?php echo $blood_score ?><br></h>  
	<h>你的hdl分數是:<?php echo $hdl_score ?><br></h>  
	<h>你的tdl分數是:<?php echo $tdl_score ?><br></h>  
	<h>你的糖尿病分數是:<?php echo $diabates_score ?><br></h>  
	<h>你的抽菸分數是:<?php echo $smoke_score ?><br></h>  
	<h>你的總分數是:<?php echo $total_score ?><br></h> 
	<h>----------------------------------------<br></h> 
	
	<h2>你的心血管風險是:<p id="p2"><?php echo $total_risk ?> %</p> </h2>
	<h3 id=p1></h3>
	<script>
		var num = <?php echo $total_risk ?>; //接收php變數
		if(num>20){
			document.getElementById("p2").style.color="red";
			document.getElementById("p2").style.fontSize="x-larger";
			document.getElementById("p1").innerHTML='高度風險!';
		}
		if(num<=20 && num>=10){
			document.getElementById("p2").style.fontSize="x-larger";
			document.getElementById("p1").innerHTML='中度風險';
		}
		if(num<10){
			document.getElementById("p2").style.color="green";
			document.getElementById("p2").style.fontSize="x-larger";
			document.getElementById("p1").innerHTML='低度風險';
		}
</script>
	<?php
	

	//年齡分數
	function age_gender($age,$sex){
		$age_score=0;
		$age_m_score = [-1,0,1,2,3,4,5,6,7];
		$age_w_score = [-9,-4,0,3,6,7,8,8,8];
	
	
	if($age <=34) {$age_index = 0;}	
	if($age >=35 && $age <=39) {$age_index = 1;}
	if($age >=40 && $age <=44) {$age_index = 2;}
	if($age >=45 && $age <=49) {$age_index = 3;}
	if($age >=50 && $age <=54) {$age_index = 4;}
	if($age >=55 && $age <=59) {$age_index = 5;}
	if($age >=60 && $age <=64) {$age_index = 6;}
	if($age >=65 && $age <=69) {$age_index = 7;}
	if($age >=70) 			   {$age_index = 8;}
	
	if($sex ==1) { return $age_m_score[$age_index];}
		else{ return $age_w_score[$age_index];}
	}
	
	//血壓分數
	function blood_score($blood1,$blood2,$sex){
		//男生分數
		
		$mblood_score1 = array(0,0,1,2,3);
		$mblood_score2 = array(0,0,1,2,3);
		$mblood_score3 = array(1,1,1,2,3);
		$mblood_score4 = array(2,2,2,2,3);
		$mblood_score5 = array(3,3,3,3,3);
		$mblood_score = array($mblood_score1,$mblood_score2,$mblood_score3,$mblood_score4,$mblood_score5);
		
		//女生分數
		
		$wblood_score1 = array(-3,0,0,2,3);
		$wblood_score2 = array(0,0,0,2,3);
		$wblood_score3 = array(0,0,0,2,3);
		$wblood_score4 = array(2,2,2,2,3);
		$wblood_score5 = array(3,3,3,3,3);
		$wblood_score = array($wblood_score1,$wblood_score2,$wblood_score3,$wblood_score4,$wblood_score5);
		
		//文字索引
		$col_array=array("79"=>0, "85"=>1, "88"=>2, "95"=>3, "101"=>4);
		$row_array=array("110"=>0, "125"=>1, "135"=>2, "145"=>3, "165"=>4);
		
		$blood_col_index = $col_array[$blood1]; //舒張
		$blood_row_index = $row_array[$blood2]; //收縮
		if($sex ==1){
				return $mblood_score[$blood_row_index][$blood_col_index];
		}
			else{
				return $wblood_score[$blood_row_index][$blood_col_index];
			}
	}	
	
	//hdl分數
	function hdl_score($hdl,$sex){
		
		$hdl_m_score = [2,1,0,0,-2];
		$hdl_w_score = [5,2,1,0,3];
	
	
	if($hdl <=35) {$hdl_index = 0;}	
	if($hdl >=35 && $hdl <=44) {$hdl_index = 1;}
	if($hdl >=45 && $hdl <=49) {$hdl_index = 2;}
	if($hdl >=50 && $hdl <=59) {$hdl_index = 3;}
	if($hdl >=60) 			   {$hdl_index = 4;}
	
	if($sex ==1) { return $hdl_m_score[$hdl_index];}
		else{ return $hdl_w_score[$hdl_index];}
		
	}
	
	//tdl分數
	function tdl_score($tdl,$sex){
		
		$tdl_m_score = [-3,0,1,2,3];
		$tdl_w_score = [-2,0,1,2,3];
	
	
	if($tdl <=160) {$tdl_index = 0;}	
	if($tdl >=160 && $tdl <=199) {$tdl_index = 1;}
	if($tdl >=200 && $tdl <=239) {$tdl_index = 2;}
	if($tdl >=240 && $tdl <=279) {$tdl_index = 3;}
	if($tdl >=280) 			   {$tdl_index = 4;}
	
	if($sex ==1) { return $tdl_m_score[$tdl_index];}
		else{ return $tdl_w_score[$tdl_index];}
		
	}
	
	//有無糖尿病
	function diabates_score($diabates,$sex){
		if($sex=1){
			if($diabates==1){
				return 2;
			} else{
				return 0;
			}
		}
		if($sex=0){
			if($diabates==1){
				return 4;
			} else{
				return 0;
			}
		}
	}
	
	//有無抽菸
	function smoke_score($smoke,$sex){
		if($sex=1){
			if($smoke==1){
				return 2;
			} else{
				return 0;
			}
		}
		if($sex=0){
			if($smoke==1){
				return 2;
			} else{
				return 0;
			}
		}
	}
	
	//風險
	function risk_score($total_score,$sex){
	if($sex ==1){
		if($total_score<0){ return 2;}
		if($total_score==0){ return 3;}
		if($total_score==1){ return 3;}
		if($total_score==2){ return 4;}
		if($total_score==3){ return 5;}
		if($total_score==4){ return 7;}
		if($total_score==5){ return 8;}
		if($total_score==6){ return 10;}
		if($total_score==7){ return 13;}
		if($total_score==8){ return 16;}
		if($total_score==9){ return 20;}
		if($total_score==10){ return 25;}
		if($total_score==11){ return 31;}
		if($total_score==12){ return 37;}
		if($total_score==13){ return 45;}
		if($total_score>13){ return 53;}
		
		}
	if($sex ==0){
		if($total_score<-1){ return 1;}
		if($total_score==-1){ return 2;}
		if($total_score==0){ return 2;}
		if($total_score==1){ return 2;}
		if($total_score==2){ return 3;}
		if($total_score==3){ return 3;}
		if($total_score==4){ return 4;}
		if($total_score==5){ return 4;}
		if($total_score==6){ return 5;}
		if($total_score==7){ return 6;}
		if($total_score==8){ return 4;}
		if($total_score==9){ return 8;}
		if($total_score==10){ return 10;}
		if($total_score==11){ return 11;}
		if($total_score==12){ return 13;}
		if($total_score==13){ return 15;}
		if($total_score==14){ return 18;}
		if($total_score==15){ return 20;}
		if($total_score==16){ return 24;}
		if($total_score>16){ return 27;}
		
		}
	}
	
	
?> 
		
</div>	
 
</body>
<?php require("footer.php"); ?>	
</html>
