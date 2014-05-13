<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Owners</h1>           
     
<div class="row">
<?php if (isset($messageObj) && $messageObj != "") { ?>
        <div class="alert alert-<?= $messageObj['class'] ?>"><?= $messageObj['txt'] ?></div>
<?php } ?>
</div>      
    
    
    <ul class="nav nav-tabs" id="main-tabs-list">
        <li class="active"><a href="#owners-tab" data-toggle="tab">Owners</a></li>
    </ul>    
    <br>    
    
<div class="tab-content">
  <div class="tab-pane active table-responsive" id="owners-tab">
      <button type="button" class="btn btn-default" id="owners-add-new"><i class="glyphicon glyphicon-plus-sign"></i> Add new Owner</button><br>
        <table class="table table-striped" id="zone-admins-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>State</th>                    
                    <th>Places No.</th>
                    <th>Menu</th>
                </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($owners); $i++) { ?>  

                    <tr>
                        <td class="text"><?= $owners[$i]->user_id ?><input type="hidden" name="role_id" value="<?= $owners[$i]->user_id ?>"></td>
                        <td class="text"><a href="<?=URL?>admin/editowner/<?=$owners[$i]->user_id ?>"><?= $owners[$i]->name ?></a></td>
                        <td class="text"><?= $owners[$i]->email ?></td>
                        <td>
                            <?php 
                                if ($owners[$i]->task_id > 0){
                                    echo '<span class="label label-default">PENDING <small>(id:'.$owners[$i]->task_id.')</small></span>';
                                } else {
                                    echo '<span class="label label-'.C::ITEM_STATE($owners[$i]->state, 1).'">'.C::ITEM_STATE($owners[$i]->state, 0).'</span>';
                                }
                              ?>         
                        </td>
                        <td><a href="<?= URL ?>admin/places/<?= $owners[$i]->user_id ?>"><span class="badge"><?= $owners[$i]->places_number ?></span></a></td>                         
                        <td>
                            <?php   if ($owners[$i]->task_id == 0){ ?>  
                                <a class="btn btn-default start" href="<?= URL ?>admin/editOwner/<?= $owners[$i]->user_id ?>"><i class="glyphicon glyphicon-user"></i> <span> Edit </span></a>
                                <?php
                                        if ($owners[$i]->state == C::D('USER_STATE_NEW')) {?>
                                            <a class="btn btn-default" href="<?= URL ?>admin/activateOwner/<?= $owners[$i]->user_id ?>"><i class="glyphicon glyphicon-ok"></i><span> Activate </span></a>
                                        <?php }    ?> 
                                        <?php                                                                         
                                        if ($owners[$i]->state == C::D('USER_STATE_ACTIVE')){ ?>
                                            <a class="btn btn-default" href="<?= URL ?>admin/deactivateOwner/<?= $owners[$i]->user_id ?>"><i class="glyphicon glyphicon-remove"></i><span> Deactivate</span></a>
                                        <?php }                               
                            } ?>     
                        </td>
                    </tr>

            <?php } ?>
            </tbody>            
        </table>
    </div>
    
</div>
 
</div>
    
<script type="text/javascript">  
 $( document ).ready(function() {
 
      
$('#owners-add-new').click(function () {
        window.location = "<?php echo URL ?>admin/newOwner";
});    
    
});    
    

</script>

