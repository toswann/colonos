<?php

class Vote extends Controller {

    public function index() {
		$voteindex = true; // activate vote.index.js in the view
		require APP_FOLDER_NAME.'/views/_templates/_header.php';
        require APP_FOLDER_NAME.'/views/vote/index.php';
        require APP_FOLDER_NAME.'/views/_templates/_footer.php';    	
    }
}

?>