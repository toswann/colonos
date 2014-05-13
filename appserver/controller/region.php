<?php
/**
 * Region Controller for all operations from Users perspective.
 * @package Front End Module
 * @category Region Controller      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Patryk, Agnieszka
 */

class Region extends Controller {

    /**
     * Default entry point for /home action called by Application. 
     * @return void
     * @author Swann
     */    
    public function index() {
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $region = C::D('SIDENAV_DEFAULT_CLASS');        
        require_once APP_FOLDER_NAME.'/views/_templates/_mainpage_header.php';
        require_once APP_FOLDER_NAME.'/views/region/index.php';
        require_once APP_FOLDER_NAME.'/views/_templates/_mainpage_footer.php';
    }

}

?>