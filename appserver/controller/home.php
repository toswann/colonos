<?php
/**
 * Home Controller for all operations from Users perspective.
 * @package Front End Module
 * @category Home Controller      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Swann, Patryk, Agnieszka
 */

class Home extends Controller {

    /**
     * Default entry point for /home action called by Application. 
     * @return void
     * @author Swann
     */    
    public function index() {
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $home = C::D('SIDENAV_DEFAULT_CLASS');        
        require_once APP_FOLDER_NAME.'/views/_templates/_mainpage_header.php';
        require_once APP_FOLDER_NAME.'/views/home/index.php';
        require_once APP_FOLDER_NAME.'/views/_templates/_mainpage_footer.php';
    }

}

?>