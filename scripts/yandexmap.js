var myMap, cityClusterer;

function getCitiesNames() { // Функция — получить названия выведенных городов, чтобы потом использовать их в картах
		console.log(cityClusterer.getGeoObjects());
		cityClusterer.removeAll();
		var markersArray = [];
		$("#response").children(".city").each(function() {
			markersArray.push($(this).attr("id"));
		});
		return markersArray;
	}
	
function addCityToMap(cityName) {
	ymaps.geocode(cityName, {
		kind: 'locality',
		results: 1
	}).then(function(res) {
		var firstGeoObject = res.geoObjects.get(0),
			coords = firstGeoObject.geometry.getCoordinates(),
			bounds = firstGeoObject.properties.get('boundedBy');
		cityClusterer.add(firstGeoObject);
		myMap.setBounds(cityClusterer.getBounds(), {
			checkZoomRange: true
		});
	});
}

$(document).ready(function() {
	ymaps.ready(function() {
		myMap = new ymaps.Map('map', {
			center: [56.85237874, 53.20274950],
			zoom: 2
		});
		cityClusterer = new ymaps.Clusterer({
			clusterDisableClickZoom: true,
			clusterHideIconOnBalloonOpen: false,
			geoObjectHideBalloononOpen: false,
			hasBalloon: false
		});
	});
});