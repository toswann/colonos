<?php
/**
 * Mini module for handling accepance tasks raised by processes of Admin Controller
 * @package AdminModule
 * @category Task Controller      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Patryk
 */


@session_start();

class Task extends Controller {

    // reference to RBAC engine
    private $rbac = null;

    /**
     * Default constructor overridden. Instance of RBAC framework is created.
     * @author Patryk
     */
    public function __construct() {
        parent::__construct();
        $this->rbac = new PhpRbac\Rbac($this->db);
    }

    /**
     * Router method for this Module
     * @param text $request request type (accept|reject|methodName)
     * @param text $requestParam Additional request parameters. Not obligatory. 
     * @return void
     * @author Patryk
     */    
    public function handle($request, $requestParam = "") {
        if (method_exists($this, $request)) {
            $this->{$request}($requestParam);
        }
    }

    /**
     * Creates new task for General Admin 
     * @param text $taskType Action name [accept|reject]. Obligatory
     * @param array $dataObj Details of Action requiring new Task 
     * @return void
     * @todo Commenting
     * @author Patryk
     */    
    public function newTask($taskType, $dataObj) {
        $taskObj = $this->prepareTaskObj($taskType, $dataObj);

        $tasks_model = $this->loadModel('TasksModel');
        $comments = C::T('TASK_COMMENT_STANDARD_REQUEST');
        $task = $tasks_model->insertNewTask($taskType, $taskObj, $comments[1]);
        
        return $task;
    }

    /**
     * Renders view of Tasks for Dashboard
     * @param text $dummy Dummy param, not used right now
     * @param array $dataObj Details of Action requiring new Task 
     * @return HTML
     * @author Patryk
     */     
    private function taskDashboard($dummy = "") {

        $tasks_model = $this->loadModel('TasksModel');
        $tasks = $tasks_model->getTasks();

        require APP_FOLDER_NAME . '/views/admin/tasks.php';
    }

    /**
     * Main method for handling Accept methods. Basing on original Action and acceptance state calls proper internal method 
     * @param int $task_id ID of task
     * @return void
     * @todo Exception handling
     * @author Patryk
     */      
    private function accept($task_id) {
        $tasks_model = $this->loadModel('TasksModel');

        $task = $tasks_model->getTaskDetails($task_id);

        $task_types = C::TASK_TYPES();

        try {
            $method = $task_types[$task->type]["2"];
            if (method_exists($this, $method)) {
                $this->{$method}($task);
            }
        } catch (Exception $ex) {
            
        }
        $tasks = $tasks_model->markDoneTask($task_id, 'TASK_STATE_APPROVED');
        return 1;
    }

    /**
     * Main method for handling Reject methods. Basing on original Action and rejection state calls proper internal method 
     * @param int $task_id ID of task
     * @return void
     * @todo Exception handling
     * @author Patryk
     */    
    private function reject($task_id) {
        $tasks_model = $this->loadModel('TasksModel');
        $task = $tasks_model->getTaskDetails($task_id);

        $task_types = C::TASK_TYPES();

        try {
            $method = $task_types[$task->type]["2"];
            if (method_exists($this, $method)) {
                $this->{'reject_' . $method}($task);
            }
        } catch (Exception $ex) {
            
        }
        $tasks = $tasks_model->markDoneTask($task_id, 'TASK_STATE_REJECTED');
    }

    /**
     * Handles actions after positive decision about Assignment Owner to Place. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */     
    private function approveAssignment($taskObj) {
        var_dump($taskObj);

        $jobData = $this->parseTaskObj($taskObj);
        $owner_id = $jobData['objData']['owner_id'];

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->activateOwner($owner_id);

        $roles_model = $this->loadModel('RbacModel');
        $role = $roles_model->assignPermisions(C::D('ROLE_OWNER'), $owner_id);

        $place_id = $jobData['objData']['place_id'];
        $places_model = $this->loadModel('ItemsModel');
        $place = $places_model->activatePlace($place_id);
        $places_model->setOwner($place_id, $owner_id);     
    }

    /**
     * Handles actions after negative decision about Assignment Owner to Place. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */    
    private function reject_approveAssignment($taskObj) {
        var_dump($taskObj);

        $jobData = $this->parseTaskObj($taskObj);
        $owner_id = $jobData['objData']['owner_id'];
        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->setTaskId($owner_id, 0);

        $place_id = $jobData['objData']['place_id'];
        $items_model = $this->loadModel('ItemsModel');
        $place = $items_model->setTaskId($place_id, 0);
    }

