<div class="container" id="alogin">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
			<form class="form-horizontal" role="form" action="<?php echo URL; ?>admin" method="POST">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">Email</label>
					<div class="col-sm-8">
						<input type="email" class="form-control" name="admin-form-mail" placeholder="Email" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-4 control-label">Password</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="admin-form-password" placeholder="Password">
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
	</div>
</div>
