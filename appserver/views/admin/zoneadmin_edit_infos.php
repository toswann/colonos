<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Edit Zone Admin</h1>
	<form role="form" class="item-form" action="<?php echo URL; ?>admin/saveeditzoneadmin" method="POST">
	<input type="hidden" name="user-id" value="<?=$user->user_id?>">
	<?php require("zoneadmin_form.php") ?>
	</form>
</div>