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
                    <th>#</th>
                    <th>Voter's Email</th>
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
                        <td class="text"><?= $votes[$i]->email ?></td>
                        <td class="text"><a href="<?=URL?>admin/editplace/<?=$votes[$i]->item_id ?>"><?= $votes[$i]->name ?></a></td>
                        <td class="text text-center">
                            <button type="button" class="btn avg-popover" data-container="body" data-html="true" data-toggle="popover" data-placement="top" data-content="                                    Cleanliness: <?= $votes[$i]->grade_cleanliness ?><br>
                                    Confort: <?= $votes[$i]->grade_confort ?><br>
                                    Location: <?= $votes[$i]->grade_location ?><br>
                                    Services: <?= $votes[$i]->grade_services ?><br>
                                    Personal: <?= $votes[$i]->grade_personal ?><br>
                                    Pqratio: <?= $votes[$i]->grade_pqratio ?>
                                    "><span class="badge"><?= $votes[$i]->grade_average ?></span></button>
                        </td>      
                        <td class="text"><small><?= $votes[$i]->text ?></small></td>                        
                        <td class="text"><small><?= $votes[$i]->date ?></small></td>
                        <td  class="text text-center">
                            <?php
                                  echo '<small>'.C::DECISION_STATE($votes[$i]->newsletter, 0).'</small>'
                             ?>
                        </td>
                        <td><?= '<span class="label label-'.C::ITEM_STATE($votes[$i]->state, 1).'">'.C::ITEM_STATE($votes[$i]->state, 0).'</span>'; ?></td>
                        <td  class="text text-center">
                            <?php
                            if ($votes[$i]->state == C::D('ITEM_STATE_OFFLINE')) {?>
                                <a class="btn btn-default" href="<?= URL ?>admin/activateVote/<?= $votes[$i]->rating_id ?>"><i class="glyphicon glyphicon-ok"></i><span> Activate </span></a>
                            <?php }    ?> 
                            <?php                                                                         
                            if ($votes[$i]->state == C::D('ITEM_STATE_VALID')){ ?>
                                <a class="btn btn-default" href="<?= URL ?>admin/deactivateVote/<?= $votes[$i]->rating_id ?>"><i class="glyphicon glyphicon-remove"></i><span> Deactivate</span></a>
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

