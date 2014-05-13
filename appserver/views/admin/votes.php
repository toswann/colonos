<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Votes</h1>           
     
<div class="row">
<?php if (isset($messageObj) && $messageObj != "") { ?>
        <div class="alert alert-<?= $messageObj['class'] ?>"><?= $messageObj['txt'] ?></div>
<?php } 




?>
</div>      
    
    
    <ul class="nav nav-tabs" id="main-tabs-list">
        <li class="active"><a href="#owners-tab" data-toggle="tab">Votes</a></li>
    </ul>    
    <br>    
    
<div class="tab-content">
  <div class="tab-pane active table-responsive" id="owners-tab">
        <table class="table table-striped" id="zone-admins-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Place</th>
                    <th class="text text-center">AVG</th>                    
                    <th class="text text-center">Comments</th>
                    <th class="text text-center">Date</th>     
                    <th class="text text-center">Newsletter</th>    
                    <th class="text text-center">State</th> 
                    <th class="text text-center">Menu</th> 
                </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($votes); $i++) { ?>  

                    <tr>
                        <td class="text"><?= $votes[$i]->rating_id ?></td>
                        <td class="text"><div class="well"><a href="<?=URL?>admin/editplace/<?=$votes[$i]->item_id ?>"><?= $votes[$i]->name ?></a></div></td>
                        <td class="text text-center">
                            <div class="well bg-success"><a class="avg-popover" data-container="body" data-html="true" data-toggle="popover" data-placement="top" data-content="                                    Cleanliness: <?= $votes[$i]->grade_cleanliness ?><br>
                                    Confort: <?= $votes[$i]->grade_confort ?><br>
                                    Location: <?= $votes[$i]->grade_location ?><br>
                                    Services: <?= $votes[$i]->grade_services ?><br>
                                    Personal: <?= $votes[$i]->grade_personal ?><br>
                                    Pqratio: <?= $votes[$i]->grade_pqratio ?>
                                    "><b><?= $votes[$i]->grade_average ?></b></span></a></div>
                        </td>      
                        <td class="text"><div class="well bg-success"><small><?= $votes[$i]->email ?></small>:<br><em><?= $votes[$i]->text ?></em></div></td>                        
                        <td class="text"><div class="well"><small><?= $votes[$i]->date ?></small></div></td>
                        <td  class="text text-center"><div class="well col-md-10"><?= '<small>'.C::DECISION_STATE($votes[$i]->newsletter, 0).'</small>'?></div></td>
                        <td><?= '<span class="label label-'.C::ITEM_STATE($votes[$i]->state, 1).'">'.C::ITEM_STATE($votes[$i]->state, 0).'</span>'; ?></td>
                        <td  class="text text-center">
                            <?php
                            if ($votes[$i]->state == C::D('ITEM_STATE_OFFLINE')) {?>
                                <a class="btn btn-default" href="<?= URL ?>admin/activateVote/<?= $votes[$i]->rating_id ?>"><i class="glyphicon glyphicon-ok"></i><span> Publish </span></a>
                            <?php }    ?> 
                            <?php                                                                         
                            if ($votes[$i]->state == C::D('ITEM_STATE_VALID')){ ?>
                                <a class="btn btn-default" href="<?= URL ?>admin/deactivateVote/<?= $votes[$i]->rating_id ?>"><i class="glyphicon glyphicon-remove"></i><span> Hide </span></a>
                            <?php }   ?>                        
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
 
      
    //$('.avg-tooltip').tooltip(); 
    $('.avg-popover').popover({
        trigger: 'hover'
    }); 
    
    
});    
    

</script>

