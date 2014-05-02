<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Places</h1>           
        
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
                            <th>#</th>
                            <th>Name</th>
                            <th>State</th>
                            <th>Owner</th>
                            <th>Admin</th>
                    </tr>
            </thead>
            <tbody>
            <?php for($i = 0; $i < count($items) ; $i++) { ?>
                    <tr>
                            <td class="text"><?=$items[$i]->item_id ?></td>
                            <td class="text"><?=$items[$i]->name ?></td>
                            <td class="text"><span class="label label-<?=C::ITEM_STATE($items[$i]->state, 1)?>"><?=C::ITEM_STATE($items[$i]->state, 0)?></span></td> 
                            <td>
                            <?php
                                if ($items[$i]->owner_id > 4)
                                    echo '<a class="btn btn-default col-sm-10" href="'.URL.'"admin/editOwner/'.$items[$i]->owner_id.'"><i class="glyphicon glyphicon-user"></i> <span> Edit owner </span></a>';
                                else
                                    echo '<a class="btn btn-warning col-sm-10" href="'.URL.'admin/assignOwner/'.$items[$i]->item_id.'"><i class="glyphicon glyphicon-resize-small"></i> <span> Assign owner </span></a>';
                             ?>                                 
                            </td>  
                            <td>   
                                <a href="/admin/editinfos/<?=$items[$i]->item_id?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Edit infos</a>
                                <a href="/admin/editphotos/<?=$items[$i]->item_id?>" class="btn btn-default"><span class="glyphicon glyphicon-camera"></span> Edit photos</a>
                                <a href="/admin/editcodes/<?=$items[$i]->item_id?>" class="btn btn-default"><span class="glyphicon glyphicon-barcode"></span> Edit codes</a>
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
