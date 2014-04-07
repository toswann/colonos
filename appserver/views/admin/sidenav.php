<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
	<?php if($_SESSION["user"]->type == C::D('TYPE_GENERAL_ADMIN')) { ?>
		<li class="<?=$dashboard?>"><a href="/admin/dashboard">Dashboard</a></li>
	<?php } ?>
	<?php if($_SESSION["user"]->type >= C::D('TYPE_ZONE_ADMIN')) { ?>
	<?php } ?>
	<?php if($_SESSION["user"]->type >= C::D('TYPE_MODERATOR')) { ?>
		<li><a href="/admin/newplace">Add a new place</a></li>
		<li class="<?=$places?>"><a href="/admin/places">See my places</a></li>
		<li><a href="/admin/informations">Personal informations</a></li>
	<?php } ?>
	</ul>
</div>
