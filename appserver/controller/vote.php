<?php
/**
 * Vote Controller for all operations from Users perspective.
 * @package Front End Module
 * @category Vote Controller      
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Swann, Patryk
 */

class Vote extends Controller {

    /**
     * Default entry point for /vote action called by Application. Renders the form for voting actions
     * @return void
     * @author Swann
     */        
    public function index() {
        $voteindex = true; // activate vote.index.js in the view
        require APP_FOLDER_NAME . '/views/_templates/_header.php';
        require APP_FOLDER_NAME . '/views/vote/index.php';
        require APP_FOLDER_NAME . '/views/_templates/_footer.php';
    }

    /**
     * Process rating of a place 
     * @return void
     * @author Swann, Patryk
     */     
    public function rate() {
        try {

            @$vote_id_item = strip_tags($_POST["vote_id_item"]);
            @$vote_email = strip_tags($_POST["vote_email"]);
            @$vote_grade_personal = strip_tags($_POST["vote_grade_personal"]);
            @$vote_grade_cleanliness = strip_tags($_POST["vote_grade_cleanliness"]);
            @$vote_grade_confort = strip_tags($_POST["vote_grade_confort"]);
            @$vote_grade_location = strip_tags($_POST["vote_grade_location"]);
            @$vote_grade_services = strip_tags($_POST["vote_grade_services"]);
            @$vote_grade_pqratio = strip_tags($_POST["vote_grade_pqratio"]);
            @$vote_text = strip_tags($_POST["vote-text"]);
            @$vote_newsletter = F::checkBoxSetOrNot('vote-newsletter');
            @$vote_code = strip_tags($_POST["vote_code"]);

            $votes_model = $this->loadModel('VotesModel');
            $vote = $votes_model->saveVote($vote_id_item, $vote_email, $vote_grade_personal, $vote_grade_cleanliness, $vote_grade_confort, $vote_grade_location, $vote_grade_services, $vote_grade_pqratio, $vote_text, $vote_newsletter);

            $codes_model = $this->loadModel('CodesModel');
            $code = $codes_model->markUsedCode($vote_id_item, $vote_code);

            header('location: ' . URL . 'vote/rated');
            exit();
        } catch (Exception $ex) {
            header('location: ' . URL . 'vote/notrated');
            exit();
        }
    }

    /**
     * Renders screen with positive result of processing users's vote
     * @return void
     * @author Patryk
     */     
    public function rated() {
        $voteindex = true; // activate vote.index.js in the view
        $result = "ok";
        require APP_FOLDER_NAME . '/views/_templates/_header.php';
        require APP_FOLDER_NAME . '/views/vote/rated.php';
        require APP_FOLDER_NAME . '/views/_templates/_footer.php';
    }

    /**
     * Renders screen with negative result of processing users's vote
     * @return void
     * @author Patryk
     */         
    public function notrated() {
        $voteindex = true; // activate vote.index.js in the view
        $result = "error";
        require APP_FOLDER_NAME . '/views/_templates/_header.php';
        require APP_FOLDER_NAME . '/views/vote/rated.php';
        require APP_FOLDER_NAME . '/views/_templates/_footer.php';
    }

}

?>