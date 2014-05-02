<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Zone Admins</h1>           
        
    <ul class="nav nav-tabs" id="main-tabs-list">
        <li class="active"><a href="#zone-admins-tab" data-toggle="tab">Zone admins</a></li>
        <li><a href="#zones-tab" data-toggle="tab">Zones</a></li>
    </ul>    
    <br>

<div class="tab-content">
  <div class="tab-pane active table-responsive" id="zone-admins-tab">
      <button type="button" class="btn btn-default" id="zone-admins-add-new"><i class="glyphicon glyphicon-plus-sign"></i> Add new Zone Admin</button><br>
        <table class="table table-striped" id="zone-admins-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>State</th>                   
                    <th>Zone</th>
                    <th></td>
                </tr>
            </thead>
            <?php for ($i = 0; $i < count($zoneadmins); $i++) { ?>  
                <form role="form" id="zoneadmin-<?= $zoneadmins[$i]->user_id ?>">
                    <tr>
                        <td class="text"><?= $zoneadmins[$i]->user_id ?><input type="hidden" name="role_id" value="<?= $zoneadmins[$i]->user_id ?>"></td>
                        <td class="text"><?= $zoneadmins[$i]->name ?></td>
                        <td class="text"><?= $zoneadmins[$i]->email ?></td>
                        <td><span class="label label-<?=C::ITEM_STATE($zoneadmins[$i]->state, 1)?>"><?=C::ITEM_STATE($zoneadmins[$i]->state, 0)?></span></td>         
                        <td><?= C::ZONES($zoneadmins[$i]->zone_id) ?></td>                         
                        <td>
                            <a class="btn btn-default start" href="<?= URL ?>admin/editZoneAdmin/<?= $zoneadmins[$i]->user_id ?>"><i class="glyphicon glyphicon-floppy-save"></i> <span> Edit </span></a>
                            <a class="btn btn-default" href="<?= URL ?>admin/activateZoneAdmin/<?= $zoneadmins[$i]->user_id ?>"><i class="glyphicon glyphicon-off"></i><span> Activate </span></a>
                            <a class="btn btn-default" href="<?= URL ?>admin/deactivateZoneAdmin/<?= $zoneadmins[$i]->user_id ?>"><i class="glyphicon glyphicon-floppy-remove"></i><span> Deactivate</span></a>
                        </td>
                    </tr>
                </form>
            <?php } ?>
        </table>
    </div>
    
  <div class="tab-pane table-responsive" id="zones-tab">   
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                </tr>
                
            </thead>
            <?php foreach ($zones as $key=>$value) { ?>           
                <tr>
                    <td><?=$key?></td>
                    <td><?=$value?></td>
                </tr>
            <?php } ?>
        </table>
    </div>   
     
    
</div>
    
<script type="text/javascript">  
 $( document ).ready(function() {
 
      
$('#zone-admins-add-new').click(function () {
        window.location = "<?php echo URL ?>admin/newZoneAdmin";
    
});    
    
});    
    

</script>

