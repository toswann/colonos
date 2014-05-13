<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h3 class="page-header">¡Hola, <?= F::getUserData('name') ?>!</h3>
    <div class="row placeholders">  
        <?php if ($this->rbac->check('manage_owner_and_place', F::getUserId())) { ?>
        <div class="placeholder dashboard-panel col-sm-5 col-md-2 text-center">
            <a href="/admin/requests" class="thumbnail text-muted">
                <h1><span class="glyphicon glyphicon-tasks"></span></h1>
                <strong><?= $requestsNo ?></strong><br><em>Requests</em>
            </a>
        </div>          
        <div class="placeholder dashboard-panel col-sm-5 col-md-2 text-center">
            <a href="/admin/owners" class="thumbnail text-muted">
                <h1><span class="glyphicon glyphicon-user"></span></h1>
                <strong><?= $ownersNo ?></strong><br><em>Owners</em>
            </a>
        </div>
        <div class="placeholder dashboard-panel col-sm-5 col-md-2 text-center">
            <a href="/admin/places/" class="thumbnail text-muted">
                <h1><span class="glyphicon glyphicon-resize-small"></span></h1>
                <strong><?= $assignmentsNo ?></strong><br><em>Assignments</em>
            </a>
        </div>                
        <?php } ?>                
        <?php if ($this->rbac->check('edit_place', F::getUserId())) { ?>                
        <div class="placeholder dashboard-panel col-sm-5 col-md-2 text-center">
            <a href="/admin/places" class="thumbnail text-muted">
                <h1><span class="glyphicon glyphicon-home"></span></h1>
                <strong><?= $itemsNo ?></strong><br><em>Places</em>
            </a>
        </div>
        <div class="placeholder dashboard-panel col-sm-5 col-md-2 text-center">
            <a href="/admin/votes" class="thumbnail text-muted">
                <h1><span class="glyphicon glyphicon-star"></span></h1>
                <strong><?= $votesNo ?></strong><br><em>Votes</em>
            </a>
        </div>   
        <?php } ?>                

    </div>
    <div class="row placeholders"><hr></div>    
    <div class="row placeholders">
