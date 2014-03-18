define(function() {
		
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
							[1  , "Hotel"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[2  , "Hostel"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[3  , "Cabins"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[4  , "B&B"				, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[5  , "Camping"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[6  , "Lodging"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[7  , "Inn"				, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[8  , "Motel"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}]
						],
						[
							[9  , "Restaurant"		, {icon:'cutlery', prefix: 'fa', markerColor: 'red'}],
							[10 , "Café"			, {icon:'coffee', prefix: 'fa', markerColor: 'red'}],
							[11 , "Sandwich Shop"	, {icon:'cutlery', prefix: 'fa', markerColor: 'red'}]
						],
						[
							[12 , "Theatre"			, {icon:'film', prefix: 'fa', markerColor: 'orange'}],
							[13 , "Museum"			, {icon:'film', prefix: 'fa', markerColor: 'orange'}],
							[14 , "Cinema"			, {icon:'film', prefix: 'fa', markerColor: 'orange'}],
							[15 , "Events"			, {icon:'film', prefix: 'fa', markerColor: 'orange'}]
						],
						[
							[16 , "Flora"			, {icon:'leaf', prefix: 'fa', markerColor: 'green'}],
							[17 , "Fauna"			, {icon:'leaf', prefix: 'fa', markerColor: 'green'}],
							[18 , "Birds"			, {icon:'leaf', prefix: 'fa', markerColor: 'green'}],
							[19 , "Geology"			, {icon:'leaf', prefix: 'fa', markerColor: 'green'}],
							[20 , "Beaches"]
						],
						[
							[21 , "Rafting"			, {icon:'globe', prefix: 'fa', markerColor: 'lightred'}],
							[22 , "Canopy"			, {icon:'globe', prefix: 'fa', markerColor: 'lightred'}],
							[23 , "Horse Riding"	, {icon:'globe', prefix: 'fa', markerColor: 'lightred'}],
							[24 , "Lodge"			, {icon:'globe', prefix: 'fa', markerColor: 'lightred'}],
							[25 , "Guides"			, {icon:'globe', prefix: 'fa', markerColor: 'lightred'}]
						],
						[
							[26 , "Casino"			, {icon:'glass', prefix: 'fa', markerColor: 'gray'}],
							[27 , "Night Club"		, {icon:'glass', prefix: 'fa', markerColor: 'gray'}],
							[28 , "Rodeo"			, {icon:'glass', prefix: 'fa', markerColor: 'gray'}],
							[29 , "Events Centre"	, {icon:'glass', prefix: 'fa', markerColor: 'gray'}],
							[30 , "SPA"				, {icon:'glass', prefix: 'fa', markerColor: 'gray'}]
						],
						[
							[31 , "Terrains"		, {icon:'home', prefix: 'fa', markerColor: 'purple'}],
							[32 , "Houses"			, {icon:'home', prefix: 'fa', markerColor: 'purple'}],
							[33 , "Premises"		, {icon:'home', prefix: 'fa', markerColor: 'purple'}]
						],
						[
							[34 , "Souvenirs"		, {icon:'picture-o', prefix: 'fa', markerColor: 'beige'}],
							[35 , "Knitwear"		, {icon:'scissors', prefix: 'fa', markerColor: 'beige'}],
							[36 , "Food"			, {icon:'cutlery', prefix: 'fa', markerColor: 'beige'}],
							[37 , "Beer"			, {icon:'beer', prefix: 'fa', markerColor: 'beige'}]
						]
					]
		};

		return defines;
	}
);