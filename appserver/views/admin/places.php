<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Places</h1>           
     
<div class="row">
<?php if (isset($messageObj) && $messageObj != "") { ?>
        <div class="alert alert-<?= $messageObj['class'] ?>"><?= $messageObj['txt'] ?></div>
<?php } ?>
</div>        
        
    <ul class="nav nav-tabs" id="main-tabs-list">
        <li class="active"><a href="#places-tab" data-toggle="tab">Places</a></li>
    </ul>    
    <br>

<div class="tab-content">
  <div class="tab-pane active table-responsive" id="places-tab">
      <button type="button" class="btn btn-default" id="places-add-new"><i class="glyphicon glyphicon-plus-sign"></i> Add new Place</button><br>
        <table class="table table-striped" id="places-table">
            <thead>
                    <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Zone</th>
                            <th>Owner</th>                            
                            <th>AVG</th>                            
                            <th>State</th>
                            <th>Menu</th>
                    </tr>
            </thead>
            <tbody>
            <?php for($i = 0; $i < count($items) ; $i++) { ?>
                    <tr>
                            <td class="text"><?=$items[$i]->item_id ?></td>
                            <td class="text"><a href="<?=URL?>admin/editplace/<?=$items[$i]->item_id ?>"><?=$items[$i]->name ?></a></td>
                            <td class="text"><?=C::ZONES($items[$i]->zone_id) ?></td>
                            <td class="text">
                                    <?php  
                                                    if ($items[$i]->owner_id > 4 )
                                                            echo '<a class="btn btn-default" href="'.URL.'admin/editOwner/'.$items[$i]->owner_id.'"><i class="glyphicon glyphicon-user"></i> <span>'.$items[$i]->owner_name.'</span></a>';                                       
                                                    else
                                                            echo '<a class="btn btn-primary" href="'.URL.'admin/assignOwner/'.$items[$i]->item_id.'"><i class="glyphicon glyphicon-resize-small"></i> <span> Assign owner </span></a>';
                                                    
                                     ?>                            
                            </td>
                            <td class="text"><button type="button" class="btn avg-popover"><span class="badge"><?= $items[$i]->averagegrade ?></span></button></td>                            
                            <td class="text">
                            <?php 
                                if ($items[$i]->task_id > 0){
                                    echo '<span class="label label-default">PENDING <small>(id:'.$items[$i]->task_id.')</small></span>';
                                } else {
                                    echo '<span class="label label-'.C::ITEM_STATE($items[$i]->state, 1).'">'.C::ITEM_STATE($items[$i]->state, 0).'</span>';
                                }
                              ?>       
                            </td> 

                            <td>                               
                                <?php
                                    if ($items[$i]->task_id == 0){ ?>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> Edit <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <?php  
                                                    echo '<li><a href="/admin/editinfos/'.$items[$i]->item_id.'" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Infos</a></li>';
                                                    echo '<li><a href="/admin/editphotos/'.$items[$i]->item_id.'" class="btn btn-default"><span class="glyphicon glyphicon-camera"></span> Photos</a></li>';
                                                    echo '<li><a href="/admin/editcodes/'.$items[$i]->item_id.'" class="btn btn-default"><span class="glyphicon glyphicon-barcode"></span> Codes</a></li>';
                                                    if ($items[$i]->owner_id > 4 )
                                                        // If there is sth going on with this record
                                                            echo '<li><a class="btn btn-default" href="'.URL.'admin/editOwner/'.$items[$i]->owner_id.'"><i class="glyphicon glyphicon-user"></i> <span>Owner </span></a></li>';
                                                            echo '<li><a class="btn btn-default" href="'.URL.'admin/assignOwner/'.$items[$i]->item_id.'"><i class="glyphicon glyphicon-resize-small"></i> <span> Assign owner </span></a></li>';                                        
                                                      ?>   
                                           </ul>
                                        </div>
                                        <?php
                                        if ($items[$i]->state == C::D('ITEM_STATE_OFFLINE')) {?>
                                                                        <a class="btn btn-default" href="<?= URL ?>admin/activatePlace/<?= $items[$i]->item_id ?>"><i class="glyphicon glyphicon-ok"></i><span> Activate </span></a>
                                        <?php }    ?> 
                                        <?php                                                                         
                                        if ($items[$i]->state == C::D('ITEM_STATE_VALID')){ ?>
                                                <a class="btn btn-default" href="<?= URL ?>admin/deactivatePlace/<?= $items[$i]->item_id ?>"><i class="glyphicon glyphicon-remove"></i><span> Deactivate</span></a>    
                                        <?php }  

                                            }
                                         ?>                                                        
                            </td>
                    </tr>

            <?php } ?>
            </tbody>
    </table>
    </div>
    
</div>

<script type="text/javascript">  
 $( document ).ready(function() {
 
      
$('#places-add-new').click(function () {
        window.location = "<?php echo URL ?>admin/newplace";
});    
    
});    
    

</script>
