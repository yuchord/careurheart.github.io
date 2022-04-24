
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
<title>心血管疾病風險預測</title>
	<link rel="icon" href="favico.ico" type="image/x-icon">
		<link rel="shortcut icon" type="image/x-icon" href="/favico.ico"/>
<style type="text/css">
	.s{
		background-color:#BCECFF;
	}
	.p3{
			background-color:#F2CE6B;
			width:600px;
			height:700px;
			text-align:center;
			border-radius: 40px;
			margin:0 auto;
		}	
	.p4
	{width="459";
		
margin-left:auto; 
margin-right:auto;
	}
</style>
	
		<?php require("header.php"); ?>
</head>

<body class="s">
<div class="p3">
<pre ></span>
<span class="auto-style1"><img src="logo.png" width="60" height="60" alt=""/><font size="5">Framingham心血管疾病風險預測</font><br>Cardiovascular Disease<br></span></pre>
<form action="result.php" method="post" name="form1" id="form1">
  <table class="p4" >
    <tbody>
      <tr>
        <td style="width: 6776px">危險因子</td>
        <td style="width: 2635px">單位</td>
        <td style="width: 751px">資料</td>
      </tr>
      <tr>
        <td style="width: 6776px;background-color:skyblue">性別<br>
        gender<br></td>
        <td style="width: 2635px;background-color:skyblue">&nbsp;</td>
        <td style="width: 751px;background-color:skyblue"><p>
          <label >
            <input type="radio" name="SexGroup" value="1" checked>男/male</label>
          <label>
            <input type="radio" name="SexGroup" value="2">女/female</label>
          <br>
        </p></td>
      </tr>
      <tr>
        <td style="width: 6776px">年齡<br>
        age<br></td>
        <td style="width: 2635px">歲</td>
        <td style="width: 751px">
          <select name="age" id="age">
          <?php 
          for ($i=10;$i<=99;$i++){
           echo'<option value="'.$i.'">'.$i.'</option>';
          }
          ?>
		  </select></td>
      </tr>
      <tr>
        <td style="width: 6776px;background-color:skyblue">舒張壓 <br>diastolic pressure</td>
        <td style="width: 2635px;background-color:skyblue"> mmHg</td>
        <td style="width: 751px;background-color:skyblue">
        	<select name="blood_press1" id="blood_press1se1">
       <?php
        	$blood_range1 = ['小於80'=>79,'80~84'=>85,'85~89'=>88,'90~99'=>95,'100以上'=>101];
        	foreach($blood_range1 as $key=>$value){
        	 echo'<option value="',$value,'">',$key,'</option>';
        	 }

        	?>
        	</select></td>

      </tr>  
		<tr>
        <td style="width: 6776px">收縮壓<br>
		    systolic pressure</td>
		  <td style="width: 2635px">mmHg
		    		    
		  </td>
		<td style="width: 751px">
			<select name="blood_press2" id="blood_press1se2">
        	
        	 	<?php
        	$blood_range2 = ['小於120'=>110,'120~129'=>125,'130~139'=>135,'140~159'=>145,'160以上'=>165];
        	foreach($blood_range2 as $key=>$value){
        	 echo'<option value="',$value,'">',$key,'</option>';
        	 }

        	?>
       </select></td>

      </tr>
      <tr>
        <td style="width: 6776px;background-color:skyblue">使用高血壓藥物<br>
        antihypertensive agents<br></td>
        <td style="width: 2635px;background-color:skyblue">&nbsp;</td>
        <td style="width: 751px;background-color:skyblue"><input type="checkbox" name="high_blood">
        有/yes</td>
      </tr>
      <tr>
        <td style="width: 6800px">抽菸<br>
        smoking<br></td>
        <td style="width: 2635px">&nbsp;</td>
        <td style="width: 751px"><input type="checkbox" name="smoke">有/yes</td>
      </tr>
      <tr>
        <td style="width: 6776px;background-color:skyblue">
          糖尿病<br>
          diabetes<br>         
	    </td>
        <td style="width: 2635px;background-color:skyblue">&nbsp;</td>
        <td style="width: 751px;background-color:skyblue"><input type="checkbox" name="sugar">
        有/yes</td>
      </tr>
      <tr>
        <td style="width: 6776px">高密度膽固醇<br>
        high-density lipoprotein<br></td>
        <td style="width: 2635px">mg/dl</td>
        <td style="width: 751px"><select name="hdl" id="hdl">
			
       <?php
        	$hdl = ['小於35'=>20,'35~44'=>40,'45~49'=>48,'50~59'=>55,'60以上'=>70];
        	foreach($hdl as $key=>$value){
        	 echo'<option value="',$value,'">',$key,'</option>';
        	 }

        	?>
        	</select></td>
      </tr>
      <tr>
        <td style="width: 6776px;background-color:skyblue">總膽固醇<br>
        total lipoprotein<br></td>
        <td style="width: 2635px;background-color:skyblue">mg/dl</td>
        <td style="width: 751px;background-color:skyblue"><select name="tdl" id="tdl">
			 <?php
        	$tdl = ['小於160'=>150,'160~199'=>165,'200~239'=>220,'240~279'=>260,'279以上'=>280];
        	foreach($tdl as $key=>$value){
        	 echo'<option value="',$value,'">',$key,'</option>';
        	 }

        	?>
        	</select></td>
      </tr>
    </tbody>
  </table>
	<br>
  <p>
    <input type="submit" name="submit" id="submit" value="送出">
    <input type="reset" name="reset" id="reset" value="重設">
	 
  </p>
</form>
<p>&nbsp;</p>
	</div>	
	<?php require("footer.php"); ?>	
	
</body>
	
</html>