    /**
     * Handles actions after positive decision about Activation of Owner. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */  
    private function activateOwner($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $owner_id = $jobData['objData']['owner_id'];

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->activateOwner($owner_id);

        $roles_model = $this->loadModel('RbacModel');
        $role = $roles_model->assignPermisions(C::D('ROLE_OWNER'), $owner_id);
    }

    /**
     * Handles actions after negative decision about Activation of Owner. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */    
    private function reject_activateOwner($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $owner_id = $jobData['objData']['owner_id'];

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->setTaskId($owner_id, 0);
    }

    /**
     * Handles actions after positive decision about Deactivation of Owner. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */    
    private function deactivateOwner($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $owner_id = $jobData['objData']['owner_id'];

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->deactivateOwner($owner_id);

        //$roles_model = $this->loadModel('RbacModel');
        //$role = $roles_model->unassignPermisions(C::D('ROLE_OWNER'), $owner_id);
    }

    /**
     * Handles actions after negative decision about Deactivation of Owner. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */    
    private function reject_deactivateOwner($taskObj) {
        $this->reject_activateOwner($taskObj);
    }

    /**
     * Handles actions after positive decision about activation of Place. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */     
    private function activatePlace($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $item_id = $jobData['objData']['place_id'];

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->activatePlace($item_id);
    }

    /**
     * Handles actions after negative decision about activation of Place. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */     
    private function reject_activatePlace($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $item_id = $jobData['objData']['place_id'];

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->setTaskId($item_id, 0);
    }

    /**
     * Handles actions after positive decision about deactivation of Place. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */    
    private function deactivatePlace($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $item_id = $jobData['objData']['place_id'];

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->deactivatePlace($item_id);
    }

    /**
     * Handles actions after negative decision about deactivation of Place. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */      
    private function reject_deactivatePlace($taskObj) {
        $this->reject_activatePlace($taskObj);
    }

    /**
     * Handles actions after positive decision about activation of Admin. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */ 
    private function activateZoneAdmin($taskObj) {
        $this->verfifyAccess("manage_zone_admins");

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->activateZoneAdmin($id);

        $roles_model = $this->loadModel('RbacModel');
        $role = $roles_model->assignPermisions(C::D('ROLE_ZONE_ADMIN'), $id);
    }

    /**
     * Handles actions after positive decision about deactivation of Admin. 
     * @param array $taskObj Information about original action
     * @return void
     * @todo Exception handling
     * @author Patryk
     */   
    private function deactivateZoneAdmin($taskObj) {
        $this->verfifyAccess("manage_zone_admins");

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->deactivateZoneAdmin($id);

        $roles_model = $this->loadModel('RbacModel');
        $role = $roles_model->unassignPermisions(C::D('ROLE_ZONE_ADMIN'), $id);
    }

    /**
     * Helper method preparing transforming TaskObj to get information about details of original action.
     * @param Object $taskObj Data Object with Task Data
     * @return Array;
     * @see F::getCustomObj()
     * @author Patryk
     */    
    private function parseTaskObj($taskObj) {
        $data = F::getCustomObj($taskObj->details);
        return $data;
    }

    /**
     * Helper method preparing transforming information about action causing the task to TaskObj for further processing.
     * @param text $taskType Name of task type.
     * @param array $dataObj Data Object with Task Data
     * @return Object;
     * @see F::setCustomObj()
     * @author Patryk
     */    
    private function prepareTaskObj($taskType, $dataObj) {
        $taskObj = F::setCustomObj($taskType, $dataObj);
        return $taskObj;
    }

    /**
     * Helper method transforming DataObject to HTML text for details of tasks in list 
     * @param array $dataObj Data Object with Task Data
     * @return Description;
     * @todo Separate Controler from View
     * @author Patryk
     */    
    private function parseDetails($dataObj) {
        $objData = F::getCustomObj($dataObj);
        $html = "";
        $users_model = $this->loadModel('UsersModel');
        $items_model = $this->loadModel('ItemsModel');
        foreach ($objData['objData'] as $key => $data) {

            switch ($key) {
                case 'owner_id':
                    $user = $users_model->getOwner($data);
                    $html .= '<h4><span class="label label-success">Owner: ' . $user->name . '</span> </h4> ';
                    break;
                case 'place_id':
                    $item = $items_model->getItem($data);
                    $html .= '<h4><span class="label label-success">Place: ' . $item->name . '</span> </h4>';
                    break;
                default:
                    $html .= '<span class="label label-default">' . $key . ': ' . $data . '</span> ';
            }
        }
        return $html;
    }

}

?>
