<?php
/**
 * WIKI Controller for all operations from Users perspective.
 * @package Front End Module
 * @category WIKI Controller      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Patryk, Agnieszka
 */

class Wiki extends Controller {

    /**
     * Default entry point for /home action called by Application. 
     * @return void
     * @author Swann
     */    
    public function index() {
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $wiki = C::D('SIDENAV_DEFAULT_CLASS');        
        require_once APP_FOLDER_NAME.'/views/_templates/_mainpage_header.php';
        require_once APP_FOLDER_NAME.'/views/wiki/index.php';
        require_once APP_FOLDER_NAME.'/views/_templates/_mainpage_footer.php';
    }

}

?>