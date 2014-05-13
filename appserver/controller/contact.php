<?php
/**
 * Contact Controller for all operations from Users perspective.
 * @package Front End Module
 * @category Contact Controller      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Swann, Patryk, Agnieszka
 */

class Contact extends Controller {

    private $_from = "";
    private $_title = "";
    private $_template = "";


    public function __construct() {
        parent::__construct();
        $this->_from = C::D('CONTACT_EMAIL_FROM');
        $this->_title = C::D('CONTACT_EMAIL_TITLE');
        $this->_template = C::D('CONTACT_EMAIL_TEMPLATE');
        
    }
    
    /**
     * Default entry point for /home action called by Application. 
     * @return void
     * @author Patryk, Agnieszka
     */    
    public function index() {
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $contact = C::D('SIDENAV_DEFAULT_CLASS');        
        require_once APP_FOLDER_NAME.'/views/_templates/_mainpage_header.php';
        require_once APP_FOLDER_NAME.'/views/contact/index.php';
        require_once APP_FOLDER_NAME.'/views/_templates/_mainpage_footer.php';
    }
    
    public function send(){
        @$user_name = strip_tags($_POST["user_name"]);
        @$user_email = strip_tags($_POST["user_email"]);
        @$message = strip_tags($_POST["message"]); 
        $this->dosend($user_email, $user_name, $message);
    }
    
    public function result($msg=""){
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $contact = C::D('SIDENAV_DEFAULT_CLASS');   
        
        /* If Message code is passed, get message object to display in View */
        $messageObj = F::getMessageObj($msg);        
        
        require_once APP_FOLDER_NAME.'/views/_templates/_mainpage_header.php';
        require_once APP_FOLDER_NAME.'/views/contact/result.php';
        require_once APP_FOLDER_NAME.'/views/_templates/_mainpage_footer.php';        
        
    }
    
    private function dosend($user_email, $user_name, $message){
        $message = $this->prepareMailBody($message, $user_name);
        $from = $this->prepareMailHeaders();
        
        try {
            
            //mail($user_email, $this->_title, $message, $from);
            
            $this->mail_utf8(C::D('CONTACT_EMAIL_ADDRESS'), $user_name, $user_email, $this->_title, $message);
            
            header('location: ' . URL . 'contact/result/MAIL_SENT');
            
        } catch (Exception $e) {
            
        }
        
    }
    
    private function prepareMailBody($message, $user_name){
        $br = "<br>";
        $msg = str_replace('###user_name###', $user_name, $this->_template);
        $msg = str_replace("###message###", $message, $msg);
        $msg = str_replace("###br###",$br, $msg);
        $msg = wordwrap($msg, 70, $br);
        
        return $msg;
    }
    
    private function prepareMailHeaders(){
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";        
        $headers .= "From: ".$this->_from;
        
        return $headers;
    }    
    
    function mail_utf8($to, $from_user, $from_email, $subject = '(No subject)', $message = '') {
        $from_user = "=?UTF-8?B?" . base64_encode($from_user) . "?=";
        $subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
        $headers = "From: $from_user <$from_email>\r\n" .
                "MIME-Version: 1.0" . "\r\n" .
                "Content-type: text/html; charset=UTF-8" . "\r\n";

        return mail($to, $subject, $message, $headers);
    }

}

?>