<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Error.</h1>           
    <div class="row">
    <?php if (isset($messageObj) && $messageObj != "") { ?>
            <div class="alert alert-<?= $messageObj['class'] ?>"><?= $messageObj['txt'] ?></div>
    <?php } ?>
    </div>      
    
