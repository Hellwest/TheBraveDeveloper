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
<script src='scripts/jquery-3.3.1.min.js'></script>
</head>
<body>
<main>
<input autofocus type='text' name='search_country' placeholder='Введите страну'>
<div id='response'></div>
<script>
$("input[name=search_country]").on('input', function() { // AJAX Поиск
	var inputFieldContent = $("input[name=search_country]").val();
	if (inputFieldContent != '') { // Если в поле есть текст, то присвоить его переменной
		var searchQuery = inputFieldContent;
	}
	$.ajax({
		method: 'GET',
		url: 'ajaxoutput.php',
		data: {
			search_country: searchQuery,
			search_type: 2,
		},
		success: function(data) {
			$("#response").html(data);
		}
	})
});

$("#response").delegate('.pagelink', 'click', function(e) { // AJAX Навигационные ссылки (страницы)
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
			$("#response").html(data);
		}
	});
});
</script>
</main>
</body>
</html>