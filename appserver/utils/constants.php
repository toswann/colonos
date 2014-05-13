<?php

class C {

    private static $defines = array(
        'CONTACT_EMAIL_FROM' => 'Mediawiki@arbol.dev',
        'CONTACT_EMAIL_ADDRESS' => 'patryk@arbol.dev',        
        'CONTACT_EMAIL_TITLE' => 'Contacto de rutadeloscolonos.cl',
        'CONTACT_EMAIL_TEMPLATE' => 'Hola, ###br###Usuario: ###user_name###, ###br### ha escrito un mensaje: ###br######br###"###message###" ###br######br###Rutadeloscolonos.cl',
        'DEFAULT_PW' => 'colonos',
        'DEFAULT_PW_SHA1' => 'b84b4726518964c6c7a1084817e84de8a62d63a8',
        'SIDENAV_DEFAULT_CLASS' => 'list-group-item-info',
        'PW_MIN_SIZE' => 6,
        'USER_STATE_NEW' => 0,
        'USER_STATE_ACTIVE' => 1,
        'TYPE_USER' => 0,
        'TYPE_MODERATOR' => 1,
        'TYPE_ZONE_ADMIN' => 2,
        'TYPE_GENERAL_ADMIN' => 3,
        'ROLE_OWNER' => 6,
        'ROLE_ZONE_ADMIN' => 5,     
        'ROLE_GENERAL_ADMIN' => 4,             
        'TASK_STATE_NEW' => 0,
        'TASK_STATE_REJECTED' => 1,
        'TASK_STATE_APPROVED' => 2,        
        'ITEM_STATE_OFFLINE' => 0,
        'ITEM_STATE_VALID' => 1,
        'ITEM_STATE_MODIFIED' => 2,
        'ROWS_PER_VIEW' => 20,        
        'CODE_STATUS_NEW' => 0,
        'CODE_STATUS_PRINT' => 1,
        'CODE_STATUS_USED' => 2,
        'RBAC_TABLE_PREFIX' => "rbac_",
        'GALLERY_IMAGE_MAX_WIDTH' => 800,
        'GALLERY_IMAGE_MAX_HEIGHT' => 550,
        'GALLERY_IMAGE_MIN_WIDTH' => 1,
        'GALLERY_IMAGE_MIN_HEIGHT' => 1,        
        'GALLERY_PATH' => '/public/storage/galeries/',
        'LOGO_IMAGE_MAX_WIDTH' => 90,
        'LOGO_IMAGE_MAX_HEIGHT' => 90,
        'LOGO_IMAGE_MIN_WIDTH' => 1,
        'LOGO_IMAGE_MIN_HEIGHT' => 1,        
        'LOGO_PATH' => '/public/storage/thumbs/',    
        'LOGO_DEFAULT' => '/public/storage/thumbs/na.jpg',         
        'LOGO_TEMPNAME_PREFIX' => 'templogo_',             
        'TASK_APP_NEW_OWNER' => 1,
        'TASK_APP_ACTIVATE_OWNER' => 2,
        'TASK_APP_DEACTIVATE_OWNER' => 3,
        'TASK_APP_NEW_PLACE' => 4,
        'TASK_APP_DEACTIVATE_PLACE' => 5,
        'TASK_APP_RATING' => 6,
        'TASK_APP_ASSIGNMENT' => 7,
        'TASK_APP_ACTIVATE_PLACE' => 8        
    );

    private static $task_type = array(
        array("NONE", "NONE", "NONE"),
        array("TASK_APP_NEW_OWNER", "New Owner", "activateOwner"),
        array("TASK_APP_ACTIVATE_OWNER", "Activate Owner", "activateOwner"),        
        array("TASK_APP_DEACTIVATE_OWNER", "Deactivate Owner", "deactivateOwner"),                
        array("TASK_APP_NEW_PLACE", "New Place", "activatePlace"),
        array("TASK_APP_DEACTIVATE_PLACE", "Deactivate Place", "deactivatePlace"),        
        array("TASK_APP_RATING", "New rating", "approveRating"),        
        array("TASK_APP_ASSIGNMENT", "Changed assignment", "approveAssignment"),
        array("TASK_APP_ACTIVATE_PLACE", "Activate Place", "activatePlace")          
    );    
    
