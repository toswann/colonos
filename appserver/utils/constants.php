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
    	'TYPE_GENERAL_ADMIN'	=> 3    	
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
		1	=>	"Frutillar",
		2	=>	"Llanquihue",
		3	=>	"Puerto Varas",
		4	=>	"Puerto Octay",
		5	=>	"Puerto Montt"
	);

	private static $zones = array(
		1	=>	"Frutillar",
		2	=>	"Llanquihue",
		3	=>	"Puerto Varas",
		4	=>	"Ensenada",
		5	=>	"Cascadas",
		6	=>	"Puerto Octay",
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