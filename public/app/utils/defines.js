define([
	'leaflet',
	'leaflet.awesome'
], function(Leaflet) {
		
		var defines = {
				types: [
						[
							[0 , "All"]
						],
						[
							[1  , "Hotel", Leaflet.AwesomeMarkers.icon({icon:'home', prefix: 'fa', markerColor: 'blue'})],
							[2  , "Hostel"],
							[3  , "Cabins"],
							[4  , "B&B"],
							[5  , "Camping"],
							[6  , "Lodging"],
							[7  , "Inn"],
							[8  , "Motel"]
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
							[19 , "Geology"],
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
							[32 , "Houses"],
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