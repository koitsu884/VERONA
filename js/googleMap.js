var map;
function initialize() {
	var location = new google.maps.LatLng(-40.357337,175.60838);
	var mapOptions = {
		zoom: 14,
		center: location,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map'),mapOptions);
	  
	var marker = new google.maps.Marker({
		position: location,
		map: map,
		title: 'We are here'
	});
}

google.maps.event.addDomListener(window, 'load', initialize);