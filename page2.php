<?php
	$author_name = "Tõnis Põld";
	
	//kontrollin, kas POST info jõuab kuhugi
	//var_dump($_POST);
	//kontrollime, kas klikiti submit nuppu
	$todays_adjective_html = null; //$todays_adjective_html = "";
	$todays_adjective_error = null;
	$todays_adjective = null;
	if(isset($_POST["adjective_submit"])) {
		//echo "Klikiti!";
		//<p> Tänane päev on tuuline.</p>
		//kontrollime, kas midagi kirjutati ka
		if(!empty($_POST["todays_adjective_input"])) {
			$todays_adjective_html = "<p>Tänane päev on " .$_POST["todays_adjective_input"] .".</p>";
			$todays_adjective = $_POST["todays_adjective_input"];
		} else {
			$todays_adjective_error = "Palun sisesta tänase kohta sobiv omadussõna!";
		}
	}
	
	
	//juhusliku foto lisamine
	$photo_dir = "photos/";
	//loen kataloogi sisu
	$all_files = array_slice(scandir($photo_dir), 2);
	
	//sõelume välja päris pildid
	$photo_files = [];
	$allowed_photo_types = ["image/jpeg", "image/png"];
	foreach($all_files as $file_name){
		$file_info = getimagesize($photo_dir .$file_name);
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($photo_files, $file_name);
			}
		}
	}
	

	//echo $all_files;
	//var_dump($all_real_files);
	//loen massiivi elemendid kokku
	$file_count = count($photo_files);
	//loosin juhusliku arvu (min peab olema 0 ja max count - 1)
	$photo_num = mt_rand(0, $file_count - 1);
	//<img src="kataloog/fail" alt="Tallinna Ülikool">
	
	if(isset($_POST["photo_select_submit"])){
		$photo_num = $_POST["photo_select"];
	}
	
	
	$photo_html = '<img src="' .$photo_dir .$photo_files[$photo_num] .'" alt="Tallinna Ülikool">';
	$photo_file_html = "\n <p>".$photo_files[$photo_num] ."</p> \n";
	$photo_list_html = "\n <ul> \n";
	
	//tsükkel
	//näiteks:
	//<ul>
	//		<li>pildifailinimi1.jpg</li>
	//		<li>pildifailinimi1.jpg</li>
	//		<li>pildifailinimi1.jpg</li>
	//		...
	//</ul>
	
	for($i = 0;$i < $file_count;$i ++) {
		$photo_list_html .= "<li>" .$photo_files[$i] ."</li> \n";
	}
	$photo_list_html .= "</ul> \n";
	
	$photo_select_html = "\n" .'<select name="photo_select">' ."\n";
	for($i = 0;$i < $file_count;$i ++) {
		$photo_select_html .= '<option value="' .$i .'">';
		if($i == $photo_num){
			$photo_select_html .= " selected";
		}
		$photo_select_html .= '>' .$photo_files[$i] ."</option> \n";
	}
	$photo_select_html .= "</select> \n";
	
?>
<!DOCTYPE html>
<html lang="et">
<head>
<meta charset="utf-8">
	<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
	<p>Tere! Olen Tõnis Põld ja tulen Rakverest. Ootan väga huvitavat õppeaastat ning loodan teid näha ka järgmine aasta!</p>
	<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<hr>
	<form method="POST">
		<input type="text" placeholder="omadussõna tänase kohta" name="todays_adjective_input" value="<?php echo $todays_adjective; ?>">
		<input type="submit" name="adjective_submit" value="Saada">
		<span><?php echo $todays_adjective_error; ?></span>
	</form>
	<?php echo $todays_adjective_html; ?>
	<hr>
	<form method="POST">
		<?php echo $photo_select_html; ?>
		<input type="submit" name="photo_select_submit" value="Näita">
	</form>
	
	<?php
		echo $photo_html;
		echo $photo_file_html;
		echo "<hr> \n";
		echo $photo_list_html;
	?>

</body>
</html>