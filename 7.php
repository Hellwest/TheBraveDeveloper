<?php
	include('config/connect.php');
	include('ajaxoutput.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Тестовое задание</title>
<meta charset='UTF-8'>
<link rel='stylesheet' type='text/css' href='css/styles.css'>
<script src='scripts/jquery-3.3.1.min.js' type='text/javascript'></script>
<script src='https://api-maps.yandex.ru/2.1/?load=package.full&apikey=8d2c7d9b-3d4a-4cc1-9a58-21193b2a3595&lang=ru_RU' type='text/javascript'></script>
<script src='scripts/yandexmap.js' type='text/javascript'></script>
</head>
<body>
<main>
<input autofocus type='text' name='search_country' placeholder='Введите страну'>
<div id='response'></div>
<div id='map'>
</div>
<script>
function atAjaxSuccess(data) { // При получении ответа AJAX вывести данные на экран и установить метки на карте
	$("#response").html(data);
	var markersArray = getCitiesNames();
	myMap.geoObjects.removeAll();
	for (var i=0; i<markersArray.length; i++) {
		addCityToMap(markersArray[i]);
	};
	myMap.geoObjects.add(cityClusterer);
}

$(document).ready(function() {
	$("input[name=search_country]").on('input', function() { // AJAX Поиск
		var inputFieldContent = $("input[name=search_country]").val();
		if (inputFieldContent != '') { // Если в поле есть текст, то присвоить его переменной
			var searchQuery = inputFieldContent;
		};
		$.ajax({
			method: 'GET',
			url: 'ajaxoutput.php',
			data: {
				search_country: searchQuery,
				search_type: 2,
			},
			success: function(data) {
				atAjaxSuccess(data);
			}
		});
	});

	$("#response").delegate('.pagelink', 'click', function(e) { // AJAX — приготовить навигационные ссылки (страницы)
		e.preventDefault(); // Чтобы не скроллило вверх при нажатии
		var searchQuery = $("input[name=search_country]").val();
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
			url: 'ajaxoutput.php?select_country=' + searchQuery + '&currentPage=' + neededPage,
			data: {
				search_country: searchQuery,
				search_type: 2,
			},
			success: function(data) {
				atAjaxSuccess(data);
			}
		});
	});
});
</script>
</main>
</body>
</html>