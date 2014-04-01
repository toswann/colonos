<?php

session_start();

class Admin extends Controller {

    public function index() {
    	if (!isset($_SESSION['user'])) {
	        if (isset($_POST["admin-form-mail"])) {
				if (isset($_POST["admin-form-password"]) && $_POST["admin-form-password"] != "") {
					$users_model = $this->loadModel('UsersModel');
					$user = $users_model->checkAuth($_POST["admin-form-mail"], $_POST["admin-form-password"]);
					if ($user) {
						$_SESSION['user'] = $user;
						header('location: ' . URL . 'admin/dashboard');
						exit();
					}
					else {
						$error = C::T('LOGIN_BAD_INFOS');				
					}
				}
				else {
					$error = C::T('LOGIN_NO_PASS');				
				}
	        }
			require 'application/views/admin/_header.php';
	        require 'application/views/admin/login.php';
	        require 'application/views/admin/_footer.php';
		}
		else {
			header('location: ' . URL . 'admin/dashboard');
		}
    }


    public function newpassword() {
    	$this->checkSession();
    	
        if (isset($_POST["new-password-first"])) {
        	if (isset($_POST["new-password-first"]) && $_POST["new-password-first"] != "" &&
        		isset($_POST["new-password-second"]) && $_POST["new-password-second"] != "") {
        		if (strlen($_POST["new-password-first"]) >= C::D('PW_MIN_SIZE')) {
		        	if ($_POST["new-password-first"] == $_POST["new-password-second"]) {
		        		if ($_POST["new-password-first"] != C::D('DEFAULT_PW')) {
							$users_model = $this->loadModel('UsersModel');
							echo "password change to ".$_POST["new-password-first"];
		        		}
		        		else
		        			$error = C::T('NEWPASS_NOT_DEFAULT');
		        	}
		        	else
						$error = C::T('NEWPASS_NOT_SAME');
				}
				else
					$error = C::T('NEWPASS_SHORT');
			}
			else
				$error = C::T('NEWPASS_EMPTY');
        }
		require 'application/views/admin/_header_in.php';
		require 'application/views/admin/newpassword.php';
		require 'application/views/admin/_footer_in.php';	        
    }

    public function dashboard() {

    	$this->checkSession();
    	$this->checkState();

        require 'application/views/admin/_header_in.php';
        require 'application/views/admin/sidenav.php';			
        require 'application/views/admin/dashboard.php';
        require 'application/views/admin/_footer_in.php';	    	
    }

    public function logout() {
    	session_unset();
    	session_destroy();
		header('location: ' . URL . 'admin');	    	
    }
    
    private function checkSession() {
    	if (!isset($_SESSION['user'])) {
			header('location: ' . URL . 'admin');
			exit();
    	}
    }

    private function checkState() {
    	if (isset($_SESSION['user']) && $_SESSION['user']->state == C::D('USER_STATE_NEW')) {
			header('location: ' . URL . 'admin/newpassword');
			exit(); 	
    	}
    }

}

?>