<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
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

}
