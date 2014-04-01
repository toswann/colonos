<?php

/*
	Constants::getArray(); // Full array
	Constants::getArray(1); // Value of 1 which is 'orange'
*/


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
    	'LOGIN_NO_PASS'			=> 'You need to enter a password.',
    	'LOGIN_BAD_INFOS'		=> 'Login or password incorrect.',

    	'NEWPASS_EMPTY'			=> 'Please enter the same new password two times.',
    	'NEWPASS_NOT_SAME'		=> 'The two password you entered are different.',
    	'NEWPASS_NOT_DEFAULT'	=> 'Please use an other password.',
    	'NEWPASS_SHORT'			=> 'Your password must be al least 6 caracters.'
    );

    public static function T($index) {
        return self::$text[$index];
    }

    public static function D($index) {
        return self::$defines[$index];
    }

}

?>