    private static $task_status = array(
        array("NUEVO", "default"),
        array("USADO", "success")
    ) ;        
    
    private static $role_name = array(
        4 => "General Admin",
        5 => 'Zone Admin',             
        6=> 'Owner'
    ) ;   
  
    
    private static $item_state = array(
        array("OFFLINE", "default"),
        array("VALID", "success"),
        array("MODIFIED", "warning")
    );
    
    private static $decision_state = array(
        array("NO", "default"),
        array("YES", "success")
    );    
    
    private static $code_status = array(
        array("NUEVO", "default"),
        array("IMPRESO", "primary"),
        array("USADO", "success")
    ) ;
    

    private static $message_type = array(
        "SUCCESS"=>"success",
        "INFO"=>"info",        
        "WARNING"=>"warning",
        "ERROR"=> "danger"
    );    
    
    private static $text = array(
        'SERVER_ERROR_RELOAD' => 'Server Error, please reload the page',
        'LOGIN_NO_PASS' => 'You need to enter a password.',
        'LOGIN_BAD_INFOS' => 'Login or password incorrect.',
        'NEWPASS_EMPTY' => 'Please enter the same new password two times.',
        'NEWPASS_NOT_SAME' => 'The two password you entered are different.',
        'NEWPASS_NOT_DEFAULT' => 'Please use an other password.',
        'NEWPASS_SHORT' => 'Your password must be al least 6 caracters.',
        'TASK_CREATED_SUCCESS' => array('SUCCESS', 'Your request has been submited to General Admin for review.'),
        'TASK_CREATED_ERROR' => array('ERROR', 'Your request was not sent to General Admin. Please try again.'),
        'MAIL_SENT' => array('SUCCESS','Su mensaje se ha enviado.Gracias.'),
        'MAIL_NOTSENT' => array('WARNING','NO se ha enviado su mensaje. Por favor, pruebe una vez mas.'),
        'MAIL_ERROR' => array('ERROR','Se ocurrio un error. Por favor cantactese con Administrador.'),        
        'TASK_COMMENT_ACCEPTED' => array('SUCCESS','Login or password incorrect.'),
        'TASK_COMMENT_REJECTED' => array('ERROR','Your request has been rejected.'),
        'NOT_SAVED' => array('ERROR','There has been a problem with saving your changes. Please try again or contact Administrator.'),     
        'TASK_ALREADY_PENDING' => array('WARNING',' Your request was NOT sent to General Admin, because there is another task for this object in queue.'),        
        'TASK_COMMENT_STANDARD_REQUEST' => array('INFO','Please accept my request.'),
        'USER_NOT_UNIQUE' => array('ERROR','Email already exist, therefore your request has not been sucessfully processed.'), 
        /* IMAGE HANDLERS  */
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk',
        8 => 'A PHP extension stopped the file upload',
        'IMAGE_AVLIDATION_FAILED' => 'File was not validated correctly due to previous errors.',
        'IMAGE_POST_MAX_SIZE' => 'The uploaded file exceeds the post_max_size directive in php.ini',
        'IMAGE_MAX_FILE_SIZE' => 'File is too big',
        'IMAGE_MIN_FILE_SIZE' => 'File is too small',
        'IMAGE_ACCEPT_FILE_TYPES' => 'Filetype not allowed',
        'IMAGE_MAX_NUMBER_OF_FILES' => 'Maximum number of files exceeded',
        'IMAGE_MAX_WIDTH' => 'Image exceeds maximum width',
        'IMAGE_MIN_WIDTH' => 'Image requires a minimum width',
        'IMAGE_MAX_HEIGHT' => 'Image exceeds maximum height',
        'IMAGE_MIN_HEIGHT' => 'Image requires a minimum height',
        'IMAGE_ABORT' => 'File upload aborted',
        'IMAGE_IMAGE_RESIZE' => 'Failed to resize image' 
        /* IMAGE HANDLERS  */    
        
    );
    
