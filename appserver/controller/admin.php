<?php

session_start();

class Admin extends Controller {


    public function dashboard() {
    	$this->checkSession();
    	$this->checkState();
    	$this->checkTypeAtLeast(C::D('TYPE_MODERATOR'));

	    $dashboard = "active";
        require APP_FOLDER_NAME.'/views/admin/_header_in.php';
        require APP_FOLDER_NAME.'/views/admin/sidenav.php';
        require APP_FOLDER_NAME.'/views/admin/dashboard.php';
        require APP_FOLDER_NAME.'/views/admin/_footer_in.php';	    	
    }
    
    public function places() {
    	$this->checkSession();
    	$this->checkState();
    	$this->checkTypeAtLeast(C::D('TYPE_MODERATOR'));

	    $places = "active";

		$items_model = $this->loadModel('ItemsModel');
		$items = $items_model->getAdminItems($_SESSION["user"]->id);
		
        require APP_FOLDER_NAME.'/views/admin/_header_in.php';
        require APP_FOLDER_NAME.'/views/admin/sidenav.php';
        require APP_FOLDER_NAME.'/views/admin/places.php';
        require APP_FOLDER_NAME.'/views/admin/_footer_in.php';
    }

    public function editplace($id) {
    	$this->checkSession();
    	$this->checkState();
    	$this->checkTypeAtLeast(C::D('TYPE_MODERATOR'));

	    $places = "active";

		$items_model = $this->loadModel('ItemsModel');
		$item = $items_model->getItem($id);

		// if the user is the admin of the place		
		if (isset($item) && $item && $_SESSION["user"]->id == $item->id_admin) {
			echo "edit";
		}
		else {
			header('location: ' . URL . 'admin/places');
			exit();
		}
		require APP_FOLDER_NAME.'/views/admin/_header_in.php';
        require APP_FOLDER_NAME.'/views/admin/sidenav.php';
        require APP_FOLDER_NAME.'/views/admin/editplace.php';
        require APP_FOLDER_NAME.'/views/admin/_footer_in.php';
    }
    
    public function saveeditplace() {
    	$this->checkSession();
    	$this->checkTypeAtLeast(C::D('TYPE_MODERATOR'));
	    
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
		$galery = strip_tags($_POST["item-galery"]);
		$lat = strip_tags($_POST["item-lat"]);
		$long = strip_tags($_POST["item-long"]);
		$price = strip_tags($_POST["item-price"]);
		//echo $id."<br>".$name."<br>".$flatname."<br>".$category."<br>".$type."<br>".$city."<br>".$zone."<br>".$address."<br>".$phone."<br>".$email."<br>".$website."<br>".$description."<br>".$image."<br>".$galery."<br>".$lat."<br>".$long."<br>".$price."<br>";
		
		$items_model = $this->loadModel('ItemsModel');
		$item = $items_model->saveEditItem($id, $name, $flatname, $category, $type, $city, $zone, $address, $phone, $email, $website, $description, $image, $galery, $lat, $long, $price);
		
		
		header('location: ' . URL . 'admin/places');
		exit();
		
    }


    public function index() {
    	if (!isset($_SESSION['user'])) {
	        if (isset($_POST["admin-form-mail"])) {
				if (isset($_POST["admin-form-password"]) && $_POST["admin-form-password"] != "") {
					$users_model = $this->loadModel('UsersModel');
					$user = $users_model->checkAdminAuth($_POST["admin-form-mail"], $_POST["admin-form-password"]);
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
			require APP_FOLDER_NAME.'/views/admin/_header.php';
	        require APP_FOLDER_NAME.'/views/admin/login.php';
	        require APP_FOLDER_NAME.'/views/admin/_footer.php';
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
							if ($users_model->setNewPasswordAndChangeState($_SESSION["user"]->email, $_POST["new-password-first"])) {
								$_SESSION['user']->state = C::D('USER_STATE_ACTIVE');
								header('location: ' . URL . 'admin/dashboard');
								exit();
							}
							else
								$error = C::T('SERVER_ERROR_RELOAD');
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
		require APP_FOLDER_NAME.'/views/admin/_header_in.php';
		require APP_FOLDER_NAME.'/views/admin/newpassword.php';
		require APP_FOLDER_NAME.'/views/admin/_footer_in.php';	        
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
    	if (isset($_SESSION['user']->state) && $_SESSION['user']->state == C::D('USER_STATE_NEW')) {
			header('location: ' . URL . 'admin/newpassword');
			exit(); 	
    	}
    }

    private function checkTypeAtLeast($type) {
    	if (isset($_SESSION['user']->type) && (integer)$_SESSION['user']->type < $type) {
    		header('location: ' . URL . 'admin/logout');
    		exit();
    	}
    }


}

?>