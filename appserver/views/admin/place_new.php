<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Add place</h1>
	<form role="form" class="item-form" id="item-form" action="<?php echo URL; ?>admin/savenewplace" method="POST">
	<input type="hidden" name="item-id" id="item-id-input" value="<?= $item_id ?>">
	<?php require("place_form.php") ?>
	</form>
</div>
