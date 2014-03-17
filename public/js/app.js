
$(document).ready(function(){
	
	var h = $(window).height();
	var hsearch = ($(".search").height() + 40); // 40 for margin
	$("#mapView").css("height", (h - hsearch - 50) + "px"); // 50 for header
		
	$(window).resize(function() {
		var h = $(window).height();
		var hsearch = ($(".search").height() + 40); // 40 for margin
		$("#mapView").css("height", (h - hsearch - 50) + "px");
	});

	

	var map = L.map('mapView', {
			center 	: [-41.327463, -72.974466],
			zoom 	: 10
		});

	L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);


/*
	L.marker([51.5, -0.09]).addTo(map)
		.bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();
*/	

	$(".raty").raty({readOnly: true, score : 3.3});

});