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
<?php
	include('config/connect.php');
	
	if (empty($_GET['search_country'])) { // Если страна ещё не выбрана
		print("<input autofocus type='text' name='search_country' placeholder='Введите страну'> ");
	} else { // Если страну уже выбрали
		$countryName = $_GET['search_country'];
		print("<input autofocus type='text' name='search_country' value='$countryName' placeholder='Введите страну'> ");
	}
?>
<input type='submit' value='Поиск'>
</form>
<?php
	if (!empty($_GET['search_country'])) { // Пейджинг
		$pagination = $mysqli->query("SELECT COUNT(*) FROM `cities` WHERE `country` LIKE '%$countryName%'"); // Считаем количество городов
		$r = $pagination->fetch_row();
		$numRows = $r[0];
		
		$rowsPerPage = 5;
		$totalPages = ceil($numRows/$rowsPerPage);
		
		if (isset($_GET['currentPage']) && is_numeric($_GET['currentPage'])) {
			$currentPage = (int) $_GET['currentPage'];
		} else {
			$currentPage = 1;
		}
		
		if ($currentPage > $totalPages) { // Если номер страницы больше количества страниц
			$currentPage = $totalPages;
		}
		
		if ($currentPage < 1) { // Если номер страницы меньше 1
			$currentPage = 1;
		}
		
		$offset = ($currentPage-1)*$rowsPerPage; // Выборка на страницу
		$offsetquery = $mysqli->query("SELECT city, country FROM cities WHERE country LIKE '%$countryName%' LIMIT $offset, $rowsPerPage");
		while ($list = $offsetquery->fetch_assoc()) { // Вывод городов на страницу
			$cityName = $list['city'];
			$countryOfCity = $list['country'];
			print("<div><p>$cityName, $countryOfCity</p></div>");
		}
		
		if ($offsetquery->num_rows != 0) { // Если есть, что выводить на страницу, то отобразить навигационные ссылки
			if ($currentPage > 1) { // Если страница не первая, показать стрелки влево
				if ($currentPage > 2) {
					echo " <a href='{$_SERVER['PHP_SELF']}?search_country=$countryName&currentPage=1'><<</a> ";
				}
				$prevPage = $currentPage-1;
				echo " <a href='{$_SERVER['PHP_SELF']}?search_country=$countryName&currentPage=$prevPage'><</a> ";
			}
			
			$range = 3;
			for ($i = ($currentPage - $range); $i <= (($currentPage + $range)); $i++) { // Отобразить навигационные ссылки в заданном рейндже
				if (($i > 0) && ($i <= $totalPages)) {
					if ($i == $currentPage) {
						echo " [<b>$i</b>] ";
					} else {
						echo " <a href='{$_SERVER['PHP_SELF']}?search_country=$countryName&currentPage=$i'>$i</a> ";
					}
				}
			}
			
			if ($currentPage != $totalPages) { // Если страница не последняя, показать стрелки вправо
				$nextPage = $currentPage+1;
				echo " <a href='{$_SERVER['PHP_SELF']}?search_country=$countryName&currentPage=$nextPage'>></a> ";
				if ($currentPage != $totalPages-1) {
					echo " <a href='{$_SERVER['PHP_SELF']}?search_country=$countryName&currentPage=$totalPages'>>></a> ";
				}
			}
		}
	}
?>
</main>
</body>
</html>