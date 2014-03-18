define([
	'leaflet',
	'leaflet.awesome'
], function(Leaflet) {
		
		var defines = {
				map : {
					container	: "mapView",
					zoom 		: 10,
					Lat 		: -41.243877,
					Lng 		: -73.014291,
					layerURL	: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
					copy		: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
				},
				opacity : {
					high	:	1,
					low 	:	0.5
				},
				types: [
						[
							[0 , "All"]
						],
						[
							[1  , "Hotel"		, Leaflet.AwesomeMarkers.icon({icon:'home', prefix: 'fa', markerColor: 'blue'})],
							[2  , "Hostel"		, Leaflet.AwesomeMarkers.icon({icon:'home', prefix: 'fa', markerColor: 'blue'})],
							[3  , "Cabins"		, Leaflet.AwesomeMarkers.icon({icon:'home', prefix: 'fa', markerColor: 'blue'})],
							[4  , "B&B"			, Leaflet.AwesomeMarkers.icon({icon:'home', prefix: 'fa', markerColor: 'blue'})],
							[5  , "Camping"		, Leaflet.AwesomeMarkers.icon({icon:'home', prefix: 'fa', markerColor: 'blue'})],
							[6  , "Lodging"		, Leaflet.AwesomeMarkers.icon({icon:'home', prefix: 'fa', markerColor: 'blue'})],
							[7  , "Inn"			, Leaflet.AwesomeMarkers.icon({icon:'home', prefix: 'fa', markerColor: 'blue'})],
							[8  , "Motel"		, Leaflet.AwesomeMarkers.icon({icon:'home', prefix: 'fa', markerColor: 'blue'})]
						],
						[
							[9  , "Restaurant", Leaflet.AwesomeMarkers.icon({icon:'cutlery', prefix: 'fa', markerColor: 'red'})],
							[10 , "Café"],
							[11 , "Sandwich Shop"]
						],
						[
							[12 , "Theatre"],
							[13 , "Museum"],
							[14 , "Cinema", Leaflet.AwesomeMarkers.icon({icon:'film', prefix: 'fa', markerColor: 'orange'})],
							[15 , "Events"]
						],
						[
							[16 , "Flora"],
							[17 , "Fauna"],
							[18 , "Birds"],
							[19 , "Geology", Leaflet.AwesomeMarkers.icon({icon:'leaf', prefix: 'fa', markerColor: 'green'})],
							[20 , "Beaches"]
						],
						[
							[21 , "Rafting"],
							[22 , "Canopy"],
							[23 , "Horse Riding"],
							[24 , "Lodge"],
							[25 , "Guides"]
						],
						[
							[26 , "Casino"],
							[27 , "Night Club"],
							[28 , "Rodeo"],
							[29 , "Events Centre"],
							[30 , "SPA"]
						],
						[
							[31 , "Terrains"],
							[32 , "Houses", Leaflet.AwesomeMarkers.icon({icon:'home', prefix: 'fa', markerColor: 'purple'})],
							[33 , "Premises"]
						],
						[
							[34 , "Souvenirs"],
							[35 , "Knitwear"],
							[36 , "Food"],
							[37 , "Beer"]
						]
					]
		};

		return defines;
	}
);