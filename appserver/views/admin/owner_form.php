<div class="row">
        <div class="form-group col-sm-12 col-md-8 col-lg-6">
                <div class="input-group">
                <?php if (isset($error) && $error != "") { ?>
                        <div class="alert alert-danger"><?php echo C::T($error); ?></div>
                <?php } 
                        else {?>
                            <div class="alert alert-info input-group">Here you can edit information about Owner.<br>Password will not be changed unless you type the new one.</div>
                       <?php }?>
                </div>
        </div>
        <div class="hidden-sm col-md-4  col-lg-6">

        </div>    
</div>  

<div class="row">
        <div class="form-group col-sm-12 col-md-8 col-lg-6">
            <div class="input-group">
              <span class="input-group-addon">Sr/Sra.</span>
              <input type="text" class="form-control" <?php if (isset($user) && $user->name) { echo 'value="'.$user->name.'"'; } else { echo '"placeholder="Name"'; } ?> name="user-name" id="user-name">
            </div> 
        </div>
        <div class="hidden-sm col-md-4  col-lg-6">

        </div>
</div>    

<div class="row">
        <div class="form-group col-sm-12 col-md-8 col-lg-6">
            <div class="input-group">
              <span class="input-group-addon">@</span>
              <input type="text" class="form-control" <?php if (isset($user) && $user->email) { echo 'value="'.$user->email.'"'; } else { echo '"placeholder="Email"'; } ?> name="user-email" id="user-email">
            </div>
        </div>
        <div class="hidden-sm col-md-4  col-lg-6">

        </div>
</div>       
<?php 
if (!isset($hidePass)) { ?>
<div class="row">
        <div class="form-group col-sm-12 col-md-8 col-lg-6">
            <div class="input-group">
              <span class="input-group-addon">New Password</span>
              <input type="password" class="form-control" placeholder="" name="user-pass" id="user-pass">
            </div>
        </div>
        <div class="hidden-sm col-md-4  col-lg-6">

        </div>
</div>   

<div class="row">
        <div class="form-group col-sm-12 col-md-8 col-lg-6">
            <div class="input-group">
              <span class="input-group-addon">Confirm password</span>
              <input type="password" class="form-control" placeholder="" name="user-pass-2" id="user-pass-2">
            </div>
        </div>
        <div class="hidden-sm col-md-4  col-lg-6">

        </div>
</div>  
<?php } ?>
<div class="row">
	<div class="col-xs-2">
		<a href="/admin/owners" class="btn btn-danger">Cancel modifications</a>			
	</div>
	<div class="col-xs-1">
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
</div>

