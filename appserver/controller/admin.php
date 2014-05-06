<?php

session_start();

require APP_FOLDER_NAME . '/utils/GaleryUploadHandler.php';

// Init of PHP RBAC engine
require_once APP_FOLDER_NAME . '/utils/phprbac/Rbac.php';

// Init of PHP RBAC engine
require_once APP_FOLDER_NAME . '/controller/Task.php';

class Admin extends Controller {

    // reference to RBAC engine
    private $rbac=null;    
    private $_taskController = null;
    /**
     * ......... 
     * @param type $name Description
     * @return ......... 
     * @todo Documentation
     * @author Patryk
     */         
    public function __construct(){
        parent::__construct();
        $this->rbac = new PhpRbac\Rbac($this->db);        
        $this->_taskController = new Task();
    }

    public function tasks($param1, $param2=""){
        $this->verfifyAccess("approve_owner_and_place");    
        $this->_taskController->handle($param1, $param2);
        header('location: ' . URL . 'admin/');
        exit();        
    }
    
    /**
     * ......... 
     * @return ......... 
     * @todo Documentation
     * @author Swann
     */         
    public function dashboard() {
        $this->verfifyAccess("edit_place");  

        $dashboard = C::D('SIDENAV_DEFAULT_CLASS');
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/dashboard.php';
        
        if ($this->rbac->check('approve_owner_and_place', F::getUserId())){
            $this->_taskController->handle('taskDashboard');
        }

        require APP_FOLDER_NAME . '/views/admin/owner_place_assignment_light.php';
        
        echo "</div></div>";
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }
     
    /**
     * ......... 
     * @return ......... 
     * @todo Documentation
     * @author Swann
     */         
    public function places($owner_id="") {
        $this->verfifyAccess("list_places");   

        $places = C::D('SIDENAV_DEFAULT_CLASS');

        $items_model = $this->loadModel('ItemsModel');
        $items = $items_model->getAdminItems($owner_id);
        
        if (!is_numeric($owner_id))
            $messageObj = F::getMessageObj($owner_id);
        
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/places.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }
      
