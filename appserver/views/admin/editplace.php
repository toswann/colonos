<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Edit place</h1>
	<form role="form" class="item-form" action="<?php echo URL; ?>admin/saveeditplace" method="POST">
	<input type="hidden" name="item-id" value="<?=$item->id?>">
	<?php require("placeform.php") ?>
	</form>
</div>
