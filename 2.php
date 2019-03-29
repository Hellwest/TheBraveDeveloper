<!DOCTYPE html>
<html>
<head>
<title>Тестовое задание</title>
<meta charset='UTF-8'>
<link rel='stylesheet' type='text/css' href='css/styles.css'>
</head>
<body>
<main>
<form method='GET'>
<select name='search_country'>
<?php
	include('config/connect.php');
	
	if (empty($_GET['search_country'])) { // Если страна ещё не выбрана
		print("<option hidden>Выберите страну</option>");
	} else { // Если страну уже выбрали
		$countryName = $_GET['search_country'];
		print("<option hidden>$countryName</option>");
	}
	
	$selectCountries = $mysqli->query("SELECT * FROM `countries` ORDER BY countryid");
	while ($country = $selectCountries->fetch_object()) { // Вывод стран в select
		$countrySelect = $country->CountryName;
		print("<option value='$countrySelect'>$countrySelect</option>");
	}
?>
</select>
<input type='submit' value='Поиск'>
</form>
<?php
	if (!empty($_GET['search_country'])) {
		$cities = $mysqli->query("SELECT * FROM `cities` WHERE `country` = '$countryName'");
		while ($city = $cities->fetch_object()) { // Вывод городов
			$cityName = $city->city;
			print("<div><p>$cityName</p></div>");
		}
	}
?>
</main>
</body>
</html>