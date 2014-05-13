<div class="panel panel-default col-md-6 placeholder dashboard-panel">
    
    <div class="panel-heading"><h4 class="hidetasks"><span class="text text-success">Requests from Zone Admins <span class="badge"><?= count($tasks) ?></span></span></h4></div>    
    <div class="panel-body">
        <div class="alert alert-success">Below, you'll find all request from your Zone Admins that hasn't been answered yet. <br>Your decision is required. Click on item to view more details.</div>
        <div class="well">
          <?php for ($i = 0; $i < count($tasks); $i++) { ?> 
          <div class="row item2 item-<?= $tasks[$i]->task_id ?>" id="item-<?= $tasks[$i]->task_id ?>" data-ref="<?= $tasks[$i]->task_id ?>">      
              <div class="col-md-12">
                  <div class="row">      
                      <p>
                      <h5> <label class="label label-info">NEW</label> <span class="caret"></span> (t.<?= $tasks[$i]->task_id ?>) <?= C::TASK_TYPE($tasks[$i]->type, 1) ?>  <small><span class="glyphicon glyphicon-chevron-right"></span><span class="text"> <?= $tasks[$i]->name ?></span><span class="glyphicon glyphicon-chevron-right small"></span><span class="text"> <?= $tasks[$i]->create_date ?></span></small></h5>
                      </p>
                  </div>
                  <div class="row second-infos">
                          <div class="col-md-12">
                              <div class="description"><blockquote><h5><?= $this->parseDetails($tasks[$i]->details) ?></h5></blockquote></div>
                              <div class="comments"><blockquote><h5><small><?= $tasks[$i]->comments ?></small></h5></blockquote></div>
                                  <div class="seemore">
                                      <a class="btn btn-default" href="<?= URL ?>admin/tasks/accept/<?= $tasks[$i]->task_id ?>"><i class="glyphicon glyphicon-ok"></i><span> Accept </span></a>
                                      <a class="btn btn-default" href="<?= URL ?>admin/tasks/reject/<?= $tasks[$i]->task_id ?>"><i class="glyphicon glyphicon-remove"></i><span> Reject</span></a>
                                  </div>
                          </div>			
                  </div>                
              </div>
          </div>
          <?php } ?>      
    </div>            
    </div>
    

    
</div>
<div class="col-md-push-1 col-xs-offset-1 placeholder "><div class="clearfix visible-xs"></div></div>
<script type="text/javascript">  
 $( document ).ready(function() {
     
     /*
      *     <div class="panel-footer">
        <ul class="pagination">
          <li class="disabled"><a href="#">&laquo;</a></li>
          <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">&raquo;</a></li>
         </ul>
    </div>
      */
     
        var selectedItem = "xyz";      
         
        $(".hidetasks").click(function() {
                $(selectedItem).removeClass("selected");
                $(selectedItem).find(".second-infos").hide();
        });
     
        $(".item2").click(function() {
            if (selectedItem != "none") {
                $(selectedItem).removeClass("selected");
                $(selectedItem).find(".second-infos").hide();
            }
            selectedItem = this;
            $(selectedItem).find(".second-infos").show();
            $(selectedItem).addClass("selected");     
        });

        // Prepare stage and hide them all
        $(".item2").find(".second-infos").hide();

});    
    

</script>
