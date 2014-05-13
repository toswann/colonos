	
<!-- START THE FEATURETTES -->
<div class="container registration-container" style="padding-top: 100px" >
    <div class="row">
        <div class="span6">
            <div class="row">
            <?php if (isset($messageObj) && $messageObj != "") { ?>
                    <div class="alert alert-<?= $messageObj['class'] ?>"><?= $messageObj['txt'] ?></div>
            <?php } ?>
            </div>                   
        </div>
    </div>
    <hr class="featurette-divider">
</div>
    <!-- /END THE FEATURETTES -->
