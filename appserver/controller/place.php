<?php

class Place extends Controller {

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