    private static $categories = array(
        1 => "Alojamiento",
        2 => "Comida",
        3 => "Cultura",
        4 => "Naturaleza",
        5 => "Aventura",
        6 => "Entretencion",
        7 => "Propiedades",
        8 => "Productos"
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
        1000 => "All",
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
        0 => array(
            0 => "Typos...",
        ),
        1 => array(
            1 => "Hotel",
            2 => "Hostal",
            3 => "Cabañas",
            4 => "B&B",
            5 => "Camping",
            6 => "Hospedaje",
            7 => "Hostería",
            8 => "Motel"
        ),
        2 => array(
            0 => "Typos...",            
            9 => "Restaurante",
            10 => "Café",
            11 => "Sandwicheria"
        ),
        3 => array(
            0 => "Typos...",            
            12 => "Teatro",
            13 => "Museo",
            14 => "Cine",
            15 => "Eventos"
        ),
        4 => array(
            0 => "Typos...",            
            16 => "Flora",
            17 => "Fauna",
            18 => "Aves",
            19 => "Geológico",
            20 => "Playas"
        ),
        5 => array(
            0 => "Typos...",            
            21 => "Rafting",
            22 => "Canopy",
            23 => "Cabalgatas",
            24 => "Lodge",
            25 => "Guías"
        ),
        6 => array(
            0 => "Typos...",            
            26 => "Casino",
            27 => "Discoteque",
            28 => "Rodeo",
            29 => "Centro de eventos",
            30 => "SPA"
        ),
        7 => array(
            0 => "Typos...",            
            31 => "Terrenos",
            32 => "Casas",
            33 => "Locales"
        ),
        8 => array(
            0 => "Typos...",            
            34 => "Souvenirs",
            35 => "Tejidos",
            36 => "Alimentos",
            37 => "Cerveza"
        )
    );

    public static function T($index) {
        return @ self::$text[$index];
    }

    public static function D($index) {
        if ($index != "") return self::$defines[$index];
        return "";
    }

    public static function TASK_TYPE($index, $key = 0) {
        if ($index != "") return self::$task_type[$index][$key];
        return "";        
    }    
    
   public static function TASK_TYPES() {
        return self::$task_type;
    }      
    
    public static function ITEM_STATE($index, $key = 0) {
        if ($index != "") return self::$item_state[$index][$key];
        return "";        
    }
    
    public static function DECISION_STATE($index, $key = 0) {
        if ($index != "") return self::$decision_state[$index][$key];
        return "";        
    }    

    public static function CODE_STATUS($index, $key = 0) {
        return self::$code_status[$index][$key];
    }
    
    public static function MESSAGE_TYPE($index, $key = 0) {
        return self::$message_type[$index];
    }   
    
    public static function ROLE_NAME($index, $key = 0) {
        return self::$role_name[$index];
    }      

    public static function CATEGORIES($id = null) {
        return $id ? self::$categories[$id] : self::$categories;
    }

    public static function TYPES($category, $id = null) {
        if ($id == null && isset(self::$types[$category]))
            return self::$types[$category];
        else {
            if (isset(self::$types[$category][$id]))
                return self::$types[$category][$id];
        }
        return self::$types[0];         
    }

    public static function CITIES($id = null) {
        return $id ? self::$cities[$id] : self::$cities;
    }

    public static function ZONES($id = null) {
        if (is_numeric($id) && $id >0)
            return $id ? self::$zones[$id] : self::$zones;
        else
            return '';
    }
    
    public static function ZONES_LIST() {
            return self::$zones;
    }    

}

?>