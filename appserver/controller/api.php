<?php

class Api extends Controller {

    public function index() {
        return null;
    }

    public function items() {
        $items_model = $this->loadModel('ItemsModel');
        $items = $items_model->apiGetAllActiveItems();
        echo json_encode($items);
    }
    
    public function searchOwners($query="") {
        $users_model = $this->loadModel('UsersModel');
        $users = $users_model->searchOwners($query);
        echo json_encode($users);
    }    
    
    public function searchItems($query="") {
        $items_model = $this->loadModel('ItemsModel');
        $items = $items_model->searchItems($query);
        echo json_encode($items);
    }      

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
