<?php

	require("../../config.php");
	
	
	//echo hash("sha512", "anu");
	//GET ja POST muutujad
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	//value="<?=$signupEmail;?<"
	

	//MUUTUJAD
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	$signupSugu = "";
	$signupAastaError = "";
	
	//($_POST["signupEmail"])
	// on üldse olemas selline muutuja
	
	if(isset( $_POST["signupEmail"])){
		
		//jah on olemas
		// kas on tühi
		if( empty($_POST["signupEmail"])){
		
			$signupEmailError = "See väli on kohustuslik";
		
		} else {
			
			//email on olemas
			$signupEmail = $_POST["signupEmail"];
		}
	
	}
		
		if(isset( $_POST["signupPassword"])){
		

			if( empty($_POST["signupPassword"])){
			
				$signupPasswordError = "See väli on kohustuslik";
				
			}else{
				
				//siia jõuan siis kui parool oli olemas -isset
				//parool ei olnud tühi -empty
				
				if(strlen($_POST["signupPassword"]) <8 ) {
					
					$signupPasswordError = "Parool peab olema vähemalt 8 tähemärki pikk";
				
				}
			
			}
		}

	
	// Sugu
	if( isset( $_POST["signupSugu"] ) ){
		
		if(!empty( $_POST["signupSugu"] ) ){
		
			$signupSugu = $_POST["signupSugu"];
			
		}
		
	} 

	
	if(isset($_POST["signupAasta"])){
		
		if(empty($_POST["signupAasta"])){
			
			$signupAastaError = "See väli on kohustuslik";
		
		}
	}

	
	//peab olema email ja parool
	//ühtegi errorit
	
	if ( isset($_POST["signupEmail"]) && 
		isset($_POST["signupPassword"]) &&
		$signupEmailError == "" &&
		empty($signupPasswordError) 
		) {
			
		//salvestame andmebaasi
		echo "Salvestan... <br>";
		
		echo "email: ".$signupEmail."<br>";
		echo "password:".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "pasword hashed: ".$password."<br>";
		
		
		//echo $serverUsername;
		
		//ÜHENDUS
		$database = "if16_anusada_2";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
		//connect error faili koht
		
		//sql rida
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		
		//annab infot mingi kirjavea v probleemi kohta
		echo $mysqli->error;
		
		//stringina üks täht iga muutuja kohta(?), mis tüüp
		//string - s
		//integer - i
		//float (double) - d 
		//küsimärgid asendada muutujaga
		
		$stmt->bind_param("ss", $signupEmail, $password);
		
		//täida käsku
		if($stmt->execute()) {
			
			echo "salvestamine õnnestus";
			
		} else {
			echo "ERROR".$stmt->error;
		}
		
		//panen ühenduse kinni
		$stmt->close();
		$mysqli->close();
	}
			
?>



<!DOCTYPE html>
<html>
<head>
	<title>Logi sisse või loo kasutaja</title>
</head>
<body>

	<h1>Logi sisse</h1>
	<form method="POST">
		
		<input name="LoginEmail" type="text" placeholder="E-post">
		<br><br>
		
		<input type="password" name="LoginPassword" placeholder="Parool">
		<br><br>
		
		<input type="submit" value="Logi sisse">
		
	
		
	</form>
	
	<h1>Loo kasutaja</h1>
	<form method="POST">
		<label>E-post</label>
		<br>
		
		<input name="signupEmail" type="text" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
		<br>
		
		
		<label>Parool</label>
		<br>
		<input type="password" name="signupPassword"> <?php echo $signupPasswordError; ?>
		<br><br>
		
		
		<h2>Sugu</h2>
		
		<?php if($signupSugu == "Mees") { ?>
			<input type="radio" name="signupSugu" value="Mees" checked> Mees<br>
		<?php }else { ?>
			<input type="radio" name="signupSugu" value="Mees"> Mees<br>
		<?php } ?>
		
		<?php if($signupSugu == "Naine") { ?>
			<input type="radio" name="signupSugu" value="Naine" checked> Naine<br>
		<?php }else { ?>
			<input type="radio" name="signupSugu" value="Naine"> Naine<br>
		<?php } ?>
		
		<?php if($signupSugu == "Muu") { ?>
			<input type="radio" name="signupSugu" value="Muu" checked> Muu<br>
		<?php }else { ?>
			<input type="radio" name="signupSugu" value="other"> Muu<br>
		<?php } ?>
		<br><br>
	
	<h2>Sünnipäev</h2>
	<h3>Kuu</h3>
	<select>
		<option value="Jaanuar">Jaanuar</option>
		<option value="Veebruar">Veebruar</option>
		<option value="Märts">Märts</option>
		<option value="Aprill">Aprill</option>
		<option value="Mai">Mai</option>
		<option value="Juuni">Juuni</option>
		<option value="Juuli">Juuli</option>
		<option value="August">August</option>
		<option value="September">September</option>
		<option value="Oktoober">Oktoober</option>
		<option value="November">November</option>
		<option value="Detsember">Detsember</option>
	</select>
	<br>
	
		<h3>Päev</h3>
	<select>
	<option value='1'>1</option>
	<option value='2'>2</option>
	<option value='3'>3</option>
	<option value='4'>4</option>
	<option value='5'>5</option>
	<option value='6'>6</option>
	<option value='7'>7</option>
	<option value='8'>8</option>
	<option value='9'>9</option>
	<option value='10'>10</option>
	<option value='11'>11</option>
	<option value='12'>12</option>
	<option value='13'>13</option>
	<option value='14'>14</option>
	<option value='15'>15</option>
	<option value='16'>16</option>
	<option value='17'>17</option>
	<option value='18'>18</option>
	<option value='19'>19</option>
	<option value='20'>20</option>
	<option value='21'>21</option>
	<option value='22'>22</option>
	<option value='23'>23</option>
	<option value='24'>24</option>
	<option value='25'>25</option>
	<option value='26'>26</option>
	<option value='27'>27</option>
	<option value='28'>28</option>
	<option value='29'>29</option>
	<option value='30'>30</option>
	<option value='31'>31</option>
	</select>

		<h3>Aasta</h3>
		<input name="signupAasta" type="text"> <?php echo $signupAastaError; ?>
		<br><br>
		
	<input type="submit" value="Loo kasutaja">

</form>
	
</body>
</html>