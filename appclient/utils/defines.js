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
				cities: [
					"",
					"Achao",
					"Ancud",
					"Calbuco",
					"Castro",
					"Chaiten",
					"Chonchi",
					"Cochamó",
					"Curaco de Vélez",
					"Dalcahue",
					"Entre Lagos",
					"Fresia",
					"Frutillar",
					"Futaleufú",
					"Hornopirén",
					"LLanquihue",
					"Los Muermos",
					"Maullin",
					"Osorno",
					"Palena",
					"Puelo",
					"Puerto Montt",
					"Puerto Octay",
					"Puerto Varas",
					"Puqueldón",
					"Purranque",
					"Rio Negro",
					"Queilén",
					"Quellón",
					"Quemchi"
				],
				zones: [
					"",
					"Baía Mansa",
					"Calbuco",
					"Carelmapu",
					"Cascadas",
					"Chamiza",
					"Correntozo",
					"Ensenada",
					"Fresia",
					"Frutillar",
					"Hornopirén",
					"Lago Rupanco",
					"Llanquihue",
					"Los Bajos",
					"Los Muermos",
					"Maicolpué",
					"Maullín",
					"Osorno",
					"Pangal",
					"Petrohué",
					"Pucatrihue",
					"Puelo",
					"Puerto Octay",
					"Puerto Varas",
					"Puyehue",
					"Quillahua",
					"Rupanco"
				],
				categories: [
					"",
					"accomodation",
					"food",
					"culture",
					"nature",
					"aventure",
					"entertainment",
					"owner",
					"products"
				],
				types: [
						[
							[0 , "all"]
						],
						[
							[1  , "hotel"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[2  , "hostel"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[3  , "cabins"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[4  , "bb"				, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[5  , "camping"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[6  , "lodging"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[7  , "inn"				, {icon:'home', prefix: 'fa', markerColor: 'blue'}],
							[8  , "motel"			, {icon:'home', prefix: 'fa', markerColor: 'blue'}]
						],
						[
							[9  , "restaurant"		, {icon:'cutlery', prefix: 'fa', markerColor: 'red'}],
							[10 , "cafe"			, {icon:'coffee', prefix: 'fa', markerColor: 'red'}],
							[11 , "sandwich"		, {icon:'cutlery', prefix: 'fa', markerColor: 'red'}]
						],
						[
							[12 , "theatre"			, {icon:'film', prefix: 'fa', markerColor: 'orange'}],
							[13 , "museum"			, {icon:'film', prefix: 'fa', markerColor: 'orange'}],
							[14 , "cinema"			, {icon:'film', prefix: 'fa', markerColor: 'orange'}],
							[15 , "events"			, {icon:'film', prefix: 'fa', markerColor: 'orange'}]
						],
						[
							[16 , "flora"			, {icon:'leaf', prefix: 'fa', markerColor: 'green'}],
							[17 , "fauna"			, {icon:'leaf', prefix: 'fa', markerColor: 'green'}],
							[18 , "birds"			, {icon:'leaf', prefix: 'fa', markerColor: 'green'}],
							[19 , "geology"			, {icon:'leaf', prefix: 'fa', markerColor: 'green'}],
							[20 , "beaches"]
						],
						[
							[21 , "rafting"			, {icon:'globe', prefix: 'fa', markerColor: 'lightred'}],
							[22 , "canopy"			, {icon:'globe', prefix: 'fa', markerColor: 'lightred'}],
							[23 , "horse"			, {icon:'globe', prefix: 'fa', markerColor: 'lightred'}],
							[24 , "lodge"			, {icon:'globe', prefix: 'fa', markerColor: 'lightred'}],
							[25 , "luides"			, {icon:'globe', prefix: 'fa', markerColor: 'lightred'}]
						],
						[
							[26 , "casino"			, {icon:'glass', prefix: 'fa', markerColor: 'gray'}],
							[27 , "nightclub"		, {icon:'glass', prefix: 'fa', markerColor: 'gray'}],
							[28 , "rodeo"			, {icon:'glass', prefix: 'fa', markerColor: 'gray'}],
							[29 , "eventscentre"	, {icon:'glass', prefix: 'fa', markerColor: 'gray'}],
							[30 , "spa"				, {icon:'glass', prefix: 'fa', markerColor: 'gray'}]
						],
						[
							[31 , "terrains"		, {icon:'home', prefix: 'fa', markerColor: 'purple'}],
							[32 , "houses"			, {icon:'home', prefix: 'fa', markerColor: 'purple'}],
							[33 , "premises"		, {icon:'home', prefix: 'fa', markerColor: 'purple'}]
						],
						[
							[34 , "souvenirs"		, {icon:'picture-o', prefix: 'fa', markerColor: 'beige'}],
							[35 , "knitwear"		, {icon:'scissors', prefix: 'fa', markerColor: 'beige'}],
							[36 , "food"			, {icon:'cutlery', prefix: 'fa', markerColor: 'beige'}],
							[37 , "beer"			, {icon:'beer', prefix: 'fa', markerColor: 'beige'}]
						]
					]
		};

		return defines;
	}
);