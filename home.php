<?php
    //alustame sessiooni
    session_start();
    //kas on sisselogitud
    if(!isset($_SESSION["user_id"])){
        header("Location: page2.php");
    }
    //väljalogimine
    if(isset($_GET["logout"])){
        session_destroy();
        header("Location: page2.php");
    }
	
	require("page_header.php");
?>

		<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
		<p>Tere! Olen Tõnis Põld ja tulen Rakverest. Ootan väga huvitavat õppeaastat ning loodan teid näha ka järgmine aasta!</p>
		<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
		<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
		<hr>
	<ul>
        <li><a href="?logout=1">Logi välja</a></li>
			<li><a href="listfilms.php">Filmide nimekirja vaatamine</a> versioon 1</li>
			<li><a href="addfilms.php">Filmide lisamine andmebaasi</a> versioon 1</li>
		<li><a href="user_profile.php">Kasutajaprofiil</a></li>
		<li><a href="movie_relations.php">Filmi, isiku jms seoste loomine</a></li>
    </ul>
</body>
</html>
