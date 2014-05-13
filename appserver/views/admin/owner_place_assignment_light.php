<div class="panel panel-default col-md-5 placeholder dashboard-panel">
    <div class="panel-heading"><h4><span class="text text-warning">Assignment Place to Owner <span class="badge"><?php if (isset($assignmentsNo)) echo $assignmentsNo; ?></span></span></h4></div>    
    <div class="panel-body" >
        <div class="alert alert-warning">Here you can select Owner and assign existing Place for management.<br>Your request will be sent for approval.</div>
        <div class="well">
        <form role="form" action="<?=URL ?>admin/assignOwnerToPlace" method="POST">      
            <div class="row">
                <div class="form-group  col-lg-12">
                        <input class="form-control"  name="ownerSelector" id="ownerSelector" type="text" placeholder="Search owners..." autocomplete="off" />
                </div>            
                <input class="form-control " name="owneridHolder" id="owneridHolder" type="hidden" /></p>
            </div>
            <div class="row">
                <div class="form-group  col-lg-12">
                    <input class="form-control" name="itemSelector"  id="itemSelector" type="text" placeholder="Search places..." value="<?php if (isset($item_name)) echo $item_name; ?>" autocomplete="off" />
                    <input class="form-control" name="itemidHolder" id="itemidHolder" type="hidden" value="<?php if (isset($item_id)) echo $item_id; ?>" /></p>   
                </div>
            </div>
            <button type="submit" class="btn btn-warning">Assign</button>

        </form>
        </div></div>
    <div class="panel-footer"></div>
</div> 
<script type="text/javascript">
    
 $( document ).ready(function() {
     
var owners = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: '<?=URL ?>api/searchowners/%QUERY'
});

var items = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: '<?=URL ?>api/searchitems/%QUERY'
});
 
// kicks off the loading/processing of `local` and `prefetch`
owners.initialize(); 
items.initialize(); 
 
$('#ownerSelector').typeahead(null, {
  name: 'owners',
  displayKey: 'name',
  // `ttAdapter` wraps the suggestion engine in an adapter that
  // is compatible with the typeahead jQuery plugin
  source: owners.ttAdapter(),
  templates: {
    empty: '<p class="text-center"> <b class="text-primary ">There are no OWNERS with this name </b></p>',      
    suggestion: Handlebars.compile('<span class="glyphicon glyphicon-user"></span><b class="text-primary"> {{name}} </b><br><em class="text-muted"><small> (id: {{user_id}}, email: {{email}})</small></em>')
  }             
}).on('typeahead:selected', function(event, datum) {
        $('#owneridHolder').val(datum.user_id);
    });  

$('#itemSelector').typeahead(null, {
  name: 'items',
  displayKey: 'name',
  // `ttAdapter` wraps the suggestion engine in an adapter that
  // is compatible with the typeahead jQuery plugin
  source: items.ttAdapter(),
  templates: {
    empty: '<p class="text-center"> <b class="text-primary ">There are no PLACES with this name </b></p>',       
    suggestion: Handlebars.compile('<span class="glyphicon glyphicon-home"></span><b class="text-primary"> {{name}} </b><br><em class="text-muted"><small> (id: {{item_id}}, owner ID: {{owner_id}})</small></em>')
  }             
}).on('typeahead:selected', function(event, datum) {
        $('#itemidHolder').val(datum.item_id);
    });  

}); 

</script>