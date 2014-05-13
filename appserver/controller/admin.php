<?php

/**
 * Main Controller for all operations in BackEnd area.
 * @package AdminModule
 * @category Main Controller      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Patryk, Swann
 */
session_start();

// Init Image handlers
require_once APP_FOLDER_NAME . '/utils/GaleryUploadHandler.php';
require_once APP_FOLDER_NAME . '/utils/LogoUploadHandler.php';
// Init of PHP RBAC engine
require_once APP_FOLDER_NAME . '/utils/phprbac/Rbac.php';

// Init of PHP RBAC engine
require_once APP_FOLDER_NAME . '/controller/Task.php';

class Admin extends Controller {

    // reference to RBAC engine
    private $rbac = null;
    private $_taskController = null;

    /**
     * Custom constructor method. Besides calling parent function, this controller initializes
     * Role-Based Access Control & Task mini modules.
     * @return Void 
     * @author Patryk
     */
    public function __construct() {
        parent::__construct();
        $this->rbac = new PhpRbac\Rbac($this->db);
        $this->_taskController = new Task();
    }

    /**
     * Action method, delegating any call such as admin/task/blabla to Task module. 
     * @param text $param1 Action name [accept|reject]. Obligatory
     * @param text $param2 Additional request parameters. Not obligatory. 
     * @return void; redirects user to Admin front-page.* 
     * @author Patryk
     */
    public function tasks($param1, $param2 = "") {
        $this->verfifyAccess("approve_owner_and_place");
        $this->_taskController->handle($param1, $param2);
        header('location: ' . URL . 'admin/');
        exit();
    }

    /**
     * Rendering of front-page in BackEnd Panel with statistics depending on Role / Zone / Places assignments. 
     * @return void. 
     * @author Swann, Patryk
     */
    public function dashboard() {
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place");

        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $dashboard = C::D('SIDENAV_DEFAULT_CLASS');

        /* Declaration of models used for rendering of dashboard panels */
        $users_model = $this->loadModel('UsersModel');
        $votes_model = $this->loadModel('VotesModel');
        $items_model = $this->loadModel('ItemsModel');
        $tasks_model = $this->loadModel('TasksModel');

        /* Every type of user will have its individual data (based on role/zone/places assignments */
        $itemsNo = $items_model->getItemsCount();
        $votesNo = $votes_model->getVotesCount(true);

        /* If user has permission to manage owner and place, additional informaiton is gathered */
        if ($this->rbac->check('manage_owner_and_place', F::getUserId())) {
            $ownersNo = $users_model->getOwnersCount();
            $assignmentsNo = $items_model->getUnasignedItemsCount();
            $requestsNo = $tasks_model->getTasksCount();
        }

        /* Rendering of basic views. Statistic data is used in dashboard.php view.  */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/dashboard.php';

        /* If user has permission to approve owners and places, task lists with accept/reject options is rendered */
        if ($this->rbac->check('approve_owner_and_place', F::getUserId())) {
            $this->_taskController->handle('taskDashboard');
        }

        /* If user has permission to manage owner and place, assignment panel is rendered */
        if ($this->rbac->check('manage_owner_and_place', F::getUserId())) {
            require APP_FOLDER_NAME . '/views/admin/owner_place_assignment_light.php';
        }
        /* Footer view is attached */
        require APP_FOLDER_NAME . '/views/admin/_footer_in_dashboard.php';
    }

