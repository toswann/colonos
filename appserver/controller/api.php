<?php
/**
 * JSON API for Ajax Controls
 * @package API
 * @category API      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Swann, Patryk
 */
class Api extends Controller {

    public function index() {
        return null;
    }

    /**
     * Gets all items for initial AJAX Call from Front End.
     * @return Array of Objects; 
     * @author Swann
     */    
    public function items() {
        $items_model = $this->loadModel('ItemsModel');
        $items = $items_model->apiGetAllActiveItems();
        echo json_encode($items);
    }
    
    /**
     * Gets all Types for Category. Used in TYPE/CATEGORY Selectors actions in BackEnd
     * @return Array of Objects; 
     * @author Patryk
     */      
    public function getTypesForCategory($category) {
        $types = C::TYPES(stripslashes($category));
        echo json_encode($types);
    }    
    
    /**
     * Search owners to populate autosuggest fields in BackEnd.
     * @return Array of Objects; 
     * @author Patryk
     */       
    public function searchOwners($query="") {
        $users_model = $this->loadModel('UsersModel');
        $users = $users_model->searchOwners($query);
        echo json_encode($users);
    }    
    
    /**
     * Search owners to populate autosuggest fields in BackEnd.
     * @return Boolean; 
     * @author Swann
     */       
    public function checkEmail($email="") {
        $users_model = $this->loadModel('UsersModel');
        $users = $users_model->checkUserUnique($email);
        echo json_encode($users);
    }      
    
    /**
     * Search Places to populate autosuggest fields in BackEnd.
     * @return Array of Objects; 
     * @author Patryk
     */       
    public function searchItems($query="") {
        $items_model = $this->loadModel('ItemsModel');
        $items = $items_model->searchItems($query);
        echo json_encode($items);
    }      

    /**
     * Verifies if code is still valid. Called by FrontEnd
     * @return Boolean; 
     * @author Swann
     */       
    public function checkcode() {
        if (isset($_POST["code"]) && $_POST["code"]) {
            $codes_model = $this->loadModel('CodesModel');
            $code = $codes_model->getCode(strip_tags($_POST["code"]));
            if ($code) {
                if ($code->status < C::D('CODE_STATUS_USED')) {
                    $items_model = $this->loadModel('ItemsModel');
                    $item = $items_model->getItem($code->item_id);
                    $res["item_id"] = $code->item_id;
                    $res["item_name"] = $item->name;
                    $res["code"] = $code->code;
                    echo json_encode(array("state" => true, "infos" => $res));
                } else {
                    echo json_encode(array("state" => false, "error" => "code_used"));
                }
            } else
                echo json_encode(array("state" => false, "error" => "code_unknown"));
        } else
            echo json_encode(false);
    }
    
}
