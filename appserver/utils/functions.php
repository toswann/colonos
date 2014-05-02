<?php

class F {
	
    static public function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    static public function utf8_urldecode($str) {
        $str = preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($str));
        return html_entity_decode($str, null, 'UTF-8');
        ;
    }

    static public function generate_code($length = 10) {
        return substr(str_shuffle("123456789ABCDEFGHJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    static public function verifyPasswordStrength($pass) {
        if (strlen($pass) >= C::D('PW_MIN_SIZE'))
            return 1;
        return 0;
        //return self::$text[$index];
    }

    static public function getUserConstraints() {
        if (isset($_SESSION['user_constraint'])){
            return $_SESSION['user_constraint'];
        }
    }    
    
    /**
     * .........
     * @param type $name Description 
     * @return .........
     * @see .........
     * @todo Documentation
     * @author Swann
     */      
    static public function setUserConstraints() {
        
        if (isset($_SESSION['user']->type)) {
            switch ($_SESSION['user']->type){
                case C::D('TYPE_MODERATOR') :
                    $_SESSION['user_constraint'] = " AND owner_id= ".$_SESSION['user']->user_id;    
                    break;
                
                case C::D('TYPE_ZONE_ADMIN'):
                    $_SESSION['user_constraint'] = " AND ( zone_id IS NULL OR zone_id= ".$_SESSION['user']->zone_id.') ';
                    break;
                
                case C::D('TYPE_GENERAL_ADMIN'):
                    $_SESSION['user_constraint'] = " AND 1";
                    break;
                
                default:
                    die ('really?');
                    //self::logout();               
            } 
        }
    }     
    
    static public function logout(){
        session_unset();
        session_destroy();
        header('location: ' . URL . 'admin');        
    }
    
    static public function preparePass($text) {
        return sha1($text);
    }

    static public function generatePassword() {
        $alpha = "abcdefghijklmnopqrstuvwxyz";
        $alpha_upper = strtoupper($alpha);
        $numeric = "0123456789";
        $special = ".-+=_,!@$#*%<>[]{}";
        $chars = $alpha . $alpha_upper . $numeric;
        $length = 9;

        $len = strlen($chars);
        $pw = '';

        for ($i = 0; $i < $length; $i++)
            $pw .= substr($chars, rand(0, $len - 1), 1);

        // the finished password
        $pw = str_shuffle($pw);
        return $pw;
    }
    

    static public function comparePasswords($shaCurrentPass, $plainCandidatePass, $plainRetypeCandidatePass ) {
        
        $return = array("error" => "", "password"=>$shaCurrentPass);

        $shaCandidatePass = self::preparePass($plainCandidatePass);
        $shaRetypePass = self::preparePass($plainRetypeCandidatePass);
        // Now we verify if new password has been set
        if (($plainCandidatePass !== "") && ($shaCandidatePass !== $shaCurrentPass)){
            // If passwords are retyped correctly
            if ($shaCandidatePass === $shaRetypePass){
                // check if they match required strenth
                if (self::verifyPasswordStrength($plainCandidatePass) > 0){
                    // We are sure that new password was set and is ok
                    $return["password"] = $shaCandidatePass;
                }
                else
                    $return["error"] = "NEWPASS_SHORT";
            }   else {
                $return["error"] = "NEWPASS_NOT_SAME";
            }
        }
        
        return $return;
    }    
    

}


?>