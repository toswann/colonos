<?php
/**
 * Map Controller for all operations from Users perspective.
 * @package Front End Module
 * @category Map Controller      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Swann
 */

class Map extends Controller {

    /**
     * Default entry point for /map action called by Application. 
     * @return void
     * @author Swann
     */        
    public function index() {
        require APP_FOLDER_NAME.'/views/map/index.php';
    }

}

?>