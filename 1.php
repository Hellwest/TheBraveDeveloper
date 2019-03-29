<!DOCTYPE html>
<html>
<head>
<title>Тестовое задание</title>
<meta charset='UTF-8'>
<link rel='stylesheet' type='text/css' href="css/styles.css">
</head>
<body>
<main>
<?php
	include('config/connect.php');
	
	$selectCountries = $mysqli->query("SELECT * FROM `countries` ORDER BY countryid");
	while ($country = $selectCountries->fetch_object()) {
		$countryName = $country->CountryName;
		print("<div><p>$countryName</p></div>");
	}
?>
</main>
</body>
</html>