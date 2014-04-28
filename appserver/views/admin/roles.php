<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Role-Based Access Control</h1>           
    
   <div class="alert alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Hi, this is your role: <?= @$roles[$i]->ID ?></h4>
      <p>Your permissions: </p>
      <p>
        <button type="button" class="btn btn-danger">Take this action</button>
        <button type="button" class="btn btn-default">Or do this</button>
      </p>
    </div> 
    
    <ul class="nav nav-tabs" id="rolesTab">
        <li class="active"><a href="#roles" data-toggle="tab">Roles</a></li>
        <li><a href="#permissions" data-toggle="tab">Permissions</a></li>
        <li><a href="#assignmens" data-toggle="tab">Access List</a></li>
    </ul>    
    <br>
    
<div class="tab-content">
  <div class="tab-pane active table-responsive" id="roles">    
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Role</td>
                    <td>Description</td>
                    <td>Permissions</td>                    
                    <td>Actions</td>
                </tr>
            </thead>
            <?php for ($i = 0; $i < count($roles); $i++) { ?>  
                <form role="form">
                    <tr>
                        <td><?= $roles[$i]->ID ?><input type="hidden" name="role_id" value="<?= $roles[$i]->ID ?>"></td>
                        <td><?= $roles[$i]->Title ?></td>
                        <td><?= $roles[$i]->Description ?></td>
                        <td>
                            <div class="form-group">
                                <label class="checkbox-inline">Permission name: </label>
                                <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox1" value="option1"> 1</label>
                                <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox2" value="option2"> 2</label>
                                <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox3" value="option3"> 3</label>
                            </div>
                            <div class="form-group">
                                <label class="checkbox-inline">Permission name: </label>
                                <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox1" value="option1"> 1</label>
                                <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox2" value="option2"> 2</label>
                                <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox3" value="option3"> 3</label>
                            </div>                                 
                        </td>
                        <td>
                                <button class="btn btn-success start" ><i class="glyphicon glyphicon-floppy-save"></i><span> Save</span></button>
                                <button class="btn btn-warning"><i class="glyphicon glyphicon-off"></i><span> Cancel</span></button>
                                <button class="btn btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i><span> Remove</span></button>
                        </td>
                    </tr>
                </form>
            <?php } ?>
        </table>
    </div>
    
  <div class="tab-pane table-responsive" id="permissions">   
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Permission</td>
                    <td>Description</td>
                    <td>Actions</td>
                </tr>
                
            </thead>
            <?php for ($i = 0; $i < count($permissions); $i++) { ?>           
                <tr>
                    <td><?=$permissions[$i]->ID?></td>
                    <td><?=$permissions[$i]->Title?></td>
                    <td><?=$permissions[$i]->Description?></td>
                    <td>{}</td>
                </tr>
            <?php } ?>
        </table>
    </div>   
    
  <div class="tab-pane table-responsive" id="assignment">   
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>User</td>
                    <td>Role</td>
                    <td></td>
                </tr>
                
            </thead>
            <tr>
                <td>1</td>
                <td>{}</td>
                <td>{}</td>
                <td>{}</td>
            </tr>
        </table>
    </div>       
    
    
</div>
<script type="text/javascript">  
 $( document ).ready(function() {
    
    
    
    
 });
</script>

