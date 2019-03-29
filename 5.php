<!DOCTYPE html>
<html>
<head>
<title>Тестовое задание</title>
<meta charset='UTF-8'>
<link rel='stylesheet' type='text/css' href='css/styles.css'>
<script src='scripts/jquery-3.3.1.min.js'></script>
</head>
<body>
<main>
<select id='search_countryID' name='search_country'>
<?php
	include('config/connect.php');
	include('output.php');
	
	if (empty($_GET['search_country'])) { // Если страна ещё не выбрана
		print("<option hidden value='notchosen'>Выберите страну</option>");
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
<input id='submitsearch' type='submit' value='Поиск'>
<div id='response'></div>
<script>
$("#submitsearch").on('click', function() { // AJAX Поиск
	if ($("#search_countryID").val() != "notchosen") { // Если страна выбрана, то присвоить переменной значение
		var searchQuery = $("#search_countryID").val();
	}
	$.ajax({
		method: 'GET',
		url: 'ajaxoutput.php',
		data: {
			search_country: searchQuery,
			search_type: 1,
		},
		success: function(data) {
			$("#response").html(data);
		}
	})
});

$("#response").delegate('.pagelink', 'click', function(e) { // AJAX Навигационные ссылки (страницы)
	e.preventDefault(); // Чтобы не скроллило вверх при нажатии
	var searchQuery = $("#search_countryID").val();
	var currentPage = $("#currentPage").text();
	var neededPage = $(this).text();
	if (isNaN(neededPage)) { // Для стрелочек
		if (neededPage=='>') {
			neededPage = parseInt(currentPage) + 1;
		};
		if (neededPage=='<') {
			neededPage = parseInt(currentPage) - 1;
		};
		if (neededPage=='>>') {
			neededPage = parseInt(currentPage) + 100;
		};
		if (neededPage=='<<') {
			neededPage = parseInt(currentPage) - 100;
		};
	}
	
	$.ajax({ // AJAX-запрос на переход по страницам
		method: 'GET',
		url: 'ajaxoutput.php?search_country=' + searchQuery + '&currentPage=' + neededPage,
		data: {
			search_type: 1,
		},
		success: function(data) {
			$("#response").html(data);
		}
	});
});
</script>
</main>
</body>
</html>