<?php

session_start();

require APP_FOLDER_NAME . '/utils/GaleryUploadHandler.php';

// Init of PHP RBAC engine
require_once APP_FOLDER_NAME . '/utils/phprbac/Rbac.php';

class Admin extends Controller {

    // reference to RBAC engine
    private $rbac=null;    
   
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
    }

    /**
     * ......... 
     * @return ......... 
     * @todo Documentation
     * @author Swann
     */         
    public function dashboard() {
        $this->verfifyAccess("edit_place");  

        $dashboard = "active";
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/dashboard.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }
     
    /**
     * ......... 
     * @return ......... 
     * @todo Documentation
     * @author Swann
     */         
    public function places() {
        $this->verfifyAccess("list_places");   

        $places = "active";

        $items_model = $this->loadModel('ItemsModel');
        $items = $items_model->getAdminItems();

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

        $places = "active";
        
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

        $places = "active";

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->getItem($id);

        
        // if the user is the admin of the place		
        if (isset($item) && $item && $_SESSION["user"]->zone_id == $item->zone_id) {
            echo "edit";
        } else {
            header('location: ' . URL . 'admin/places');
            exit();
        }
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

        $places = "active";

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->getItem($id);

        // if the user is the admin of the place		
        if (isset($item) && $item && $_SESSION["user"]->user_id == $item->admin_id) {
            $codes_model = $this->loadModel('CodesModel');
            $codes = $codes_model->getItemCodes($item->id);
            $nb_new_code = $this->countCode($codes, C::D("CODE_STATUS_NEW"));
            $nb_print_code = $this->countCode($codes, C::D("CODE_STATUS_PRINT"));
            $nb_used_code = $this->countCode($codes, C::D("CODE_STATUS_USED"));
        } else {
            header('location: ' . URL . 'admin/places');
            exit();
        }
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/place_edit_codes.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
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

        $id = strip_tags($_POST["item-id"]);
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

        $newplace = "active";

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
    public function owners() {
        $this->verfifyAccess("manage_owner_and_place");   

        $placeowners = "active";

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

        $newowner = "active";

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
        $zone = strip_tags($_POST["user-zone"]);

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->addNewOwner($name, $email, $zone);

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
     }        
        
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function votes() {
        $this->verfifyAccess("manage_votes");            
        $votes = "active";
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
     public function editVote($id) {
        $this->verfifyAccess("manage_votes");  
        $votes = "active";
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
        $zone_admins = "active";

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
        $zone_admins = "active";
        $zoneadmins_model = $this->loadModel('UsersModel');
        $zoneadmins = $zoneadmins_model->getZoneAdmins(); 
        $zones = C::ZONES_LIST();        
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
     public function saveNewZoneAdmin() {
        $this->verfifyAccess("manage_zone_admins", "session_only");             

        $id = '';
        $name = strip_tags($_POST["user-name"]);
        $email = strip_tags($_POST["user-email"]);
        $zone = strip_tags($_POST["user-zone"]);

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->addNewZoneAdmin($name, $email, $zone);

        header('location: ' . URL . 'admin/zoneadmins');
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
        $zoneadmins = "active";
                
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
        $this->verfifyAccess("manage_zone_admins");    
        
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->activateOwner($id);
        
        $roles_model = $this->loadModel('RbacModel');
        $role= $roles_model->assignPermisions(C::D('ROLE_OWNER'), $id);  

        header('location: ' . URL . 'admin/owners');
        exit();               
     }     
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function deactivateOwner($id) {
        $this->verfifyAccess("manage_zone_admins");    
        
        $users_model = $this->loadModel('UsersModel'); 
        $user = $users_model->deactivateOwner($id);

        $roles_model = $this->loadModel('RbacModel');
        $role= $roles_model->unassignPermisions(C::D('ROLE_OWNER'), $id);                
        
        header('location: ' . URL . 'admin/owners');
        exit();            
     }       
    
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function approve() {
        $this->verfifyAccess("approve_place_and_user");       
        
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
     public function approvePlace($id) {
        $this->verfifyAccess("approve_owner_and_place", "session_only");       
        
     }   
     
   /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */    
     public function approveOwner($id) {
        $this->verfifyAccess("approve_owner_and_place", "session_only");       
        
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
        
        $rbac = "active";      

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
    


}

?>