    /**
     * ......... 
     * @param type $name Description
     * @return ......... 
     * @todo Documentation
     * @author Swann
     */         
    public function editInfos($id) {
        $this->verfifyAccess("edit_place");   

        $places = C::D('SIDENAV_DEFAULT_CLASS');
        
        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->getItem($id);

        // if the user is the admin of the place		
        /*if (isset($item) && $item && $_SESSION["user"]->user_id == $item->admin_id) {
            echo "edit";
        } else {
            header('location: ' . URL . 'admin/places');
            exit();
        }*/
        
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/place_edit_infos.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * ......... 
     * @param type $name Description
     * @return ......... 
     * @todo Documentation
     * @author Swann
     */         
    public function editphotos($id) {
        $this->verfifyAccess("edit_place");   

        $places = C::D('SIDENAV_DEFAULT_CLASS');

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->getItem($id);

        
        // if the user is the admin of the place		
        /*
        if (isset($item) && $item && $_SESSION["user"]->zone_id == $item->zone_id) {
            echo "edit";
        } else {
            header('location: ' . URL . 'admin/places');
            exit();
        }*/
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/place_edit_photos.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * ......... 
     * @param type $name Description
     * @return ......... 
     * @todo Documentation
     * @author Swann
     */       
    public function editcodes($id) {
        $this->verfifyAccess("edit_place");   

        $places = C::D('SIDENAV_DEFAULT_CLASS');

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->getItem($id);

        // if the user is the admin of the place		
        //if (isset($item) && $item && $_SESSION["user"]->user_id == $item->admin_id) {
        $codes_model = $this->loadModel('CodesModel');
        $codes = $codes_model->getItemCodes($item->item_id);
        $nb_new_code = $this->countCode($codes, C::D("CODE_STATUS_NEW"));
        $nb_print_code = $this->countCode($codes, C::D("CODE_STATUS_PRINT"));
        $nb_used_code = $this->countCode($codes, C::D("CODE_STATUS_USED"));
        //} else {
         //   header('location: ' . URL . 'admin/places');
          //  exit();
        //}
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/place_edit_codes.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    public function printCodes($id){

        $this->verfifyAccess("edit_place");   

        $places = C::D('SIDENAV_DEFAULT_CLASS');

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->getItem($id);

        $codes_model = $this->loadModel('CodesModel');
        $codes = $codes_model->getItemCodes($item->item_id);
        
        $nb_new_code = $this->countCode($codes, C::D("CODE_STATUS_NEW"));
        $nb_print_code = $this->countCode($codes, C::D("CODE_STATUS_PRINT"));
        $nb_used_code = $this->countCode($codes, C::D("CODE_STATUS_USED"));
        require APP_FOLDER_NAME . '/views/admin/place_print_codes.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';        
        $codes_model->markPrintedCodes($item->item_id);
        
    }
    
    /**
     * ......... 
     * @return ......... 
     * @todo Documentation
     * @author Swann
     */       
    public function generatecode() {
        $this->verfifyAccess("edit_place", "session_only");     

        $id_item = $_POST["item-id"];
        $nb_code = $_POST["nb-code"];

        $codes_model = $this->loadModel('CodesModel');

        for ($i = 0; $i < $nb_code; $i++) {
            $code = F::generate_code();
            if (!$codes_model->checkCodeExist($code)) {
                if (!$codes_model->insertNewCode($id_item, $code)) {
                    $i--;
                }
            } else
                $i--;
        }
        header('location: ' . URL . 'admin/editcodes/' . $id_item);
        exit();
    }

    /**
     * ......... 
     * @return ......... 
     * @todo Documentation
     * @author Swann
     */       
    public function saveeditplace() {
        $this->verfifyAccess("edit_place", "session_only");            

        @$id = strip_tags($_POST["item-id"]);
        @$name = strip_tags($_POST["item-name"]);
        @$flatname = F::slugify($name);
        @$category = strip_tags($_POST["item-category"]);
        @$type = strip_tags($_POST["item-type"]);
        @$city = strip_tags($_POST["item-city"]);
        @$zone = strip_tags($_POST["item-zone"]);
        @$address = strip_tags($_POST["item-address"]);
        @$phone = strip_tags($_POST["item-phone"]);
        @$email = strip_tags($_POST["item-email"]);
        @$website = strip_tags($_POST["item-website"]);
        @$description = strip_tags($_POST["item-description"]);
        @$image = strip_tags($_POST["item-image"]);
        @$lat = strip_tags($_POST["item-lat"]);
        @$long = strip_tags($_POST["item-long"]);
        @$price = strip_tags($_POST["item-price"]);

        //echo $id."<br>".$name."<br>".$flatname."<br>".$category."<br>".$type."<br>".$city."<br>".$zone."<br>".$address."<br>".$phone."<br>".$email."<br>".$website."<br>".$description."<br>".$image."<br>".$galery."<br>".$lat."<br>".$long."<br>".$price."<br>";

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->saveEditItem($id, $name, $flatname, $category, $type, $city, $zone, $address, $phone, $email, $website, $description, $image, $lat, $long, $price);


        header('location: ' . URL . 'admin/places');
        exit();
    }

    /**
     * ......... 
     * @return ......... 
     * @todo Documentation 
     * @author Swann
     */       
    public function galeryUpload($id = null, $name = null, $delete = false) {
        $this->verfifyAccess("edit_place");    
        
        $items_model = $this->loadModel('ItemsModel');

        if ($id == null)
            $id = $_POST["item-id"];
        if ($name)
            $name = F::utf8_urldecode($name);
        if ($delete == "delete")
            $delete = true;

        $upload_handler = new GaleryUploadHandler(array(
            'user_dirs' => true,
            'download_via_php' => true,
            'items_model' => $items_model,
            'item_id' => $id,
            'item_name' => $name,
            'delete' => $delete
        ));
    }

    /**
     * Renders view for adding new Place in DB.
     * @return void; Simple HTML generation for Client App
     * @author Patryk
     */      
    public function newplace() {
        $this->verfifyAccess("manage_owner_and_place");   

        $newplace = C::D('SIDENAV_DEFAULT_CLASS');

        //$items_model = $this->loadModel('ItemsModel');
        //$item = $items_model->getItem($id);

        // if the user is the admin of the place		
        /*if (isset($item) && $item && $_SESSION["user"]->user_id == $item->admin_id) {
            echo "edit";
        } else {
            header('location: ' . URL . 'admin/places');
            exit();
        }*/
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/place_new.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }
    
    /**
     * The purpose of this method is to insert new Place in DB. Called after user submits filled form
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function savenewplace() {
        $this->verfifyAccess("manage_owner_and_place", "session_only");   

        $id = '';
        $name = strip_tags($_POST["item-name"]);
        $flatname = F::slugify($name);
        $category = strip_tags($_POST["item-category"]);
        $type = strip_tags($_POST["item-type"]);
        $city = strip_tags($_POST["item-city"]);
        $zone = strip_tags($_POST["item-zone"]);
        $address = strip_tags($_POST["item-address"]);
        $phone = strip_tags($_POST["item-phone"]);
        $email = strip_tags($_POST["item-email"]);
        $website = strip_tags($_POST["item-website"]);
        $description = strip_tags($_POST["item-description"]);
        $image = strip_tags($_POST["item-image"]);
        $lat = strip_tags($_POST["item-lat"]);
        $long = strip_tags($_POST["item-long"]);
        $price = strip_tags($_POST["item-price"]);
        //echo $id."<br>".$name."<br>".$flatname."<br>".$category."<br>".$type."<br>".$city."<br>".$zone."<br>".$address."<br>".$phone."<br>".$email."<br>".$website."<br>".$description."<br>".$image."<br>".$galery."<br>".$lat."<br>".$long."<br>".$price."<br>";

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->saveNewItem($id, $name, $flatname, $category, $type, $city, $zone, $address, $phone, $email, $website, $description, $image, $lat, $long, $price);


        header('location: ' . URL . 'admin/places');
        exit();
    }   
    
    /**
     * Renders view for adding new Place in DB.
     * @return void; Simple HTML generation for Client App
     * @author Patryk
     */      
    public function owners($msg="") {
        $this->verfifyAccess("manage_owner_and_place");   
        
        $messageObj = F::getMessageObj($msg);
        $placeowners = C::D('SIDENAV_DEFAULT_CLASS');

        $owners_model = $this->loadModel('UsersModel');
        $owners = $owners_model->getOwners(); 
        $zones = C::ZONES_LIST();        
        
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/owners.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';    

    }    
    
    /**
     * Renders view for adding new Place in DB.
     * @return void; Simple HTML generation for Client App
     * @author Patryk
     */      
    public function newOwner() {
        $this->verfifyAccess("manage_owner_and_place");   

        $newowner = C::D('SIDENAV_DEFAULT_CLASS');
        $hidePass = true;
        
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/owner_new.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }
    
    /**
     * The purpose of this method is to insert new Place in DB. Called after user submits filled form
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function saveNewOwner() {
        $this->verfifyAccess("manage_owner_and_place", "session_only");   

        /*$id = '';
        $name = strip_tags($_POST["item-name"]);
        $flatname = F::slugify($name);
        $category = strip_tags($_POST["item-category"]);
        $type = strip_tags($_POST["item-type"]);
        $city = strip_tags($_POST["item-city"]);
        $zone = strip_tags($_POST["item-zone"]);
        $address = strip_tags($_POST["item-address"]);
        $phone = strip_tags($_POST["item-phone"]);
        $email = strip_tags($_POST["item-email"]);
        $website = strip_tags($_POST["item-website"]);
        $description = strip_tags($_POST["item-description"]);
        $image = strip_tags($_POST["item-image"]);
        $lat = strip_tags($_POST["item-lat"]);
        $long = strip_tags($_POST["item-long"]);
        $price = strip_tags($_POST["item-price"]);
        */
        $id = '';
        $name = strip_tags($_POST["user-name"]);
        $email = strip_tags($_POST["user-email"]);
        
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->addNewOwner($name, $email);

        header('location: ' . URL . 'admin/owners');
        exit();          
        
    }    
    
    /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function editOwner($id, $error ="") {
        $this->verfifyAccess("manage_owner_and_place");      
        
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->getOwner($id);        
        
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/owner_edit_infos.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';        
        
     }
  
     /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function saveEditOwner() {
        $this->verfifyAccess("manage_owner_and_place");    
        
        $id = strip_tags($_POST["user-id"]);
        $name = strip_tags($_POST["user-name"]);
        $email = strip_tags($_POST["user-email"]);
        $zone = strip_tags($_POST["user-zone"]);       
        $pass = F::preparePass(strip_tags($_POST["user-pass"]));    
        $new_pass = F::preparePass(strip_tags($_POST["user-pass-2"]));    
                
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->getOwner($id);
        
        // by default we take current password of the user       
        $passwordChangeOrNot = F::comparePasswords($user->password, $pass, $new_pass);

        if ($passwordChangeOrNot["error"] === ""){
            $user = $users_model->updateZoneAdmin($id, $name, $email, $zone, $passwordChangeOrNot["password"]);
            header('location: ' . URL . 'admin/owners');
        }
        else
            header('location: ' . URL . 'admin/editowner/'.$id.'/'.$passwordChangeOrNot["error"] );
        exit();           
     }     
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function assignOwnerToPlace() {
        $this->verfifyAccess("manage_owner_and_place");   

        $dataObj['owner_id'] = @strip_tags($_POST["owneridHolder"]);
        $dataObj['place_id'] = @strip_tags($_POST["itemidHolder"]);
        
        $this->_taskController->newTask(C::D('TASK_APP_ASSIGNMENT'), $dataObj);
        header('location: ' . URL . 'admin/TASK_CREATED_SUCCESS');
     }        
        
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function assignOwner($item_id="", $owner_id="") {
        $this->verfifyAccess("manage_owner_and_place");   

        $place = C::D('SIDENAV_DEFAULT_CLASS');
        
        if (is_numeric($item_id)){
            $items_model = $this->loadModel('ItemsModel');
            $item = $items_model->getItem($item_id);
            $item_name = $item->name;
        }
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/owner_place_assignment.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
     }     
     
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function votes($msg="") {
        $this->verfifyAccess("manage_votes");            
        $votes = C::D('SIDENAV_DEFAULT_CLASS');
        
        $messageObj = F::getMessageObj($msg);

        $votes_model = $this->loadModel('VotesModel');
        $votes = $votes_model->getVotes(); 

        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/votes.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';           
     }      
     
     public function activateVote($vote_id) {
        $this->verfifyAccess("manage_votes");            
        $votes = C::D('SIDENAV_DEFAULT_CLASS');

        $votes_model = $this->loadModel('VotesModel');
        $vote = $votes_model->getVote($vote_id); 
        $votes = $votes_model->activateVote($vote_id, $vote->item_id); 

        header('location: ' . URL . 'admin/votes/');
        exit();          
        
     }       
     
    public function deactivateVote($vote_id) {
        $this->verfifyAccess("manage_votes");            
        $votes = C::D('SIDENAV_DEFAULT_CLASS');

        $votes_model = $this->loadModel('VotesModel');
        $vote = $votes_model->getVote($vote_id);         
        $votes = $votes_model->deactivateVote($vote_id, $vote->item_id); 
      
        header('location: ' . URL . 'admin/votes/');
        exit();          
        
     }      
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function editVote($id) {
        $this->verfifyAccess("manage_votes");  
        $votes = C::D('SIDENAV_DEFAULT_CLASS');
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/dashboard.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';           
     }  
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function saveEditVote() {
        $this->verfifyAccess("manage_votes", "session_only");                  
     }          
     
     
   /**
     * Renders view for Management of Zone Admins. 
    *  Additionally gets data for Zones.
     * @return void; 
     * @todo Action menu to manage inline aditing 
     * @author Patryk
     */    
     public function zoneAdmins() {
        $this->verfifyAccess("manage_zone_admins");        
        $zone_admins = C::D('SIDENAV_DEFAULT_CLASS');

        $zoneadmins_model = $this->loadModel('UsersModel');
        $zoneadmins = $zoneadmins_model->getZoneAdmins(); 
        $zones = C::ZONES_LIST();
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/zoneadmins.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';        
     }      
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function newZoneAdmin() {
        $this->verfifyAccess("manage_zone_admins");                  
        $zone_admins = C::D('SIDENAV_DEFAULT_CLASS');
        $zoneadmins_model = $this->loadModel('UsersModel');
        $zoneadmins = $zoneadmins_model->getZoneAdmins(); 
        $zones = C::ZONES_LIST();       
        $hidePass = true;
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/zoneadmin_new.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';        
        
     }        
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function error($msg, $method="") {
        $this->verfifyAccess("list_places");                  

        $messageObj = F::getMessageObj($msg);
        
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/error.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';        
        
     }        
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function saveNewZoneAdmin() {
        $this->verfifyAccess("manage_zone_admins", "session_only");             

        $id = '';
        $name = strip_tags($_POST["user-name"]);
        $email = strip_tags($_POST["user-email"]);
        $zone = strip_tags($_POST["user-zone"]);

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->addNewZoneAdmin($name, $email, $zone);
        $zone_admin_id = $this->db->lastInsertId();
        
        if (is_numeric($zone_admin_id) && $zone_admin_id > 0){
            $this->activateZoneAdmin($zone_admin_id);        
            header('location: ' . URL . 'admin/zoneadmins');
        }  else {
            header('location: ' . URL . 'admin/error/NOT_SAVED/saveNewZoneAdmin');
        }
        
        exit();        
        
     }             
          
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function editZoneAdmin($id, $error="") {
        $this->verfifyAccess("manage_zone_admins");   
        $zoneadmins = C::D('SIDENAV_DEFAULT_CLASS');
                
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->getZoneAdmin($id);
   
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/zoneadmin_edit_infos.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';        
        
     }  
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function saveEditZoneAdmin() {
        $this->verfifyAccess("manage_zone_admins");    
        
        $id = strip_tags($_POST["user-id"]);
        $name = strip_tags($_POST["user-name"]);
        $email = strip_tags($_POST["user-email"]);
        $zone = strip_tags($_POST["user-zone"]);       
        $pass = strip_tags($_POST["user-pass"]);    
        $new_pass = strip_tags($_POST["user-pass-2"]);    
                
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->getZoneAdmin($id);
        
        // by default we take current password of the user       
        $passwordChangeOrNot = F::comparePasswords($user->password, $pass, $new_pass);

        if ($passwordChangeOrNot["error"] === ""){
            $user = $users_model->updateZoneAdmin($id, $name, $email, $zone, $passwordChangeOrNot["password"]);
            header('location: ' . URL . 'admin/zoneadmins');
        }
        else
            header('location: ' . URL . 'admin/editzoneadmin/'.$id.'/'.$passwordChangeOrNot["error"] );
        exit();            
     }   
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function activateZoneAdmin($id) {       
        $this->verfifyAccess("manage_zone_admins");    
        
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->activateZoneAdmin($id);
        
        $roles_model = $this->loadModel('RbacModel');
        $role= $roles_model->assignPermisions(C::D('ROLE_ZONE_ADMIN'), $id);        

        header('location: ' . URL . 'admin/zoneadmins');
        exit();               
     }     
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function deactivateZoneAdmin($id) {
        $this->verfifyAccess("manage_zone_admins");    
        
        $users_model = $this->loadModel('UsersModel'); 
        $user = $users_model->deactivateZoneAdmin($id);

        $roles_model = $this->loadModel('RbacModel');
        $role= $roles_model->unassignPermisions(C::D('ROLE_ZONE_ADMIN'), $id);                
        
        header('location: ' . URL . 'admin/zoneadmins');
        exit();            
     }    
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function activateOwner($id) {       
        $this->verfifyAccess("manage_owner_and_place");    
        $dataObj['owner_id'] = @strip_tags($id);
        $task_id = $this->_taskController->newTask(C::D('TASK_APP_ACTIVATE_OWNER'),  $dataObj);
        
        $users_model = $this->loadModel('UsersModel'); 
        $user = $users_model->setTaskId($dataObj['owner_id'] , $task_id);
        
        header('location: ' . URL . 'admin/owners/TASK_CREATED_SUCCESS');
        exit();               
     }     
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function deactivateOwner($id) {
        $this->verfifyAccess("manage_owner_and_place");    
        $dataObj['owner_id'] = @strip_tags($id);  
        
        $task_id = $this->_taskController->newTask(C::D('TASK_APP_DEACTIVATE_OWNER'),  $dataObj);          
        $users_model = $this->loadModel('UsersModel'); 
        $user = $users_model->setTaskId($dataObj['owner_id'] , $task_id);

        header('location: ' . URL . 'admin/owners/TASK_CREATED_SUCCESS');
        exit();            
     }       
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function activatePlace($id) {       
        $this->verfifyAccess("manage_owner_and_place");    
        $dataObj['place_id'] = @strip_tags($id);
        $task_id = $this->_taskController->newTask(C::D('TASK_APP_ACTIVATE_PLACE'),  $dataObj);
        
        $items_model = $this->loadModel('ItemsModel'); 
        $item = $items_model->setTaskId($dataObj['place_id'] , $task_id);
        
        header('location: ' . URL . 'admin/places/TASK_CREATED_SUCCESS');
        exit();               
     }     
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patrykhttp://colonos.sample/admin/deactivatePlace/1
     */    
     public function deactivatePlace($id) {
        $this->verfifyAccess("manage_owner_and_place");    
        $dataObj['place_id'] = @strip_tags($id);  
        
        $task_id = $this->_taskController->newTask(C::D('TASK_APP_DEACTIVATE_PLACE'),  $dataObj);          
        $items_model = $this->loadModel('ItemsModel'); 
        $item = $items_model->setTaskId($dataObj['place_id'] , $task_id);

        header('location: ' . URL . 'admin/places/TASK_CREATED_SUCCESS');
        exit();            
     }       
    
    /**
     * ......... 
     * @return ......... 
     * @todo Documentation 
     * @author Swann
     */       
    public function index() {
        if (!isset($_SESSION['user'])) {
            if (isset($_POST["admin-form-mail"])) {
                if (isset($_POST["admin-form-password"]) && $_POST["admin-form-password"] != "") {
                    $users_model = $this->loadModel('UsersModel');
                    $user = $users_model->checkAdminAuth($_POST["admin-form-mail"], $_POST["admin-form-password"]);
                    if ($user) {
                        $_SESSION['user'] = $user;
                        $userRoles = $this->rbac->Users->allRoles(F::getUserId());
                        $activeRole = $userRoles[0];
                        $_SESSION['currentRole'] = $activeRole;
                        F::setUserConstraints();
                        header('location: ' . URL . 'admin/dashboard');
                        exit();
                    } else {
                        $error = C::T('LOGIN_BAD_INFOS');
                    }
                } else {
                    $error = C::T('LOGIN_NO_PASS');
                }
            }
            require APP_FOLDER_NAME . '/views/admin/_header.php';
            require APP_FOLDER_NAME . '/views/admin/login.php';
            require APP_FOLDER_NAME . '/views/admin/_footer.php';
        } else {
            F::setUserConstraints();
            header('location: ' . URL . 'admin/dashboard');
        }
    }

    /**
     * ......... 
     * @return ......... 
     * @todo Documentation 
     * @author Swann
     */     
    public function newpassword() {

        $this->verfifyAccess("list_places", "session_only");        

        if (isset($_POST["new-password-first"])) {
            if (isset($_POST["new-password-first"]) && $_POST["new-password-first"] != "" &&
                    isset($_POST["new-password-second"]) && $_POST["new-password-second"] != "") {
                if (strlen($_POST["new-password-first"]) >= C::D('PW_MIN_SIZE')) {
                    if ($_POST["new-password-first"] == $_POST["new-password-second"]) {
                        if ($_POST["new-password-first"] != C::D('DEFAULT_PW')) {
                            $users_model = $this->loadModel('UsersModel');
                            if ($users_model->setNewPasswordAndChangeState($_SESSION["user"]->email, $_POST["new-password-first"])) {
                                $_SESSION['user']->state = C::D('USER_STATE_ACTIVE');
                                header('location: ' . URL . 'admin/dashboard');
                                exit();
                            } else
                                $error = C::T('SERVER_ERROR_RELOAD');
                        } else
                            $error = C::T('NEWPASS_NOT_DEFAULT');
                    } else
                        $error = C::T('NEWPASS_NOT_SAME');
                } else
                    $error = C::T('NEWPASS_SHORT');
            } else
                $error = C::T('NEWPASS_EMPTY');
        }
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/newpassword.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }
    
    /**
     * Logout method.
     * @return void, redirects user to login screen.
     * @see session_unset(), session_destroy()
     * @author Swann
     */    
    public function logout() {
        F::logout();
    }

    /**
     * Module for Management of Roles, Permiossions & Users of App. 
     * @return void; Simple HTML generation for Client App
     * @todo Finish FrontEnd management of objects (adding, editing), Allow passing more arguments     * 
     * @author Patryk
     */ 
    public function rbac() {
        
        $roles_model = $this->loadModel('RBACModel', $this->rbac);
        $roles = $roles_model->getRoles();
        $permissions = $roles_model->getPermisions();
        //var_dump($_SESSION['user']);
        //die();
        
        $this->rbac->enforce('manage_zone_admins', $_SESSION['user']->user_id);
        
        $rbac = C::D('SIDENAV_DEFAULT_CLASS');      

       // $this->rbac->Roles->addPath('/general_admin/zone_admin/place_owner', $role_descriptions);
           
        /*
        $perm_id = null;        
        $perm_id = $this->rbac->Permissions->add('manage_zone_admins', 'Management of Zone Admins.');
        $this->rbac->Roles->assign(4, $perm_id);
        $perm_id = $this->rbac->Permissions->add('approve_place_and_owner', 'Approval for each new Place and Owner created by Zone Admins.');  
        $this->rbac->Roles->assign(4, $perm_id);
        $perm_id = $this->rbac->Permissions->add('manage_votes', 'Management of Votes (with list view as well)');  
        $this->rbac->Roles->assign(4, $perm_id);
        
        $perm_id = $this->rbac->Permissions->add('manage_owner_and_place', 'Create new Place or Owner. Assignment Owner to Place (Requires approval).');  
        $this->rbac->Roles->assign(5, $perm_id);
         
        $perm_id = $this->rbac->Permissions->add('edit_place', 'Edit information about Place or Owner. ');  
        $this->rbac->Roles->assign(6, $perm_id);
        $perm_id = $this->rbac->Permissions->add('list_places', 'List view of Places');  
        $this->rbac->Roles->assign(6, $perm_id);
        $perm_id = $this->rbac->Permissions->add('manage_code', 'Generation & Print of codes for Place.');  
        $this->rbac->Roles->assign(6, $perm_id);
*/ 

        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/roles.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';       
    }
    
    
    /**
     * Combined method to gather all initial validation steps and integrate it with RBAC module.
     * @param string $permission_name (name of permission required to call a method; 
     * @param string $specialArgs Level of access validation
     * @return void or redirect user to logout action
     * @see logout(), checkSession(), checkState(), checkTypeAtLeast()
     * @todo Review all methods of this class and decide if leveling authirization is required.  
     * @author Patryk
     */
     private function verfifyAccess($permission_name, $specialArgs=""){
        
        try {
            switch ($specialArgs) {
                case "session_only":
                    $this->checkSession();
                    break;
                default :
                    $this->checkSession();
                    $this->checkState();
                    $this->checkTypeAtLeast(C::D('TYPE_MODERATOR'));                
            }
            $this->rbac->enforce($permission_name, $_SESSION['user']->user_id);
            
        } catch (Exception $ex) {
            $this->logout();
        }

    }   

    /**
     * .........
     * @return void or redirect user to reset his default password
     * @see .........
     * @todo Documentation
     * @author Swann
     */        
    private function checkSession() {
        if (!isset($_SESSION['user'])) {
            header('location: ' . URL . 'admin');
            exit();
        }
    }

    /**
     * .........
     * @return void or redirect user to reset his default password
     * @see .........
     * @todo Documentation
     * @author Swann
     */    
    private function checkState() {
        if (isset($_SESSION['user']->state) && $_SESSION['user']->state == C::D('USER_STATE_NEW')) {
            header('location: ' . URL . 'admin/newpassword');
            exit();
        }
    }

    /**
     * .........
     * @param type $name Description 
     * @return .........
     * @see .........
     * @todo Documentation
     * @author Swann
     */      
    private function checkTypeAtLeast($type) {
        if (isset($_SESSION['user']->type) && (integer) $_SESSION['user']->type < $type) {
            header('location: ' . URL . 'admin/logout');
            exit();
        }
    }
     
    /**
     * .........
     * @param type $name Description
     * @param type $name Description
     * @return .........
     * @see .........
     * @todo Documentation
     * @author Swann
     */      
    private function countCode($codes, $status) {
        $count = 0;
        for ($i = 0; $i < count($codes); $i++) {
            if ($codes[$i]->status == $status)
                $count++;
        }
        return $count;
    }
    
    private function renderTemplates($mainFile){

        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
                
        require APP_FOLDER_NAME . '/views/admin/'.$mainFile.'.php';
        
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';        
        
    }

}

?>