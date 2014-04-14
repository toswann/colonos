<?php

session_start();
 
require APP_FOLDER_NAME.'/utils/GaleryUploadHandler.php';
 
class Api extends Controller
{

	public function index() {
		return null;
	}
	
    public function items()
    {
        // load a model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $items_model = $this->loadModel('ItemsModel');
        $items = $items_model->getAllActiveItems();

		echo json_encode($items);
    }
    
    public function upload($id = null, $name = null) {

        $items_model = $this->loadModel('ItemsModel');

		if ($id == null)
			$id = $_POST["item-id"];
		if ($name)
			$name = F::utf8_urldecode($name);
		$upload_handler = new GaleryUploadHandler(array(
		    'user_dirs' 		=> 	true,
		    'download_via_php' 	=> 	true,
		    'items_model'		=>	$items_model,
		    'item_id'			=> 	$id,
		    'item_name'			=>	$name
		));
    }
    
    public function test() {
//	    echo serialize(array("plateau_de_jeu.jpg"));

    	$items_model = $this->loadModel('ItemsModel');
	    var_dump(unserialize($items_model->getItemGalery(2)->galery));

    }

}
