<?php

@session_start();

class Task extends Controller {

    // reference to RBAC engine
    private $rbac = null;

    /**
     * ......... 
     * @param type $name Description
     * @return ......... 
     * @todo Documentation
     * @author Patryk
     */
    public function __construct() {
        parent::__construct();
        $this->rbac = new PhpRbac\Rbac($this->db);
    }

    public function handle($request, $requestParam = "") {
        if (method_exists($this, $request)) {
            $this->{$request}($requestParam);
        }
    }

    public function newTask($taskType, $dataObj) {
        $taskObj = $this->prepareTaskObj($taskType, $dataObj);

        $tasks_model = $this->loadModel('TasksModel');
        $comments = C::T('TASK_COMMENT_STANDARD_REQUEST');
        $task = $tasks_model->insertNewTask($taskType, $taskObj, $comments[1]);
        //die($taskObj);
        return $task;
    }

    private function taskDashboard($dummy = "") {

        $tasks_model = $this->loadModel('TasksModel');
        $tasks = $tasks_model->getTasks();

        require APP_FOLDER_NAME . '/views/admin/tasks.php';
    }

    private function accept($task_id) {
        $tasks_model = $this->loadModel('TasksModel');

        $task = $tasks_model->getTaskDetails($task_id);

        $task_types = C::TASK_TYPES();

        try {
            $method = $task_types[$task->type]["2"];
            if (method_exists($this, $method)) {
                $this->{$method}($task);
            }

            // echo $method;
            //         var_dump($task);
            // die();
        } catch (Exception $ex) {
            
        }
        $tasks = $tasks_model->markDoneTask($task_id, 'TASK_STATE_APPROVED');
        return 1;
    }

    private function reject($task_id) {
        $tasks_model = $this->loadModel('TasksModel');
        $task = $tasks_model->getTaskDetails($task_id);

        $task_types = C::TASK_TYPES();

        try {
            $method = $task_types[$task->type]["2"];
            if (method_exists($this, $method)) {
                $this->{'reject_' . $method}($task);
            }

            // echo $method;
            //         var_dump($task);
            // die();
        } catch (Exception $ex) {
            
        }
        $tasks = $tasks_model->markDoneTask($task_id, 'TASK_STATE_REJECTED');
    }

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
        //die();        
    }

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

    private function activateOwner($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $owner_id = $jobData['objData']['owner_id'];

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->activateOwner($owner_id);

        $roles_model = $this->loadModel('RbacModel');
        $role = $roles_model->assignPermisions(C::D('ROLE_OWNER'), $owner_id);
    }

    private function reject_activateOwner($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $owner_id = $jobData['objData']['owner_id'];

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->setTaskId($owner_id, 0);
    }

    private function deactivateOwner($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $owner_id = $jobData['objData']['owner_id'];

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->deactivateOwner($owner_id);

        $roles_model = $this->loadModel('RbacModel');
        $role = $roles_model->unassignPermisions(C::D('ROLE_OWNER'), $owner_id);
    }

    private function reject_deactivateOwner($taskObj) {
        $this->reject_activateOwner($taskObj);
    }

    private function activatePlace($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $item_id = $jobData['objData']['place_id'];

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->activatePlace($item_id);
    }

    private function reject_activatePlace($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $item_id = $jobData['objData']['place_id'];

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->setTaskId($item_id, 0);
    }

    private function deactivatePlace($taskObj) {

        $jobData = $this->parseTaskObj($taskObj);
        $item_id = $jobData['objData']['place_id'];

        $items_model = $this->loadModel('ItemsModel');
        $item = $items_model->deactivatePlace($item_id);
    }

    private function reject_deactivatePlace($taskObj) {
        $this->reject_activatePlace($taskObj);
    }

    private function activateZoneAdmin($taskObj) {
        $this->verfifyAccess("manage_zone_admins");

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->activateZoneAdmin($id);

        $roles_model = $this->loadModel('RbacModel');
        $role = $roles_model->assignPermisions(C::D('ROLE_ZONE_ADMIN'), $id);
    }

    private function deactivateZoneAdmin($taskObj) {
        $this->verfifyAccess("manage_zone_admins");

        $users_model = $this->loadModel('UsersModel');
        $user = $users_model->deactivateZoneAdmin($id);

        $roles_model = $this->loadModel('RbacModel');
        $role = $roles_model->unassignPermisions(C::D('ROLE_ZONE_ADMIN'), $id);
    }

    private function parseTaskObj($taskObj) {
        $data = F::getCustomObj($taskObj->details);
        return $data;
    }

    private function prepareTaskObj($taskType, $dataObj) {
        $taskObj = F::setCustomObj($taskType, $dataObj);
        return $taskObj;
    }

    private function parseDetails($dataObj) {
        $objData = F::getCustomObj($dataObj);
        $html = "";
        $users_model = $this->loadModel('UsersModel');
        $items_model = $this->loadModel('ItemsModel');
        foreach ($objData['objData'] as $key => $data) {

            switch ($key) {
                case 'owner_id':
                    $user = $users_model->getOwner($data);
                    $html .= '<h4><span class="label label-default">Owner: ' . $user->name . '</span> </h4> ';
                    break;
                case 'place_id':
                    $item = $items_model->getItem($data);
                    $html .= '<h4><span class="label label-default">Place: ' . $item->name . '</span> </h4>';
                    break;
                default:
                    $html .= '<span class="label label-default">' . $key . ': ' . $data . '</span> ';
            }
        }
        return $html;
    }

}

?>
