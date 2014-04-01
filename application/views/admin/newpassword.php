<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" id="anewpassword">
	<form class="form-horizontal" role="form" action="<?php echo URL; ?>admin/newpassword" method="POST">
		<div class="form-group">
			<label for="input-email" class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8">
				<input type="email" id="input-email"  class="form-control" name="admin-form-mail" placeholder="Email" value="<?php echo $_SESSION['user']->email ?>" disabled>
			</div>
		</div>
		<div class="form-group">
			<label for="input-password-first" class="col-sm-4 control-label">Nueva Contraseña</label>
			<div class="col-sm-8">
				<input type="password" id="input-password-first" class="form-control" name="new-password-first">
			</div>
		</div>
		<div class="form-group">
			<label for="input-password-second" class="col-sm-4 control-label">Nueva Contraseña</label>
			<div class="col-sm-8">
				<input type="password" id="input-password-second" class="form-control" name="new-password-second">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" class="btn btn-default">Sign in</button>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
			<?php if (isset($error)) { ?>
				<div class="alert alert-danger"><?php echo $error ?></div>
			<?php } ?>
			</div>
		</div>
	</form>
</div>
