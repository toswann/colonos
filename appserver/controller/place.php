<?php
/**
 * Place Controller for all operations from Users perspective.
 * @package Front End Module
 * @category Place Controller      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Swann
 */

class Place extends Controller {

    /**
     * Entry point for /place/show action called by Application. 
     * @param int $id ID of place to show
     * @param text $name Additional URL-friendly name of place
     * @return void
     * @author Swann
     */        
    public function show($id = "", $name = "") {
        if ($id) {
            $items_model = $this->loadModel('ItemsModel');
            $item = $items_model->getItem($id);
        }
        if (isset($item) && $item) {
            $placeshow = true; // activate place.show.js in the view
            require APP_FOLDER_NAME . '/views/_templates/_header.php';
            require APP_FOLDER_NAME . '/views/place/show.php';
            require APP_FOLDER_NAME . '/views/_templates/_footer.php';
        } else {
            header('location: ' . URL . 'map');
            exit();
        }
    }

}

?>