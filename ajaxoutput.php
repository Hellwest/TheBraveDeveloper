<?php
include('config/connect.php');
	if (!empty($_GET['search_country'])) { // Пейджинг
		$countryName = $_GET['search_country'];
		$searchType = $_GET['search_type']; // Разделение на задания 5 и 6-7
		if ($searchType == 1) { // Считаем количество городов
			$pagination = $mysqli->query("SELECT COUNT(*) FROM `cities` WHERE `country` = '$countryName'");
		} else {
			$pagination = $mysqli->query("SELECT COUNT(*) FROM `cities` WHERE `country` LIKE '%$countryName%'");
		}
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
		if ($searchType == 1) {
			$offsetquery = $mysqli->query("SELECT city FROM `cities` WHERE `country` = '$countryName' LIMIT $offset, $rowsPerPage");
		} else {
			$offsetquery = $mysqli->query("SELECT city FROM `cities` WHERE `country` LIKE '%$countryName%' LIMIT $offset, $rowsPerPage");
		}
		while ($list = $offsetquery->fetch_object()) { // Вывод городов на страницу
			$cityName = $list->city;
			print("<div class='city' id='$cityName'><p>$cityName</p></div>");
		}
		print("</div>
			<div class='pagination'>");
		
		if ($offsetquery->num_rows != 0) { // Если есть, что выводить на страницу, то отобразить навигационные ссылки
			if ($currentPage > 1) { // Если страница не первая, показать стрелки влево
				if ($currentPage > 2) {
					echo " <a class='pagelink' href='#'><<</a> ";
				}
				$prevPage = $currentPage-1;
				echo " <a class='pagelink' href='#'><</a> ";
			}
			
			$range = 3;
			for ($i = ($currentPage - $range); $i <= (($currentPage + $range)); $i++) { // Отобразить навигационные ссылки в заданном рейндже
				if (($i > 0) && ($i <= $totalPages)) {
					if ($i == $currentPage) {
						echo " [<b><span id='currentPage'>$i</span></b>] ";
					} else {
						echo " <a class='pagelink' href='#'>$i</a> ";
					}
				}
			}
			
			if ($currentPage != $totalPages) { // Если страница не последняя, показать стрелки вправо
				$nextPage = $currentPage+1;
				echo " <a class='pagelink' href='#'>></a> ";
				if ($currentPage != $totalPages-1) {
					echo " <a class='pagelink' href='#'>>></a> ";
				}
			}
		}
	}
?>