    /**
     * Rendering of view: List of Places. Depending on state, role additional options are revealed to user.
     * @param text $owner_id ID of owner to select places belonging to specific owner OR
     *                                      message Code of message to display in alert section
     * @return void
     * @todo Sorting, Ordering & Paging options, Naming of parameters
     * @author Swann, Patryk
     */
    public function places($owner_id = "") {
        /* Verification if user has access at least to list_places permission. */
        $this->verfifyAccess("list_places");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $places = C::D('SIDENAV_DEFAULT_CLASS');
        /* Declaration of model used for rendering of dashboard panels */
        $items_model = $this->loadModel('ItemsModel');

        /* If Message code is passed, get message object to display in View */
        if (!is_numeric($owner_id))
            $messageObj = F::getMessageObj($owner_id);

        /* Every type of user will have its individual data (based on role/zone/places assignments */
        $items = $items_model->getAdminItems($owner_id);

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/places.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Renders Edit View for specific Place selected from List. 
     * @param int $id ID of Place.
     * @return void; 
     * @todo Verification of access rights to single object not to group only.
     * @author Swann, Patryk
     */
    public function editInfos($id) {
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $places = C::D('SIDENAV_DEFAULT_CLASS');
        /* Hook used to reset session table with information about all files uploaded by Ajax Handlers during previous 
         * visits in Edit Place section. Without this, sometimes images could have been incorrectly overwritten.
         */
        F::clearPendings();

        /* Declaration of model and gathering of data about specufic Place */
        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->getItem($id);

        /* Special variable indication id of an item to handle the share the same view also with Add View */
        $item_id = $item->item_id;

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/place_edit_infos.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Renders Gallery management view for specific Place.
     * @param int $id ID of Place.
     * @return void; 
     * @author Swann
     */
    public function editphotos($id) {
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $places = C::D('SIDENAV_DEFAULT_CLASS');
        /* Declaration of model and gathering of data about specufic Place */
        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->getItem($id);

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/place_edit_photos.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Renders Codes management view for specific Place.
     * @param int $id ID of Place.
     * @return void; 
     * @author Swann, Patryk
     */
    public function editcodes($id) {
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $places = C::D('SIDENAV_DEFAULT_CLASS');

        /* Declaration of model and gathering of data about specufic Place */
        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->getItem($id);

        /* Declaration of model and gathering of data about Codes for this Place */
        $codes_model = $this->loadModel('CodesModel');
        $codes = $codes_model->getItemCodes($item->item_id);

        /* Preparation of counters */
        $nb_new_code = $this->countCode($codes, C::D("CODE_STATUS_NEW"));
        $nb_print_code = $this->countCode($codes, C::D("CODE_STATUS_PRINT"));
        $nb_used_code = $this->countCode($codes, C::D("CODE_STATUS_USED"));

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/place_edit_codes.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Renders printable page of generated codes.
     * @param int $id ID of Place.
     * @param int $codesNumber Number of codes to print. All by default
     * @return void;
     * @todo    Print specified amount of codes 
     * @author Patryk
     */
    public function printCodes($id, $codesNumber = 0) {
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $places = C::D('SIDENAV_DEFAULT_CLASS');

        /* Declaration of model and gathering of data about specufic Place */
        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->getItem($id);

        /* Declaration of model and gathering of data about Codes for this Place */
        $codes_model = $this->loadModel('CodesModel');
        $codes = $codes_model->getItemCodes($item->item_id);

        /* Preparation of counters */
        $nb_new_code = $this->countCode($codes, C::D("CODE_STATUS_NEW"));
        $nb_print_code = $this->countCode($codes, C::D("CODE_STATUS_PRINT"));
        $nb_used_code = $this->countCode($codes, C::D("CODE_STATUS_USED"));

        /* Printable views */
        require APP_FOLDER_NAME . '/views/admin/place_print_codes.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';

        /* Marking of codes that were listed as printed */
        $codes_model->markPrintedCodes($item->item_id);
    }

    /**
     * Codes generator. Basing on POST vars it generates and assignes specified amount of codes to a Place.
     * @return void; 
     * @author Swann
     */
    public function generatecode() {
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place", "session_only");

        /* Basic vars - item_id & number of codes. */
        $id_item = stripcslashes($_POST["item-id"]);
        $nb_code = stripcslashes($_POST["nb-code"]);

        /* Declaration o codes model */
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
     * Update of information about existing Place. Called from Edit View.
     * @return void; Redirects to List of Places View. 
     * @author Swann, Patryk
     */
    public function saveeditplace() {
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place", "session_only");

        /* Collection of vars from POST header */
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

        /* Declaration of model saving of data about specific Place */
        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->saveEditItem($id, $name, $flatname, $category, $type, $city, $zone, $address, $phone, $email, $website, $description, $image, $lat, $long, $price);

        header('location: ' . URL . 'admin/places');
        exit();
    }

    /**
     * Handler method called by AJAX component after upload of each photo.
     * @param int $id Id of place
     * @param text $name Name of file
     * @param bool $delete Flag used to mark delete command
     * @return Ajax response 
     * @author Swann
     */
    public function galeryUpload($id = null, $name = null, $delete = false) {
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place");

        /* Declaration of model for Place objects */
        $items_model = $this->loadModel('ItemsModel');

        /* Collection of parameters */
        if ($id == null)
            $id = $_POST["item-id"];
        if ($name)
            $name = F::utf8_urldecode($name);
        if ($delete == "delete")
            $delete = true;

        /* Declaration and invoking Gallery Handler. As a result files are either uploaded or delete from server.
         * As post action - database fields are updated for specific item */
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
     * Handler method called by AJAX component after upload of LOGO.
     * @param int $id Id of place
     * @param text $name Name of file
     * @param bool $delete Flag used to mark delete command
     * @return Ajax response 
     * @author Patryk
     */
    public function logoUpload($id = null, $name = null, $delete = false) {
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place");

        /* Declaration of model for Place objects */
        $items_model = $this->loadModel('ItemsModel');

        /* Collection of parameters, for Add or Edit View */
        if ($id == null) {
            if (isset($_POST["item-id"]))
                $id = $_POST["item-id"];
            else
                $id = F::getTempId();
        }
        if ($name)
            $name = F::utf8_urldecode($name);

        if ($delete === "delete") {
            $delete = true;
            F::setPendingUploadedFile('logo/delete', $id, $name);
        } else {
            /* Declaration and invoking Logo Handler. As a result file is either uploaded or deleted from server.
             * As post action - database field is updated for specific item */
            $upload_handler = new LogoUploadHandler(array(
                'user_dirs' => false,
                'download_via_php' => true,
                'items_model' => $items_model,
                'item_id' => $id,
                'temp_name' => C::D('LOGO_TEMPNAME_PREFIX') . F::getUserId(),
                'item_name' => $name,
                'delete' => $delete
            ));
        }
    }

    /**
     * Renders view for adding new Place in DB.
     * @return void; Simple HTML generation for Client App
     * @author Patryk
     */
    public function newplace() {
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $newplace = C::D('SIDENAV_DEFAULT_CLASS');

        /* Hook used to reset session table with information about all files uploaded by Ajax Handlers during previous 
         * visits in Add Place View. Without this, sometimes images could have been incorrectly overwritten.
         */
        F::clearPendings();

        /* Hook used to set temp ID for newly created place to make Ajax handlers work for Logo upload. */
        F::setTempId(time());
        $item_id = F::getTempId();

        /* Standard selection of views */
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
        /* Verification if user has access at least to edit_place permission. */
        $this->verfifyAccess("edit_place", "session_only");

        /* Collection of vars from POST header */
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

        /* Declaration of model saving of data about specific Place */
        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->saveNewItem($id, $name, $flatname, $category, $type, $city, $zone, $address, $phone, $email, $website, $description, $image, $lat, $long, $price);

        header('location: ' . URL . 'admin/places');
        exit();
    }

    /**
     * Renders view for adding new Place in DB.
     * @param text $msg Messsage code
     * @return void;
     * @todo Sorting, Ordering & Paging
     * @author Patryk
     */
    public function owners($msg = "") {
        /* Verification if user has access at least to manage_owner_and_place permission. */
        $this->verfifyAccess("manage_owner_and_place");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $placeowners = C::D('SIDENAV_DEFAULT_CLASS');

        /* If Message code is passed, get message object to display in View */
        $messageObj = F::getMessageObj($msg);

        /* Declaration of Owners Model & gathering of data */
        $owners_model = $this->loadModel('UsersModel');
        $owners = $owners_model->getOwners();
        $zones = C::ZONES_LIST();

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/owners.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Renders view for adding new Owner in DB.
     * @return void;
     * @author Patryk
     */
    public function newOwner() {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_owner_and_place");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $newowner = C::D('SIDENAV_DEFAULT_CLASS');
        
        /* Hide password reset fields. Standard will be created */ 
        $hidePass = true;

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/owner_new.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * The purpose of this method is to insert new Place in DB. Called after user submits filled form.
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data
     * @author Patryk
     */
    public function saveNewOwner() {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_owner_and_place", "session_only");

        /* Collection of data */ 
        $id = '';
        $name = strip_tags($_POST["user-name"]);
        $email = strip_tags($_POST["user-email"]);

        /* Declaration of models */
        $users_model = $this->loadModel('UsersModel');
        $userUnique = $users_model->checkUserUnique($email);
        
        if (!$userUnique) {
            $user = $users_model->addNewOwner($name, $email);
            header('location: ' . URL . 'admin/owners/');
        } else {
            header('location: ' . URL . 'admin/owners/USER_NOT_UNIQUE');
        }


        exit();
    }

    /**
     * ........
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */
    public function editOwner($id, $error = "") {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_owner_and_place");
        
        /* Declaration of models & gathering of data */
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->getOwner($id);

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/owner_edit_infos.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Update method for Owner
     * @return void;
     * @todo Server-side validation of data
     * @author Patryk
     */
    public function saveEditOwner() {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_owner_and_place");
        
        /* Collection of data */
        $id = strip_tags($_POST["user-id"]);
        $name = strip_tags($_POST["user-name"]);
        $email = strip_tags($_POST["user-email"]);
        $pass = strip_tags($_POST["user-pass"]);
        $new_pass = strip_tags($_POST["user-pass-2"]);

        /* Declaration of models & gathering of data */
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->getOwner($id);

        /* Verification if password has changed, by default we take current password of the user */      
        $passwordChangeOrNot = F::comparePasswords($user->password, $pass, $new_pass);

        if ($passwordChangeOrNot["error"] === "") {
            $user = $users_model->updateOwner($id, $name, $email, $passwordChangeOrNot["password"]);
            header('location: ' . URL . 'admin/owners');
        } else
            header('location: ' . URL . 'admin/editowner/' . $id . '/' . $passwordChangeOrNot["error"]);
        exit();
    }

    /**
     * Assigns Owner to Place  
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data
     * @author Patryk
     */
    public function assignOwnerToPlace() {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_owner_and_place");
        
        /* Preparation of Data Object for Task Module */
        $dataObj['owner_id'] = @strip_tags($_POST["owneridHolder"]);
        $dataObj['place_id'] = @strip_tags($_POST["itemidHolder"]);

        /* Creation of new Task & gathering of its ID for further processing */ 
        $taskId = $this->_taskController->newTask(C::D('TASK_APP_ASSIGNMENT'), $dataObj);

        /* If user has sufficient permission, autoacceptance is done */ 
        if ($this->rbac->check('approve_owner_and_place', F::getUserId())) {
            $this->_taskController->handle('accept', $taskId);
            header('location: ' . URL . 'admin/places');
        } else {
            header('location: ' . URL . 'admin/places/TASK_CREATED_SUCCESS');
        }
    }

    /**
     * Renders form for assignment Owner to Place. If ID's are passed it prefills specific field.
     * @param int $item_id Id of Place
     * @param int $owner_id Id Of owner
     * @return void;
     * @todo Prefill of Owner. Now only Item is active
     * @author Patryk
     */
    public function assignOwner($item_id = "", $owner_id = "") {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_owner_and_place");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $place = C::D('SIDENAV_DEFAULT_CLASS');

        /* Prefil of information about Item if item_id was passed */
        if (is_numeric($item_id)) {
            $items_model = $this->loadModel('ItemsModel');
            $item = $items_model->getItem($item_id);
            $item_name = $item->name;
        }

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/owner_place_assignment.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Renders list of Votes with menu according to Role/Zone assignments
     * @param text $msg Message code
     * @return void; 
     * @author Patryk
     */
    public function votes($msg = "") {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_votes");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $votes = C::D('SIDENAV_DEFAULT_CLASS');

        /* If Message code is passed, get message object to display in View */
        $messageObj = F::getMessageObj($msg);

        /* Declaration of Model & gathering of data */
        $votes_model = $this->loadModel('VotesModel');
        $votes = $votes_model->getVotes();

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/votes.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Handles activation of Vote for specific Item ID. Average rating is recalculated respectively.
     * @param int $vote_id Id of Vote
     * @return void;
     * @todo Server-side validation of data
     * @author Patryk
     */    
    public function activateVote($vote_id) {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_votes");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $votes = C::D('SIDENAV_DEFAULT_CLASS');

        /* Declaration of model & gathering of data */
        $votes_model = $this->loadModel('VotesModel');
        $vote = $votes_model->getVote($vote_id);
        
        /* Activation of vote for specific Item */
        $votes = $votes_model->activateVote($vote_id, $vote->item_id);

        header('location: ' . URL . 'admin/votes/');
        exit();
    }

    /**
     * Handles deactivation of Vote for specific Item ID. Average rating is recalculated respectively.
     * @param int $vote_id Id of Vote
     * @return void;
     * @todo Server-side validation of data
     * @author Patryk
     */
    public function deactivateVote($vote_id) {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_votes");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $votes = C::D('SIDENAV_DEFAULT_CLASS');

        /* Declaration of model & gathering of data */
        $votes_model = $this->loadModel('VotesModel');
        $vote = $votes_model->getVote($vote_id);
        
        /* Deactivation of vote for specific Item */
        $votes = $votes_model->deactivateVote($vote_id, $vote->item_id);

        header('location: ' . URL . 'admin/votes/');
        exit();
    }

    /**
     * EDIT OF VOTE. To be decided
     * @return void; Redirects user to Places view
     * @todo Decision 
     * @author Patryk
     */
    public function TODO_editVote($id) {
        $this->verfifyAccess("manage_votes");
        $votes = C::D('SIDENAV_DEFAULT_CLASS');

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/dashboard.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * EDIT OF VOTE. To be decided
     * @return void; Redirects user to Places view
     * @todo Decision
     * @author Patryk
     */
    public function TODO_saveEditVote() {
        $this->verfifyAccess("manage_votes", "session_only");
    }

    /**
     * Renders view for Management of Zone Admins. 
     * Additionally renders List View of Zones Zones.
     * @param text $msg Message Code
     * @return void; 
     * @todo Sorting, Ordering, Filtering & Paging
     * @author Patryk
     */
    public function zoneAdmins($msg = "") {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_zone_admins");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $zone_admins = C::D('SIDENAV_DEFAULT_CLASS');

        /* Built of message obj basing on message code */
        $messageObj = F::getMessageObj($msg);

        /* Declaration of Model and gathering of data for views */
        $zoneadmins_model = $this->loadModel('UsersModel');
        $zoneadmins = $zoneadmins_model->getZoneAdmins();
        $zones = C::ZONES_LIST();

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/zoneadmins.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Renders view for New Zone Admin
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */
    public function newZoneAdmin() {
        /* Verification if user has access permission. */
        $this->verfifyAccess("manage_zone_admins");
        /* Setting true/false for variable used for sidenav rendering and marking active links */
        $zone_admins = C::D('SIDENAV_DEFAULT_CLASS');

        /* Declaration of Model and gathering of data for views */
        $zoneadmins_model = $this->loadModel('UsersModel');
        $zoneadmins = $zoneadmins_model->getZoneAdmins();
        $zones = C::ZONES_LIST();

        /* Hide password fields because standard password will be used */
        $hidePass = true;

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/zoneadmin_new.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Renders view for Error Screen
     * @param text $msg Message code
     * @param text $method Name of Method causing this error
     * @return void;
     * @author Patryk
     */
    public function error($msg, $method = "") {
        /* Verification if user has access permission. */
        $this->verfifyAccess("list_places");

        $messageObj = F::getMessageObj($msg);

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/error.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Creation of new Zone Admin
     * @return void;
     * @author Patryk
     */
    public function saveNewZoneAdmin() {
        /* Verification if user has sufficient permission. */
        $this->verfifyAccess("manage_zone_admins", "session_only");

        /* Collection of data */
        $id = '';
        $name = strip_tags($_POST["user-name"]);
        $email = strip_tags($_POST["user-email"]);
        $zone = strip_tags($_POST["user-zone"]);

        /* Declaration of Model & gathering of data */
        $users_model = $this->loadModel('UsersModel');
        $userUnique = $users_model->checkUserUnique($email);

        /* If user has unique name */
        if (!$userUnique) {
            /* Add new Zone Admin */
            $user = $users_model->addNewZoneAdmin($name, $email, $zone);
            $zone_admin_id = $this->db->lastInsertId();
            if (is_numeric($zone_admin_id) && $zone_admin_id > 0) {
                /* And activate him/her */
                $this->activateZoneAdmin($zone_admin_id);
                header('location: ' . URL . 'admin/zoneadmins');
            } else {
                /* If zone admin was not created, redirect to error screen */
                header('location: ' . URL . 'admin/error/NOT_SAVED/saveNewZoneAdmin');
            }
        } else {
            header('location: ' . URL . 'admin/zoneadmins/USER_NOT_UNIQUE');
        }

        exit();
    }

    /**
     * Displays information about Zone Admin
     * @param int $id Id of zone admin
     * @param text $error Message code
     * @return void;
     * @todo Server-side validation of data
     * @author Patryk
     */
    public function editZoneAdmin($id, $error = "") {
        /* Verification if user has sufficient permission. */
        $this->verfifyAccess("manage_zone_admins");
        $zoneadmins = C::D('SIDENAV_DEFAULT_CLASS');

        /* Declaration of Model & gathering of data */
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->getZoneAdmin($id);

        /* Standard selection of views */
        require APP_FOLDER_NAME . '/views/admin/_header_in.php';
        require APP_FOLDER_NAME . '/views/admin/sidenav.php';
        require APP_FOLDER_NAME . '/views/admin/zoneadmin_edit_infos.php';
        require APP_FOLDER_NAME . '/views/admin/_footer_in.php';
    }

    /**
     * Updates information about Zone Admin
     * @return void;
     * @todo Server-side validation of data
     * @author Patryk
     */
    public function saveEditZoneAdmin() {
        /* Verification if user has sufficient permission. */
        $this->verfifyAccess("manage_zone_admins");

        /* Collection of data */ 
        $id = strip_tags($_POST["user-id"]);
        $name = strip_tags($_POST["user-name"]);
        $email = strip_tags($_POST["user-email"]);
        $zone = strip_tags($_POST["user-zone"]);
        $pass = strip_tags($_POST["user-pass"]);
        $new_pass = strip_tags($_POST["user-pass-2"]);

        /* Declaration of Model & gathering of data */
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->getZoneAdmin($id);

        /* Verification if users password has changed,by default we take current password of the user */
        $passwordChangeOrNot = F::comparePasswords($user->password, $pass, $new_pass);

        if ($passwordChangeOrNot["error"] === "") {
            $user = $users_model->updateZoneAdmin($id, $name, $email, $zone, $passwordChangeOrNot["password"]);
            header('location: ' . URL . 'admin/zoneadmins');
        } else
            header('location: ' . URL . 'admin/editzoneadmin/' . $id . '/' . $passwordChangeOrNot["error"]);
        exit();
    }

    /**
     * Handles activation of Zone Admin by General Admin.
     * @param int $id ID of object
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */
    public function activateZoneAdmin($id) {
        /* Verification if user has sufficient permission. */
        $this->verfifyAccess("manage_zone_admins");

        /* Declaration of User Model */
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->activateZoneAdmin($id);

        /* Granting of Permissions via RBAC framework */
        $roles_model = $this->loadModel('RbacModel');
        $role = $roles_model->assignPermisions(C::D('ROLE_ZONE_ADMIN'), $id);

        /* Redirection to List of Zone Admins View */
        header('location: ' . URL . 'admin/zoneadmins');
        exit();
    }

    /**
     * Handles deactivation of Zone Admin by General Admin.
     * @param int $id ID of object
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Security (Access possible only after calling newplace()) 
     * @author Patryk
     */
    public function deactivateZoneAdmin($id) {
        /* Verification if user has sufficient permission. */
        $this->verfifyAccess("manage_zone_admins");
        /* Declaration of User Model */
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->deactivateZoneAdmin($id);

        /* Revoke of Permissions via RBAC framework */
        $roles_model = $this->loadModel('RbacModel');
        $role = $roles_model->unassignPermisions(C::D('ROLE_ZONE_ADMIN'), $id);

        /* Redirection to List of Zone Admins View */
        header('location: ' . URL . 'admin/zoneadmins');
        exit();
    }

    /**
     * Handles activation request and puts it as a task to be accepted by General Admin.
     * @param int $id ID of object
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Autoactivation for General Admin
     * @author Patryk
     */
    public function activateOwner($id) {
        /* Verification if user has sufficient permission. */
        $this->verfifyAccess("manage_owner_and_place");
        /* Collection of data and built of DataObject used by Task Module */
        $dataObj['owner_id'] = @strip_tags($id);

        /* Creation of task & getting ID for further processing */
        $task_id = $this->_taskController->newTask(C::D('TASK_APP_ACTIVATE_OWNER'), $dataObj);

        /* Declaration of Model */
        $users_model = $this->loadModel('UsersModel');

        /* Update of owner´s status to block it from processing untill decision by General Admin is taken */
        $user = $users_model->setTaskId($dataObj['owner_id'], $task_id);

        /* If user has sufficient permission, autoacceptance is done */ 
        if ($this->rbac->check('approve_owner_and_place', F::getUserId())) {
            $this->_taskController->handle('accept', $task_id);
            header('location: ' . URL . 'admin/owners/');
        } else {
            /* Redirection to Owners View with Message Code */
            header('location: ' . URL . 'admin/owners/TASK_CREATED_SUCCESS');
        }        
        

        exit();
    }

    /**
     * Handles deactivation request and puts it as a task to be accepted by General Admin.
     * @param int $id ID of object
     * @return void; 
     * @todo Server-side validation of data, Message codes via Exception handling, Autoactivation for General Admin
     * @author Patryk
     */
    public function deactivateOwner($id) {
        /* Verification if user has sufficient permission. */
        $this->verfifyAccess("manage_owner_and_place");
        /* Collection of data and built of DataObject used by Task Module */
        $dataObj['owner_id'] = @strip_tags($id);

        /* Creation of task & getting ID for further processing */
        $task_id = $this->_taskController->newTask(C::D('TASK_APP_DEACTIVATE_OWNER'), $dataObj);

        /* Declaration of Model */
        $users_model = $this->loadModel('UsersModel');

        /* Update of owner´s status to block it from processing untill decision by General Admin is taken */
        $user = $users_model->setTaskId($dataObj['owner_id'], $task_id);

        /* If user has sufficient permission, autoacceptance is done */ 
        if ($this->rbac->check('approve_owner_and_place', F::getUserId())) {
            $this->_taskController->handle('accept', $task_id);
            header('location: ' . URL . 'admin/owners/');
        } else {        
            /* Redirection to Owners View with Message Code */
            header('location: ' . URL . 'admin/owners/TASK_CREATED_SUCCESS');
        }
        exit();
    }

    /**
     * Handles activation request and puts it as a task to be accepted by General Admin.
     * @param int $id ID of object
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Autoactivation for General Admin 
     * @author Patryk
     */
    public function activatePlace($id) {
        /* Verification if user has sufficient permission. */
        $this->verfifyAccess("manage_owner_and_place");
        /* Collection of data and built of DataObject used by Task Module */
        $dataObj['place_id'] = @strip_tags($id);

        /* Creation of task & getting ID for further processing */
        $task_id = $this->_taskController->newTask(C::D('TASK_APP_ACTIVATE_PLACE'), $dataObj);

        /* Declaration of Model */
        $items_model = $this->loadModel('ItemsModel');

        /* Update of item´s status to block it from processing untill decision by General Admin is taken */
        $item = $items_model->setTaskId($dataObj['place_id'], $task_id);

       /* If user has sufficient permission, autoacceptance is done */ 
        if ($this->rbac->check('approve_owner_and_place', F::getUserId())) {
            $this->_taskController->handle('accept', $task_id);
            header('location: ' . URL . 'admin/places/');
        } else {                
            /* Redirection to Places View with Message Code */
            header('location: ' . URL . 'admin/places/TASK_CREATED_SUCCESS');
        }
        exit();
    }

    /**
     * Handles deactivation request and puts it as a task to be accepted by General Admin.
     * @param int $id Id of place to be deactivated
     * @return void; Redirects user to Places view
     * @todo Server-side validation of data, Message codes via Exception handling, Autoactivation for General Admin
     * @author Patryk
     */
    public function deactivatePlace($id) {
        /* Verification if user has sufficient permission. */
        $this->verfifyAccess("manage_owner_and_place");
        /* Collection of data and built of DataObject used by Task Module */
        $dataObj['place_id'] = @strip_tags($id);

        /* Creation of task & getting ID for further processing */
        $task_id = $this->_taskController->newTask(C::D('TASK_APP_DEACTIVATE_PLACE'), $dataObj);

        /* Declaration of Model */
        $items_model = $this->loadModel('ItemsModel');

        /* Update of item´s status to block it from processing untill decision by General Admin is taken */
        $item = $items_model->setTaskId($dataObj['place_id'], $task_id);

       /* If user has sufficient permission, autoacceptance is done */ 
        if ($this->rbac->check('approve_owner_and_place', F::getUserId())) {
            $this->_taskController->handle('accept', $task_id);
            header('location: ' . URL . 'admin/places/');
        } else {         
            /* Redirection to Places View with Message Code */
            header('location: ' . URL . 'admin/places/TASK_CREATED_SUCCESS');
        }
        exit();
    }

    /**
     * Entry point for Admin Module called by Application. 
     * Handles authentication process. 
     * @return void; Redirects user to Login or Dashboard View.
     * @author Swann, Patryk
     */
    public function index() {
        if (!isset($_SESSION['user'])) {
            if (isset($_POST["admin-form-mail"])) {
                if (isset($_POST["admin-form-password"]) && $_POST["admin-form-password"] != "") {
                    $users_model = $this->loadModel('UsersModel');
                    $user = $users_model->checkAdminAuth($_POST["admin-form-mail"], $_POST["admin-form-password"]);
                    if ($user) {
                        /* User Object built and stored in Session for further use by other methods or modules */
                        /* From this moment access to this obect should be called via static methods of Function class */
                        $_SESSION['user'] = $user;
                        /* User Roles list are gathered from RBAC framework and also store in session. */
                        /* As it is not complicated Roles structure, only first role is used. */
                        /* From this moment access to this obect should be called via static methods of Function class */
                        $userRoles = $this->rbac->Users->allRoles(F::getUserId());
                        $activeRole = $userRoles[0];
                        $_SESSION['currentRole'] = $activeRole;
                        /* Depending on user Role/zone assignment, specific constraints for SQL queries are calculated  */
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
            /* Selection of views */
            require APP_FOLDER_NAME . '/views/admin/_header.php';
            require APP_FOLDER_NAME . '/views/admin/login.php';
            require APP_FOLDER_NAME . '/views/admin/_footer.php';
        } else {

            F::setUserConstraints();
            header('location: ' . URL . 'admin/dashboard');
        }
    }

    /**
     * Method used to render / process password change for user created with default one.
     * @return void; 
     * @todo Documentation 
     * @author Swann
     */
    public function newpassword() {
        /* Verification if user has access at least basic permission. */
        $this->verfifyAccess("list_places", "session_only");

        /* If this POST request is update request. */
        if (isset($_POST["new-password-first"])) {
            /* Verification if new password is correct, not empty and matches min size. */
            if (isset($_POST["new-password-first"]) && $_POST["new-password-first"] != "" &&
                    isset($_POST["new-password-second"]) && $_POST["new-password-second"] != "") {
                if (strlen($_POST["new-password-first"]) >= C::D('PW_MIN_SIZE')) {
                    if ($_POST["new-password-first"] == $_POST["new-password-second"]) {
                        if ($_POST["new-password-first"] != C::D('DEFAULT_PW')) {
                            /* Declaration of User Model */
                            $users_model = $this->loadModel('UsersModel');
                            if ($users_model->setNewPasswordAndChangeState($_SESSION["user"]->email, $_POST["new-password-first"])) {
                                $_SESSION['user']->state = C::D('USER_STATE_ACTIVE');
                                /* After successful processing, redirect user to Dashboard View  */
                                /* If not, redirect to current screen with Message code  */
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

        /* Selection of views */
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
     * Combined method to gather all initial validation steps and integrate it with RBAC module.
     * @param string $permission_name (name of permission required to call a method; 
     * @param string $specialArgs Level of access validation
     * @return void or redirect user to logout action
     * @see logout(), checkSession(), checkState(), checkTypeAtLeast()
     * @todo Review all methods of this class and decide if leveling authirization is required.  
     * @author Patryk
     */
    private function verfifyAccess($permission_name, $specialArgs = "") {

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
     * Checks if user has previously been authenticated and SESSION object created.
     * @return void:
     * @see verifyAccess
     * @author Swann
     */
    private function checkSession() {
        if (!isset($_SESSION['user'])) {
            header('location: ' . URL . 'admin');
            exit();
        }
    }

    /**
     * Depending on user state redirect user to reset his default password
     * @return void:
     * @see verifyAccess
     * @author Swann
     */
    private function checkState() {
        if (isset($_SESSION['user']->state) && $_SESSION['user']->state == C::D('USER_STATE_NEW')) {
            header('location: ' . URL . 'admin/newpassword');
            exit();
        }
    }

    /**
     * Draft access control method used to validate user type.
     * @param text $type ID of user type 
     * @return void:
     * @see verifyAccess
     * @author Swann
     */
    private function checkTypeAtLeast($type) {
        if (isset($_SESSION['user']->type) && (integer) $_SESSION['user']->type < $type) {
            header('location: ' . URL . 'admin/logout');
            exit();
        }
    }

    /**
     * Counts number of codes with specific status.
     * @param array $codes Codes set
     * @param text $status Status descriptor
     * @return Count of codes with specific state
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