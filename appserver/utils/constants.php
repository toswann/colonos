<?php

class C {
    private static $defines = array(
    	'DEFAULT_PW'			=> 'colonos',
    	'DEFAULT_PW_SHA1'		=> 'b84b4726518964c6c7a1084817e84de8a62d63a8',
    	'PW_MIN_SIZE'			=> 6,
    	
    	'USER_STATE_NEW'		=> 0,
    	'USER_STATE_ACTIVE'		=> 1,
    	
    	'TYPE_USER'				=> 0,
    	'TYPE_MODERATOR'		=> 1,
    	'TYPE_ZONE_ADMIN'		=> 2,
    	'TYPE_GENERAL_ADMIN'	=> 3,
    	
    	'ITEM_STATE_OFFLINE'	=> 0,
    	'ITEM_STATE_VALID'		=> 1,
    	'ITEM_STATE_MODIFIED'	=> 2,

    	'CODE_STATUS_NEW'		=> 0,
    	'CODE_STATUS_PRINT'		=> 1,
    	'CODE_STATUS_USED'		=> 2
    );

    private static $item_state = array(
		array("OFFLINE"		, "default"),
		array("VALID"		, "success"),
		array("MODIFIED"	, "warning")
    );

    
    private static $code_status = array(
		array("NUEVO"	, "default"),
		array("IMPRESO"	, "primary"),
		array("USADO"	, "success")
    );

    private static $text = array(
		'SERVER_ERROR_RELOAD'	=> 'Server Error, please reload the page',

    	'LOGIN_NO_PASS'			=> 'You need to enter a password.',
    	'LOGIN_BAD_INFOS'		=> 'Login or password incorrect.',

    	'NEWPASS_EMPTY'			=> 'Please enter the same new password two times.',
    	'NEWPASS_NOT_SAME'		=> 'The two password you entered are different.',
    	'NEWPASS_NOT_DEFAULT'	=> 'Please use an other password.',
    	'NEWPASS_SHORT'			=> 'Your password must be al least 6 caracters.'
    );

	private static $categories = array(
		1	=>	"Alojamiento",
		2	=>	"Comida",
		3	=>	"Cultura",
		4	=>	"Naturaleza",
		5	=>	"Aventura",
		6	=>	"Entretencion",
		7	=>	"Propiedades",
		8	=>	"Productos"
	);

	private static $cities = array(
		1 => "Achao",
		2 => "Ancud",
		3 => "Calbuco",
		4 => "Castro",
		5 => "Chaiten",
		6 => "Chonchi",
		7 => "Cochamó",
		8 => "Curaco de Vélez",
		9 => "Dalcahue",
		10 => "Entre Lagos",
		11 => "Fresia",
		12 => "Frutillar",
		13 => "Futaleufú",
		14 => "Hornopirén",
		15 => "LLanquihue",
		16 => "Los Muermos",
		17 => "Maullin",
		18 => "Osorno",
		19 => "Palena",
		20 => "Puelo",
		21 => "Puerto Montt",
		22 => "Puerto Octay",
		23 => "Puerto Varas",
		24 => "Puqueldón",
		25 => "Purranque",
		26 => "Rio Negro",
		27 => "Queilén",
		28 => "Quellón",
		29 => "Quemchi"
	);

	private static $zones = array(
		1 => "Baía Mansa",
		2 => "Calbuco",
		3 => "Carelmapu",
		4 => "Cascadas",
		5 => "Chamiza",
		6 => "Correntozo",
		7 => "Ensenada",
		8 => "Fresia",
		9 => "Frutillar",
		10 => "Hornopirén",
		11 => "Lago Rupanco",
		12 => "Llanquihue",
		13 => "Los Bajos",
		14 => "Los Muermos",
		15 => "Maicolpué",
		16 => "Maullín",
		17 => "Osorno",
		18 => "Pangal",
		19 => "Petrohué",
		20 => "Pucatrihue",
		21 => "Puelo",
		22 => "Puerto Octay",
		23 => "Puerto Varas",
		24 => "Puyehue",
		25 => "Quillahua",
		26 => "Rupanco"
	);

	private static $types = array(
			1	=>	array(
				1	=>	"Hotel",
				2	=>	"Hostal",
				3	=>	"Cabañas",
				4	=>	"B&B",
				5	=>	"Camping",
				6	=>	"Hospedaje",
				7	=>	"Hostería",
				8	=>	"Motel"
			),
			2	=>	array(
				9	=>	"Restaurante",
				10	=>	"Café",
				11	=>	"Sandwicheria"
			),
			3	=>	array(
				12	=>	"Teatro",
				13	=>	"Museo",
				14	=>	"Cine",
				15	=>	"Eventos"
			),
			4	=>	array(
				16	=>	"Flora",
				17	=>	"Fauna",
				18	=>	"Aves",
				19	=>	"Geológico",
				20	=>	"Playas"
			),
			5	=>	array(
				21	=>	"Rafting",
				22	=>	"Canopy",
				23	=>	"Cabalgatas",
				24	=>	"Lodge",
				25	=>	"Guías"
			),
			6	=>	array(
				26	=>	"Casino",
				27	=>	"Discoteque",
				28	=>	"Rodeo",
				29	=>	"Centro de eventos",
				30	=>	"SPA"
			),
			7	=>	array(
				31	=>	"Terrenos",
				32	=>	"Casas",
				33	=>	"Locales"
			),
			8	=>	array(
				34	=>	"Souvenirs",
				35	=>	"Tejidos",
				36	=>	"Alimentos",
				37	=>	"Cerveza"
			)
	);

    public static function T($index) {
        return self::$text[$index];
    }

    public static function D($index) {
        return self::$defines[$index];
    }

    public static function ITEM_STATE($index, $key = 0) {
        return self::$item_state[$index][$key];
    }

    public static function CODE_STATUS($index, $key = 0) {
        return self::$code_status[$index][$key];
    }

	public static function CATEGORIES($id = null) {
		return $id ? self::$categories[$id] : self::$categories;
	}

	public static function TYPES($category, $id = null) {
		return $id ? self::$types[$category][$id] : self::$types[$category];
	}

	public static function CITIES($id = null) {
		return $id ? self::$cities[$id] : self::$cities;
	}
	
	public static function ZONES($id = null) {
		return $id ? self::$zones[$id] : self::$zones;
	}

}

?>