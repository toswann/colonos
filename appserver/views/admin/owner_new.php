<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Add Owner</h1>
	<h2 class="page-header">Informationes</h2>
	<form role="form" class="item-form" action="<?php echo URL; ?>admin/savenewowner" method="POST">
	<input type="hidden" name="user-id" value="<?=@$user->user_id?>">
                    <?php require("owner_form.php") ?>
	</form>
</div>