<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Owners</h1>           
        
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
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>State</th>                    
                    <th>Places No.</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <?php for ($i = 0; $i < count($owners); $i++) { ?>  
                <form role="form" id="zoneadmin-<?= $owners[$i]->user_id ?>">
                    <tr>
                        <td class="text"><?= $owners[$i]->user_id ?><input type="hidden" name="role_id" value="<?= $owners[$i]->user_id ?>"></td>
                        <td class="text"><?= $owners[$i]->name ?></td>
                        <td class="text"><?= $owners[$i]->email ?></td>
                        <td><span class="label label-<?=C::ITEM_STATE($owners[$i]->state, 1)?>"><?=C::ITEM_STATE($owners[$i]->state, 0)?></span></td>         
                        <td><span class="badge"><?= $owners[$i]->places_number ?></span></td>                         
                        <td>
                            <a class="btn btn-default start" href="<?= URL ?>admin/editOwner/<?= $owners[$i]->user_id ?>"><i class="glyphicon glyphicon-user"></i> <span> Edit </span></a>
                            <a class="btn btn-default" href="<?= URL ?>admin/activateOwner/<?= $owners[$i]->user_id ?>"><i class="glyphicon glyphicon-ok"></i><span> Activate </span></a>
                            <a class="btn btn-default" href="<?= URL ?>admin/deactivateOwner/<?= $owners[$i]->user_id ?>"><i class="glyphicon glyphicon-remove"></i><span> Deactivate</span></a>
                        </td>
                    </tr>
                </form>
            <?php } ?>
        </table>
    </div>
    
</div>
    
<script type="text/javascript">  
 $( document ).ready(function() {
 
      
$('#owners-add-new').click(function () {
        window.location = "<?php echo URL ?>admin/newOwner";
});    
    
});    
    

</script>

